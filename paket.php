<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<section class="py-5">
  <div class="container">
    <h1>Paket Wisata</h1>
    <p class="lead">Pilih paket yang cocok untuk liburanmu di Dieng.</p>

    <div class="row g-4 mt-3">
      <?php
      $pakets = [];
      $pdo = getPDO();
      if($pdo){
        try{
          $stmt = $pdo->query('SELECT * FROM packages ORDER BY id ASC');
          $pakets = $stmt->fetchAll();
        }catch(Exception $e){
          error_log('Query packages error: ' . $e->getMessage());
          $pakets = [];
        }
      }

      if(empty($pakets)){
        $pakets = [
          ['title'=>'Sunrise & Telaga Warna','desc'=>'Kunjungi spot sunrise terbaik dan Telaga Warna. Termasuk transport, guide dan makan.','price'=>'Rp300.000','days'=>'1 Hari','img'=>'https://images.unsplash.com/photo-1501785888041-af3ef285b470'],
          ['title'=>'Dieng Explorer','desc'=>'Wisata ke Kawah Sikidang, Arjuna Temple Complex, dan lebih.','price'=>'Rp650.000','days'=>'2 Hari','img'=>'https://images.unsplash.com/photo-1526779259212-5f3d52f3a7f7'],
          ['title'=>'Paket Fotografi Premium','desc'=>'Termasuk guide fotografi, spot terbaik untuk sunrise dan milky way.','price'=>'Rp900.000','days'=>'2 Hari','img'=>'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee']
        ];
      }

      foreach($pakets as $p): ?>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="<?= ($p['img'] ?? $p['img']) ?>?auto=format&fit=crop&w=1200&q=60" class="card-img-top" alt="<?= htmlspecialchars($p['title'] ?? $p['title']) ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $p['title'] ?? $p['title'] ?></h5>
            <p class="card-text flex-grow-1"><?= $p['description'] ?? ($p['desc'] ?? '') ?></p>
            <?php
            // Fetch included places for this package if available
            $includedPlaces = [];
            if(isset($p['id']) && $pdo){
              try{
                $stmt2 = $pdo->prepare('SELECT pl.name FROM places pl JOIN package_places pp ON pl.id=pp.place_id WHERE pp.package_id = ?');
                $stmt2->execute([$p['id']]);
                $includedPlaces = $stmt2->fetchAll(PDO::FETCH_COLUMN);
              }catch(Exception $e){
                error_log('Fetch included places error: ' . $e->getMessage());
                $includedPlaces = [];
              }
            }else{
              $includedPlaces = $p['includes'] ?? [];
            }
            if(!empty($includedPlaces)):
            ?>
            <div class="mb-2">
              <?php foreach($includedPlaces as $pl): ?>
                <span class="badge bg-secondary me-1"><?= htmlspecialchars($pl) ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger"><?= $p['price'] ?? ($p['price'] ?? '') ?></span>
              <?php
              // Link booking goes to book.php which ensures user login then redirects to WhatsApp
              $pkgId = $p['id'] ?? null;
              $bookLink = $pkgId ? "book.php?pkg_id={$pkgId}" : 'kontak.php';
              ?>
              <a href="<?= $bookLink ?>" class="btn btn-sm btn-success">Pesan</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
