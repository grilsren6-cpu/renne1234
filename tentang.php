<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<section class="py-5">
  <div class="container">
    <h1>Tentang Kami</h1>
    <p class="lead">Kami adalah operator wisata lokal yang berpengalaman di Dieng. Misi kami: memperkenalkan keindahan Dieng secara bertanggung jawab.</p>

    <div class="row mt-4">
      <div class="col-md-6">
        <h5>Visi</h5>
        <p>Menjadi mitra perjalanan terpercaya untuk pengalaman Dieng yang tak terlupakan.</p>
      </div>
      <div class="col-md-6">
        <h5>Misi</h5>
        <ul>
          <li>Menyediakan paket berkualitas dan aman.</li>
          <li>Mendukung ekonomi lokal.</li>
          <li>Mengedukasi wisatawan soal pelestarian lingkungan.</li>
        </ul>
      </div>
    </div>

    <hr class="my-4">

    <h3>Tim Kami</h3>
    <div class="row g-4 mt-3">
      <?php
      $team = [
        ['name'=>'Budi','role'=>'Founder & Guide','img'=>'https://images.unsplash.com/photo-1544005313-94ddf0286df2'],
        ['name'=>'Maya','role'=>'Manajer Operasional','img'=>'https://images.unsplash.com/photo-1545996124-1b7a1f3f8bba'],
        ['name'=>'Andi','role'=>'Guide Senior','img'=>'https://images.unsplash.com/photo-1547425260-76bcadfb4f2c']
      ];
      foreach($team as $member): ?>
      <div class="col-sm-6 col-md-4">
        <div class="card text-center p-3">
          <img src="<?= $member['img'] ?>?auto=format&fit=crop&w=600&q=60" class="rounded-circle mx-auto" width="120" height="120" style="object-fit:cover">
          <div class="card-body">
            <h5 class="card-title mb-0"><?= htmlspecialchars($member['name']) ?></h5>
            <small class="text-muted"><?= htmlspecialchars($member['role']) ?></small>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-4">
      <h5>Kontak Perusahaan</h5>
      <p>Untuk kerja sama dan informasi: <a href="https://wa.me/<?= $contact_phone ?>" target="_blank">Chat <?= htmlspecialchars($contact_name) ?></a></p>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
