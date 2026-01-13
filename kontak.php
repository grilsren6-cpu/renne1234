<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<section class="py-5 bg-light">
  <div class="container">
    <h1>Kontak & Pemesanan</h1>
    <p class="lead">Hubungi kami untuk informasi lebih lanjut atau pemesanan paket.</p>

    <div class="row mt-4">
      <div class="col-md-6">
        <form method="post" action="kontak.php">
          <?php
          $success = '';
          if($_SERVER['REQUEST_METHOD']==='POST'){
            $name = htmlspecialchars($_POST['name'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $message = htmlspecialchars($_POST['message'] ?? '');
            // For local demo we just show a success message. Integrate mail() when ready.
            $success = "Terima kasih, $name. Pesan Anda telah diterima.";
          }
          ?>
          <?php if($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
          <?php endif; ?>

          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Pesan</label>
            <textarea name="message" rows="4" class="form-control" required></textarea>
          </div>
          <button class="btn btn-primary">Kirim</button>
        </form>
      </div>

      <div class="col-md-6">
        <h5>Alamat</h5>
        <p>Dieng Plateau, Wonosobo, Jawa Tengah</p>
        <h5>Telepon</h5>
        <p>
          <?php $phoneDisplay = preg_replace('/^(62)/','+\1', $contact_phone ?? '6281234567890'); ?>
          <a href="tel:+<?= $contact_phone ?>" class="text-decoration-none"><?= $phoneDisplay ?></a>
        </p>
        <h5>WhatsApp</h5>
        <p>
          <?php $waLink = 'https://wa.me/' . ($contact_phone ?? '6281234567890'); ?>
          <a href="<?= $waLink ?>" target="_blank" class="btn btn-success btn-sm">Chat via WhatsApp</a>
        </p>
        <h5>Email</h5>
        <p>info@menujudieng.example</p>
      </div>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
