# Menuju Dieng — PHP Website

Sebuah situs demo sederhana berbasis PHP (untuk Laragon / XAMPP / local PHP server).

Fitur:

Cara pakai:
1. Salin folder ini ke `d:/laragon/www/` sehingga path menjadi `d:/laragon/www/menuju-dieng`.
2. Jalankan Laragon / XAMPP dan buka: `http://localhost/menuju-dieng/`
3. Halaman kontak memiliki form demo yang menampilkan pesan sukses setelah submit (tidak mengirim email secara otomatis).

Menambahkan database
1. Edit `config.php` jika perlu untuk menyesuaikan `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`.
2. Import skema dan data contoh (`migrations.sql`) ke MySQL (Laragon memiliki `mysql` di PATH). Contoh via PowerShell:

```powershell
cd d:/laragon/www/menuju-dieng
mysql -u root < migrations.sql
```

Jika Anda menggunakan phpMyAdmin, buat database bernama `menujudieng` lalu impor `migrations.sql`.

Setelah import, halaman `index.php` dan `paket.php` akan menampilkan data paket dari database.

Catatan: `migrations.sql` kini juga membuat tabel `testimonials` dan menyisipkan contoh testimoni. Import file yang sama untuk menambah data testimoni.

Tambahan: `migrations.sql` juga sekarang membuat tabel `places` (wisata) dan menyisipkan contoh beberapa tempat wisata populer di Dieng. Setelah import, buka `wisata.php` untuk melihat daftar yang terisi dari database.

Tambahan paket berisi informasi tempat wisata: migrasi kini juga menambahkan mapping `package_places` sehingga setiap paket dapat dikaitkan dengan beberapa `places`. Setelah import, halaman `paket.php` akan menampilkan tempat yang termasuk di setiap paket.

Sesuaikan gambar, teks, dan integrasi email sesuai kebutuhan.

Admin panel:
- Buka `http://localhost/menuju-dieng/admin_login.php` untuk masuk.
- Default kredensial: user `admin`, password `admin123` (ubah di `config.php`).
- Setelah login, Anda dapat menambah, mengedit, dan menghapus paket; saat menambah/edit, pilih tempat wisata yang termasuk.

User login & booking flow:
- Pengguna harus login sederhana (nama) sebelum memesan. Buka `user_login.php` atau klik tombol `Pesan` pada paket; jika belum login, sistem akan minta login dan kembali melanjutkan pesanan.
- Jika paket memiliki nomor kontak khusus (diatur di admin saat membuat paket), pemesanan akan langsung membuka WhatsApp ke nomor itu dan menyertakan nama pengguna di pesan.
