<?php include 'header.php'; ?>

<!-- Hero: Netflix-like dark background with big heading -->
<section class="hero d-flex align-items-center text-white">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Menuju Dieng</h1>
    <p class="lead">Jelajahi dataran tinggi Dieng — paket wisata, homestay, dan pengalaman lokal.</p>
    <div class="d-flex justify-content-center gap-2">
      <a href="paket.php" class="btn btn-danger btn-lg">Lihat Paket</a>
      <a href="wisata.php" class="btn btn-outline-light btn-lg">Wisata Dieng</a>
    </div>
  </div>
</section>

<!-- Featured packages -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="mb-4">Paket Populer</h2>
    <div class="row g-4">
      <?php
      include 'config.php';
      $pakets = [];
      $pdo = getPDO();
      if($pdo){
        try{
          $stmt = $pdo->query('SELECT * FROM packages ORDER BY id ASC LIMIT 3');
          $pakets = $stmt->fetchAll();
        }catch(Exception $e){
          error_log('Index packages query error: ' . $e->getMessage());
        }
      }
      if(empty($pakets)){
        $pakets = [
          ['title'=>'Paket Sunrise Penanjakan','days'=>'1 Hari','price'=>'Rp300.000','img'=>'https://images.unsplash.com/photo-1501785888041-af3ef285b470'],
          ['title'=>'Paket Dieng 2 Hari','days'=>'2 Hari','price'=>'Rp650.000','img'=>'https://images.unsplash.com/photo-1526779259212-5f3d52f3a7f7'],
          ['title'=>'Paket Fotografi','days'=>'2 Hari','price'=>'Rp900.000','img'=>'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee']
        ];
      }
      foreach($pakets as $p): ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="<?= ($p['img'] ?? $p['img']) ?>?auto=format&fit=crop&w=1200&q=60" class="card-img-top" alt="<?= htmlspecialchars($p['title'] ?? $p['title']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $p['title'] ?? $p['title'] ?></h5>
            <p class="card-text">Durasi: <?= $p['days'] ?? ($p['days'] ?? '') ?></p>
            <p class="fw-bold text-danger"><?= $p['price'] ?? ($p['price'] ?? '') ?></p>
            <a href="paket.php" class="stretched-link">Detail paket</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Gallery -->
<section class="py-5">
  <div class="container">
    <h2 class="mb-4">Galeri Dieng</h2>
    <div class="row g-3">
      <?php
      $gallery = [
        'https://images.unsplash.com/photo-1504384308090-c894fdcc538d',
        'https://images.unsplash.com/photo-1542317854-2d6a8a6b5d5d',
        'https://images.unsplash.com/photo-1470770903676-69b98201ea1c',
        'https://images.unsplash.com/photo-1526481280698-2f84b9f8f0d6'
      ];
      foreach($gallery as $img): ?>
      <div class="col-sm-6 col-md-3">
        <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
          <img src="<?= $img ?>?auto=format&fit=crop&w=800&q=60" class="img-cover" alt="Dieng">
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
