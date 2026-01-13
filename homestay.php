<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<section class="py-5 bg-light">
  <div class="container">
    <h1>Homestay Rekomendasi</h1>
    <p class="lead">Penginapan nyaman dekat spot wisata Dieng.</p>

    <div class="row g-4 mt-3">
      <?php
      $homes = [
        ['name'=>'Homestay Bukit Asri','price'=>'Rp250.000/malam','img'=>'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267'],
        ['name'=>'Villa Sunrise','price'=>'Rp450.000/malam','img'=>'https://images.unsplash.com/photo-1505691723518-34d2b8e1b6b6'],
        ['name'=>'Rumah Joglo Dieng','price'=>'Rp200.000/malam','img'=>'https://images.unsplash.com/photo-1505691723518-34d2b8e1b6b6']
      ];
      foreach($homes as $h): ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="<?= $h['img'] ?>?auto=format&fit=crop&w=1200&q=60" class="card-img-top" alt="<?= $h['name'] ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $h['name'] ?></h5>
            <p class="fw-bold text-danger"><?= $h['price'] ?></p>
            <?php
            $phone = $contact_phone ?? '6281234567890';
            $message = rawurlencode('Halo, saya ingin booking homestay: ' . ($h['name'] ?? ''));
            $waLink = "https://wa.me/{$phone}?text={$message}";
            ?>
            <a href="<?= $waLink ?>" target="_blank" class="btn btn-sm btn-success">Booking via WhatsApp</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
