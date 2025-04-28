<?php include("db.php"); ?>

<form method="post" action="">
    <input type="text" name="username" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="submit" name="login" value="Login">
</form>

<?php
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // ❌ Vulnerable to SQL Injection
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "✅ Login Successful";
    } else {
        echo "❌ Invalid credentials";
    }
}
?>
