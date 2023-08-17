<?php
session_start();

if (isset($_SESSION["name"])) {
    header("Location: home.php");
    exit();
}
require 'con/Config.php';

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM signup WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row && $password == $row["password"]) {
        $_SESSION["email"] = $row["email"];
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["name"] = $row["name"];
        header("Location: home.php");
        exit();
    } else {
        echo "<script> alert('Wrong Password or Email'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<link rel="stylesheet" href="css/login.css">
<style media="screen">
    * {
        user-select: none;
    }

  
</style>

<body>
<form  method="post">

    <h2>Login</h2>
    Email <input type="text" name="email" value=""> <br>
    Password <input type="password" name="password" value=""> <br>
   
    <button type="submit" name="submit">Login</button>
    <a href="signup.php">Registration</a>
</form>
<br>
</body>

</html>
