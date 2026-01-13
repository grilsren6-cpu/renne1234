<?php
session_start();
include 'config.php';
if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){ header('Location: admin_login.php'); exit; }
$pdo = getPDO();
$action = $_GET['action'] ?? 'create';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$places = [];
if($pdo){
  try{ $stmt = $pdo->query('SELECT id,name FROM places ORDER BY name'); $places = $stmt->fetchAll(); }
  catch(Exception $e){ $places = []; }
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $title = $_POST['title'] ?? '';
  $description = $_POST['description'] ?? '';
  $days = $_POST['days'] ?? '';
  $price = $_POST['price'] ?? '';
  $img = $_POST['img'] ?? '';
    $contact_phone_pkg = $_POST['contact_phone'] ?? null;
    $contact_name_pkg = $_POST['contact_name'] ?? null;
  $selectedPlaces = $_POST['places'] ?? [];

  if(trim($title) === '') $errors[] = 'Judul wajib diisi.';

  if(empty($errors)){
    if($action === 'create'){
      $stmt = $pdo->prepare('INSERT INTO packages (title,description,days,price,img,contact_phone,contact_name) VALUES (?,?,?,?,?,?,?)');
      $stmt->execute([$title,$description,$days,$price,$img,$contact_phone_pkg,$contact_name_pkg]);
      $newId = $pdo->lastInsertId();
      // insert mappings
      if(!empty($selectedPlaces)){
        $ins = $pdo->prepare('INSERT INTO package_places (package_id,place_id) VALUES (?,?)');
        foreach($selectedPlaces as $pl){ $ins->execute([$newId,(int)$pl]); }
      }
    }else{
      $stmt = $pdo->prepare('UPDATE packages SET title=?,description=?,days=?,price=?,img=?,contact_phone=?,contact_name=? WHERE id=?');
      $stmt->execute([$title,$description,$days,$price,$img,$contact_phone_pkg,$contact_name_pkg,$id]);
      // update mappings: delete old and insert new
      $del = $pdo->prepare('DELETE FROM package_places WHERE package_id = ?'); $del->execute([$id]);
      if(!empty($selectedPlaces)){
        $ins = $pdo->prepare('INSERT INTO package_places (package_id,place_id) VALUES (?,?)');
        foreach($selectedPlaces as $pl){ $ins->execute([$id,(int)$pl]); }
      }
    }
    header('Location: admin.php'); exit;
  }
}

// Load existing data for edit
$data = ['title'=>'','description'=>'','days'=>'','price'=>'','img'=>''];
$selected = [];
if($action === 'edit' && $id && $pdo){
  $stmt = $pdo->prepare('SELECT * FROM packages WHERE id = ?'); $stmt->execute([$id]); $row = $stmt->fetch();
  if($row){ $data = $row; }
  // load selected places
  $stmt2 = $pdo->prepare('SELECT place_id FROM package_places WHERE package_id = ?'); $stmt2->execute([$id]); $selected = $stmt2->fetchAll(PDO::FETCH_COLUMN);
}

include 'header.php';
?>
<section class="py-5">
  <div class="container">
    <h1><?= $action==='create' ? 'Tambah Paket' : 'Edit Paket' ?></h1>

    <?php if($errors): ?>
      <div class="alert alert-danger"><?php foreach($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
    <?php endif; ?>

    <form method="post" class="col-md-8">
      <div class="mb-3">
        <label class="form-label">Judul</label>
        <input name="title" class="form-control" value="<?= htmlspecialchars($data['title'] ?? '') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
      </div>
      <div class="row g-3">
        <div class="col-md-4 mb-3">
          <label class="form-label">Durasi</label>
          <input name="days" class="form-control" value="<?= htmlspecialchars($data['days'] ?? '') ?>">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Harga</label>
          <input name="price" class="form-control" value="<?= htmlspecialchars($data['price'] ?? '') ?>">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Image URL</label>
          <input name="img" class="form-control" value="<?= htmlspecialchars($data['img'] ?? '') ?>">
        </div>
      </div>

      <div class="row g-3">
        <div class="col-md-6 mb-3">
          <label class="form-label">Nomor Kontak Paket (contoh 6281234... tanpa '+')</label>
          <input name="contact_phone" class="form-control" value="<?= htmlspecialchars($data['contact_phone'] ?? '') ?>">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Kontak Penanggung Jawab (nama)</label>
          <input name="contact_name" class="form-control" value="<?= htmlspecialchars($data['contact_name'] ?? '') ?>">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Termasuk Tempat Wisata (pilih beberapa)</label>
        <select name="places[]" class="form-select" multiple>
          <?php foreach($places as $pl): $sel = in_array($pl['id'],$selected) ? 'selected' : ''; ?>
            <option value="<?= $pl['id'] ?>" <?= $sel ?>><?= htmlspecialchars($pl['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button class="btn btn-primary"><?= $action === 'create' ? 'Buat Paket' : 'Simpan Perubahan' ?></button>
      <a href="admin.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
  </div>
</section>
<?php include 'footer.php'; ?>
