<?php
session_start();
include 'config.php';
if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){
  header('Location: admin_login.php'); exit;
}
$pdo = getPDO();
// Handle delete
if(isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])){
  $id = (int)$_GET['id'];
  if($pdo){
    $stmt = $pdo->prepare('DELETE FROM packages WHERE id = ?');
    $stmt->execute([$id]);
  }
  header('Location: admin.php'); exit;
}
include 'header.php';
?>
<section class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>Admin — Paket</h1>
      <div>
        <a href="package_form.php?action=create" class="btn btn-success me-2">Tambah Paket</a>
        <a href="admin_logout.php" class="btn btn-secondary">Logout</a>
      </div>
    </div>

    <?php
    $packages = [];
    if($pdo){
      try{ $stmt = $pdo->query('SELECT * FROM packages ORDER BY id DESC'); $packages = $stmt->fetchAll(); }
      catch(Exception $e){ error_log($e->getMessage()); }
    }
    ?>

    <table class="table table-dark table-striped">
      <thead>
        <tr><th>ID</th><th>Judul</th><th>Durasi</th><th>Harga</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach($packages as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['title']) ?></td>
          <td><?= htmlspecialchars($p['days']) ?></td>
          <td><?= htmlspecialchars($p['price']) ?></td>
          <td>
            <a href="package_form.php?action=edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
            <a href="admin.php?action=delete&id=<?= $p['id'] ?>" onclick="return confirm('Hapus paket ini?')" class="btn btn-sm btn-danger">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
<?php include 'footer.php'; ?>
