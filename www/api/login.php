<?php
require 'config.php';

header('Content-Type: application/json; charset=utf-8');
$input = json_decode(file_get_contents("php://input"), true);

$user = trim($input["username"] ?? "");
$pass_hash_client = $input["password_hash"] ?? "";

if ($user === "" || $pass_hash_client === "") {
  echo json_encode(["ok" => false, "error" => "Thiếu thông tin đăng nhập"]);
  exit;
}

$stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
$stmt->execute([$user]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
  echo json_encode(["ok" => false, "error" => "Sai tài khoản hoặc mật khẩu"]);
  exit;
}

/* ✅ Kiểm tra mật khẩu */
if (password_verify($pass_hash_client, $row["password_hash"])) {
  $_SESSION["user_id"] = $row["id"];
  $_SESSION["username"] = $row["username"];
  echo json_encode(["ok" => true, "user" => $row["username"]]);
} else {
  echo json_encode(["ok" => false, "error" => "Sai tài khoản hoặc mật khẩu"]);
}
