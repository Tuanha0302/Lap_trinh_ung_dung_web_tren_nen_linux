<?php
require 'config.php';

if (!isset($_SESSION["user_id"])) {
  http_response_code(403);
  echo json_encode(["ok" => false, "error" => "Chưa đăng nhập"]);
  exit;
}

$stmt = $pdo->query("SELECT id AS sensor_id, name, value, unit, UNIX_TIMESTAMP(updated_at) AS ts FROM sensors ORDER BY id ASC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["ok" => true, "data" => $data]);
