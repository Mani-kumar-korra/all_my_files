<?php
// Start the session
session_start();

echo "<h2> Welcome " . $_SESSION["name"] . "!</h2>";


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
    <title>Document</title>

    <link rel="stylesheet" href="css/home.css">
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<!--<div id="background-image"> <img src="css/bg1.jpg" alt="img"></div>-->
<header>
    <h1>welcome to sports App</h1>

</header>
<nav>
    <ul>
        <li><a href= "venuehtml.php">Facilities</a></li>
        <li><a href="newcoach.php">Coaching</a></li>
        <li><a href="index.php">Tournaments</a></li>
        <li><a href="accounts.html">Accounts</a></li>

    </ul>
</nav>
<div class="cta-buttons">
<!--    <a href="signup.php">Signup</a>-->
<!--    <a href="login.php">Login</a>-->
    <a href="logout.php">Logout</a>

</div>
<main>
    <!-- Add your main content here -->
    <h2>About Sports App</h2>
    <p>Welcome to our Sports App, where you can explore and enjoy various sports facilities, discover sports academies and coaches, and participate in exciting tournaments.</p>
    <p>Click on the navigation links above to explore different sections of the app.</p>
</main>
</body>
</html>

    
</body>
</html>