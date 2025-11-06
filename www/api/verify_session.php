<?php
require 'config.php';

if (isset($_SESSION["user_id"])) {
  echo json_encode(["ok" => true, "user" => $_SESSION["username"]]);
} else {
  echo json_encode(["ok" => false]);
}
