<?php
session_start();

echo "<h3> " . $_SESSION["name"] . "!</h3>";
echo "<h3> user_ID = " . $_SESSION["user_id"] . "</h3>";

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Details</title>
    <link rel="stylesheet" href="css/updateaccounts.css">
</head>
<body>
<h4><a href="accounts.html">Back</a></h4>
<h4><a href="home.php">Home</a></h4>
<h3 class="update-heading">Update User Details</h3>


<form action="update_user.php" method="post" class="update-form">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" placeholder="Enter new name">
    <input type="submit" name="update_name" value="Update Name">
</form>


<form action="update_user.php" method="post" class="update-form">
    <label for="email">Email ID:</label>
    <input type="email" name="email" id="email" placeholder="Enter new email">
    <input type="submit" name="update_email" value="Update Email">
</form>


<form action="update_user.php" method="post" class="update-form">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="Enter new password">
    <input type="submit" name="update_password" value="Update Password">
</form>

</body>
</html>

</body>
</html>
