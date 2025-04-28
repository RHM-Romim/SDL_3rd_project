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

//$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$hashed = password_hash($pass, PASSWORD_BCRYPT);
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->execute([$user,$hashed]);
echo $user."<br>".$hashed."<br>";
//$stmt->store_result();
if ($stmt->rowCount() > 0) {
    
   

   
        echo json_encode(["status" => "success", "message" => "Login successful."]);
   
    }
 else {
    echo json_encode(["status" => "error", "message" => "Wrong password."]);
   
}
?>
