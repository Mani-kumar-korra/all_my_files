<?php
session_start();
require_once "update.php";

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
$updateMessage = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $db = new Database();

   
    if ($db->connect()) {
        $user_id = $_SESSION["user_id"];

        if (isset($_POST["update_name"])) {
            // Update name
            $name = $_POST["name"];
            $table = "signup";
            $field = "name";
            if ($db->update($table, $field, $name, $user_id)) {
                echo "Name updated successfully!";
            } else {
                echo "Failed to update name.";
            }
        } elseif (isset($_POST["update_email"])) {
            // Update email
            $email = $_POST["email"];
            $table = "signup";
            $field = "email";
            if ($db->update($table, $field, $email, $user_id)) {
                echo "Email updated successfully!";
            } else {
                echo "Failed to update email.";
            }
        } elseif (isset($_POST["update_password"])) {
            
            $password = $_POST["password"];
            $table = "signup";
            $field = "password";
            if ($db->update($table, $field, $password, $user_id)) {
                echo "Password updated successfully!";

            } else {
                echo "Failed to update password.";
            }
        }

        
        $db->close();
    } else {
        echo "Failed to connect to the database.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update User Details</title>
</head>
<body>
<h1>Update User Details</h1>
<?php echo "<p>$updateMessage</p>"; ?>

<a href="update_form.php">Back</a>
<a href="home.php">Home</a>
</body>
</html>
