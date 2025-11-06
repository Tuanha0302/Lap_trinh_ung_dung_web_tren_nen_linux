<?php
session_start();

$host = 'mariadb';        // Tên service Docker Compose
$db   = 'iot_monitoring';
$user = 'iotuser';
$pass = 'iot123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    die(json_encode([
        "ok" => false,
        "error" => "Không thể kết nối DB: " . $e->getMessage()
    ]));
}
