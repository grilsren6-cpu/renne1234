-- Create database and sample data for Menuju Dieng
CREATE DATABASE IF NOT EXISTS menujudieng CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE menujudieng;

CREATE TABLE IF NOT EXISTS packages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  days VARCHAR(50),
  price VARCHAR(100),
  img VARCHAR(512),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO packages (title, description, days, price, img) VALUES
('Paket Sunrise Penanjakan','Nikmati sunrise spektakuler di salah satu spot terbaik.', '1 Hari','Rp300.000','https://images.unsplash.com/photo-1501785888041-af3ef285b470'),
('Paket Dieng 2 Hari','Kunjungi Telaga Warna, Kawah Sikidang, dan Candi Arjuna.','2 Hari','Rp650.000','https://images.unsplash.com/photo-1526779259212-5f3d52f3a7f7'),
('Paket Fotografi','Paket khusus untuk fotografer: spot terbaik dan guide fotografi.','2 Hari','Rp900.000','https://images.unsplash.com/photo-1500530855697-b586d89ba3ee');

-- Testimonials table and sample data
CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  message TEXT NOT NULL,
  img VARCHAR(512),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO testimonials (name, message, img) VALUES
('Andi','Perjalanan menyenangkan, guide ramah dan itinerary pas.','https://images.unsplash.com/photo-1544005313-94ddf0286df2'),
('Siti','Homestay nyaman dan pemandangan luar biasa.','https://images.unsplash.com/photo-1545996124-1b7a1f3f8bba');

-- Places / attractions (wisata) and sample data
CREATE TABLE IF NOT EXISTS places (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  location VARCHAR(255),
  img VARCHAR(512),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO places (name, description, location, img) VALUES
('Telaga Warna','Danau dengan warna air yang berubah-ubah karena kandungan mineralnya; spot foto populer.','Telaga Warna, Dieng','https://images.unsplash.com/photo-1470770903676-69b98201ea1c'),
('Kawah Sikidang','Kawah dengan aktivitas gas vulkanik yang mudah diakses; jangan terlalu dekat saat berkunjung.','Kawah Sikidang, Dieng','https://images.unsplash.com/photo-1504384308090-c894fdcc538d'),
('Candi Arjuna','Kompleks candi Hindu peninggalan kuno dengan pemandangan pegunungan sekitar.','Kompleks Candi Arjuna, Dieng','https://images.unsplash.com/photo-1526779259212-5f3d52f3a7f7'),
('Bukit Sikunir','Spot sunrise legendaris dengan pemandangan bukit bergelombang; cocok untuk trekking singkat.','Bukit Sikunir, Dieng','https://images.unsplash.com/photo-1500530855697-b586d89ba3ee');

-- Mapping table between packages and places
CREATE TABLE IF NOT EXISTS package_places (
  id INT AUTO_INCREMENT PRIMARY KEY,
  package_id INT NOT NULL,
  place_id INT NOT NULL,
  FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE CASCADE,
  FOREIGN KEY (place_id) REFERENCES places(id) ON DELETE CASCADE
);

-- Sample mappings: associate packages with some places
INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Sunrise Penanjakan' AND pl.name='Bukit Sikunir';

INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Dieng 2 Hari' AND pl.name='Telaga Warna';

INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Dieng 2 Hari' AND pl.name='Kawah Sikidang';

INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Fotografi' AND pl.name='Bukit Sikunir';

-- Additional sample packages
INSERT INTO packages (title, description, days, price, img) VALUES
('Paket Keluarga Dieng','Paket ramah keluarga: aktivitas ringan dan kunjungan edukatif untuk anak-anak.','2 Hari','Rp550.000','https://images.unsplash.com/photo-1493558103817-58b2924bce98'),
('Paket Adventure','Paket petualangan untuk pecinta alam: trekking dan offroad ke spot tersembunyi.','3 Hari','Rp1.200.000','https://images.unsplash.com/photo-1500534314209-a25ddb2bd429'),
('Paket Romantis','Paket pasangan: sunrise privat, makan malam romantis, dan penginapan cozy.','2 Hari','Rp1.000.000','https://images.unsplash.com/photo-1504198453319-5ce911bafcde');

-- Map the new packages to places
INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Keluarga Dieng' AND pl.name='Telaga Warna';
INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Keluarga Dieng' AND pl.name='Candi Arjuna';

INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Adventure' AND pl.name='Bukit Sikunir';
INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Adventure' AND pl.name='Kawah Sikidang';

INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Romantis' AND pl.name='Bukit Sikunir';
INSERT INTO package_places (package_id, place_id)
SELECT p.id, pl.id FROM packages p, places pl WHERE p.title='Paket Romantis' AND pl.name='Telaga Warna';

-- Ensure packages table has optional contact phone per package
ALTER TABLE packages ADD COLUMN IF NOT EXISTS contact_phone VARCHAR(50) DEFAULT NULL;

