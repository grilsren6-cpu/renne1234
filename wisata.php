<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<section class="py-5">
  <div class="container">
    <h1>Wisata Dieng</h1>
    <p class="lead">Spot-spot wajib dikunjungi di Dieng.</p>

    <div class="row g-4 mt-3">
      <?php
      $places = [];
      $pdo = getPDO();
      if($pdo){
        try{
          $stmt = $pdo->query('SELECT * FROM places ORDER BY id ASC');
          $places = $stmt->fetchAll();
        }catch(Exception $e){
          error_log('Query places error: ' . $e->getMessage());
        }
      }

      if(empty($places)){
        $places = [
          ['name'=>'Telaga Warna','description'=>'Danau dengan warna air yang berubah-ubah karena kandungan mineralnya; spot foto populer.','location'=>'Telaga Warna, Dieng','img'=>'https://images.unsplash.com/photo-1470770903676-69b98201ea1c'],
          ['name'=>'Kawah Sikidang','description'=>'Kawah dengan aktivitas gas vulkanik yang mudah diakses; jangan terlalu dekat saat berkunjung.','location'=>'Kawah Sikidang, Dieng','img'=>'https://images.unsplash.com/photo-1504384308090-c894fdcc538d'],
          ['name'=>'Candi Arjuna','description'=>'Kompleks candi Hindu peninggalan kuno dengan pemandangan pegunungan sekitar.','location'=>'Kompleks Candi Arjuna, Dieng','img'=>'https://images.unsplash.com/photo-1526779259212-5f3d52f3a7f7'],
          ['name'=>'Bukit Sikunir','description'=>'Spot sunrise legendaris dengan pemandangan bukit bergelombang; cocok untuk trekking singkat.','location'=>'Bukit Sikunir, Dieng','img'=>'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee']
        ];
      }

      foreach($places as $pl): ?>
      <div class="col-sm-6 col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="<?= ($pl['img'] ?? '') ?>?auto=format&fit=crop&w=1200&q=60" class="card-img-top" alt="<?= htmlspecialchars($pl['name']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($pl['name']) ?></h5>
            <p class="small text-muted mb-2"><?= htmlspecialchars($pl['location'] ?? '') ?></p>
            <p class="card-text"><?= htmlspecialchars($pl['description'] ?? '') ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
