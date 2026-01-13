<?php
// Database configuration for Menuju Dieng
// Update these values to match your local environment (Laragon/XAMPP)
$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_name = getenv('DB_NAME') ?: 'menujudieng';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';

function getPDO(){
    global $db_host, $db_name, $db_user, $db_pass;
    static $pdo = null;
    if($pdo) return $pdo;
    $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
    try{
        $pdo = new PDO($dsn, $db_user, $db_pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }catch(PDOException $e){
        error_log('DB connection error: ' . $e->getMessage());
        return null;
    }
    return $pdo;
}

// Contact defaults (phone in international format without '+', e.g. 6281234567890)
$contact_phone = getenv('CONTACT_PHONE') ?: '6281234567890';
$contact_name = getenv('CONTACT_NAME') ?: 'Menuju Dieng';

// Simple admin credentials for local admin panel (change in production)
$admin_user = getenv('ADMIN_USER') ?: 'admin';
$admin_pass = getenv('ADMIN_PASS') ?: 'admin123';


