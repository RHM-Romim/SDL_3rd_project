<?php 
include("db_secure.php");
include("inputScanner.php"); // Include the input scanner
?>

<form method="post" action="./api/register.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" name="register" value="Register">
</form>


