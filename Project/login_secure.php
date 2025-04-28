<?php include("db_secure.php");
    include("inputScanner.php");
?>

<form method="post" action="./api/login.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" name="login" value="Login">
</form>

<?php
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // ✅ Safe from SQLi
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$user, $pass]);

    if (isMalicious($user) || isMalicious($pass)) {
        echo "⚠️ Malicious input detected. Access denied.";
        exit();
    }
    
    if ($stmt->rowCount() > 0) {
        echo "✅ Secure Login Successful";
    } else {
        echo "❌ Invalid Credentials";
    }
}
?>
