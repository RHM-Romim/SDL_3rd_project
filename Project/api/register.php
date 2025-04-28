<?php
header("Content-Type: application/json");

require_once("../db_secure.php");
require_once("../inputScanner.php");

//$data = json_decode(file_get_contents("php://input"), true);
$data=$_POST;
$user = $data['username'] ?? '';
$pass = $data['password'] ?? '';

if (isMalicious($user) || isMalicious($pass)) {
    echo json_encode(["status" => "error", "message" => "Malicious input detected."]);
    exit();
}

if (empty($user) || empty($pass)) {
    echo json_encode(["status" => "error", "message" => "All fields are required."]);
    exit();
}

$hashed = password_hash($pass, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
//$stmt->bind_param("ss", $user, $hashed);

if ($stmt->execute([$user, $hashed])) {
    echo json_encode(["status" => "success", "message" => "User registered successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Username might already exist."]);
}
?>
