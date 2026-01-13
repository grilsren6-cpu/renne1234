<?php
session_start();
include 'config.php';
$error = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $user = $_POST['user'] ?? '';
  $pass = $_POST['pass'] ?? '';
  if($user === $admin_user && $pass === $admin_pass){
    $_SESSION['is_admin'] = true;
    header('Location: admin.php'); exit;
  }else{
    $error = 'Kredensial salah.';
  }
}
include 'header.php';
?>
<section class="py-5">
  <div class="container">
    <h1>Admin Login</h1>
    <?php if($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" class="col-md-6">
      <div class="mb-3">
        <label class="form-label">User</label>
        <input name="user" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="pass" type="password" class="form-control" required>
      </div>
      <button class="btn btn-primary">Login</button>
    </form>
  </div>
</section>
<?php include 'footer.php'; ?>
