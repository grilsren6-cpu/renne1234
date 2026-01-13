<?php
session_start();
include 'config.php';
$pkg_id = isset($_GET['pkg_id']) ? (int)$_GET['pkg_id'] : 0;
// if user not logged in, redirect to user_login with return url
if(empty($_SESSION['user_name'])){
  $return = 'book.php?pkg_id=' . $pkg_id;
  header('Location: user_login.php?return=' . urlencode($return)); exit;
}

$pdo = getPDO();
$pkg = null;
if($pdo && $pkg_id){
  $stmt = $pdo->prepare('SELECT * FROM packages WHERE id = ?');
  $stmt->execute([$pkg_id]); $pkg = $stmt->fetch();
}

// Determine phone to contact: package-specific first, else global
$phone = $pkg['contact_phone'] ?? ($contact_phone ?? null);
$contact_name_pkg = $pkg['contact_name'] ?? null;
$user = $_SESSION['user_name'];
$title = $pkg['title'] ?? 'paket wisata';

if(!$phone){
  // fallback to contact page
  header('Location: kontak.php'); exit;
}

$message = rawurlencode("Halo $contact_name_pkg, saya $user ingin memesan $title. Mohon info lanjut.");
$wa = "https://wa.me/{$phone}?text={$message}";
header('Location: ' . $wa);
exit;
