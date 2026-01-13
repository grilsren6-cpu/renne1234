<?php
session_start();
include 'header.php';
$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = trim($_POST['name'] ?? '');
  if($name === ''){
    $error = 'Nama wajib diisi.';
  }else{
    $_SESSION['user_name'] = $name;
    // redirect back if provided
    $return = $_GET['return'] ?? ($_POST['return'] ?? null);
    if($return){ header('Location: ' . $return); } else { header('Location: index.php'); }
    exit;
  }
}
?>
<section class="py-5">
  <div class="container">
    <h1>Login Pengguna</h1>
    <p class="small text-muted">Masuk dengan nama untuk melanjutkan pemesanan.</p>
    <?php if($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post" class="col-md-6">
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input name="name" class="form-control" value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>">
      </div>
      <input type="hidden" name="return" value="<?= htmlspecialchars($_GET['return'] ?? '') ?>">
      <button class="btn btn-primary">Masuk</button>
    </form>
  </div>
</section>
<?php include 'footer.php'; ?>
