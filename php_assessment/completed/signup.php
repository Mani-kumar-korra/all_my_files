<?php



if (!isset($_SESSION["name"])) {

    header("Location: home.php");
    exit();
}

require 'con/Config.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
    } else {
        // Check if the email already exists
        $check_query = "SELECT * FROM signup WHERE email = '$email'";
        $result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            if (!preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/", $password)) {
                echo "<script>alert('Password should contain at least one special character and one digit, and be at least 6 characters long');</script>";
            } else {
                // Insert the new user
                $query = "INSERT INTO signup (name, email, password) VALUES ('$name', '$email', '$password')";
                if (mysqli_query($conn, $query)) {
                    echo "Signup successful. You can now login!";
                    header("Location: home.php");
                    exit;
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Insert Data</title>
</head>
<link rel="stylesheet" href="css/signup.css">
<style media="screen">
    label {
        display: block;
    }
</style>
<body>

<form class="" action="" method="post" autocomplete="off">
    <h2>Sign up for the sports app</h2>
    <label for="">Name</label>
    <input type="text" name="name" required value="">
    <label for="">Email</label>
    <input type="email" name="email" required value="">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$" required>
    <br>
    <button type="submit" name="submit">Submit</button>
</form>
</body>
</html>
