<?php
// Common header included on every page
if(session_status() !== PHP_SESSION_ACTIVE){ session_start(); }
$user_name = $_SESSION['user_name'] ?? null;
$is_admin = $_SESSION['is_admin'] ?? false;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menuju Dieng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/menuju-dieng/assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/menuju-dieng/">Menuju Dieng</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/paket.php">Paket</a></li>
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/wisata.php">Wisata Dieng</a></li>
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/homestay.php">Homestay</a></li>
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/testimoni.php">Testimoni</a></li>
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/tentang.php">Tentang Kami</a></li>
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/kontak.php">Kontak</a></li>
          <?php if($user_name): ?>
            <li class="nav-item"><a class="nav-link" href="/menuju-dieng/user_logout.php">Halo, <?= htmlspecialchars($user_name) ?> (Logout)</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="/menuju-dieng/user_login.php">Masuk</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="/menuju-dieng/admin_login.php">Admin</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
