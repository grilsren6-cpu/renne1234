<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<section class="py-5">
  <div class="container">
    <h1>Testimoni</h1>
    <p class="lead">Apa kata tamu tentang perjalanan mereka ke Dieng bersama kami.</p>

    <div class="row g-4 mt-3">
      <?php
      $testi = [];
      $pdo = getPDO();
      if($pdo){
        try{
          $stmt = $pdo->query('SELECT * FROM testimonials ORDER BY created_at DESC');
          $testi = $stmt->fetchAll();
        }catch(Exception $e){
          error_log('Query testimonials error: ' . $e->getMessage());
        }
      }

      if(empty($testi)){
        $testi = [
          ['name'=>'Andi','msg'=>'Perjalanan menyenangkan, guide ramah dan itinerary pas.','img'=>'https://images.unsplash.com/photo-1544005313-94ddf0286df2'],
          ['name'=>'Siti','msg'=>'Homestay nyaman dan pemandangan luar biasa.','img'=>'https://images.unsplash.com/photo-1545996124-1b7a1f3f8bba']
        ];
      }

      foreach($testi as $t): ?>
      <div class="col-md-6">
        <div class="d-flex gap-3 align-items-start bg-white rounded p-3">
          <img src="<?= ($t['img'] ?? '') ?>?auto=format&fit=crop&w=200&q=60" class="rounded-circle" width="80" height="80" alt="<?= htmlspecialchars($t['name']) ?>">
          <div>
            <h5 class="mb-1"><?= htmlspecialchars($t['name']) ?></h5>
            <p class="mb-0 text-muted">"<?= htmlspecialchars($t['message'] ?? ($t['msg'] ?? '')) ?>"</p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
