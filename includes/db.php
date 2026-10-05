<?php
session_start();

// Keep one token for this session so forms in different tabs still work.
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$host = '127.0.0.1';
$port = '3307';
$dbname = 'bakery_store';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die('تعذر الاتصال بقاعدة البيانات. تحقق من إعدادات السيرفر المحلي.');
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function getCartCount() {
    $count = 0;
    foreach ($_SESSION['cart'] as $qty) {
        $count += $qty;
    }
    return $count;
}