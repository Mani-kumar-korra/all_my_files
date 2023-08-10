<?php

session_start();

echo "<h2>Welcome, " . $_SESSION["name"] . "!</h2>";

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
    <title>Tournament Web Project</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        .alert {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<header>
    <h1>Tournament Web Project</h1>
    <!-- Add navigation links or user profile info here -->
    <nav>
        <ul>
            <li><a href=home.php>Home</a></li>
            <li><a href="#">My Profile</a></li>
        </ul>
    </nav>
</header>

<main>
    <!-- Tournament Search Section -->
    <section id="tournament-search">
        <h2>Tournament Search</h2>
        <form method="post">
            <label for="location">Search by Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter location">

            <label for="sportcategory">Select Sport Category:</label>
            <select id="sportcategory" name="sportcategory">
                <option value="">-- Select Sport Category --</option>
                <option value="football">football</option>
                <option value="basketball">basketball</option>
                <option value="tennis">Tennis</option>
            </select>

            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" name="start-date">

            <label for="end-date">End Date:</label>
            <input type="date" id="end-date" name="end-date">

            <input type="submit" name="search" value="Search">
        </form>
    </section>

    <!-- Tournament Listings Section -->
    <section id="tournament-listings">
        <h2>Tournament Listings</h2>
        <?php
     
        require_once 'con/config1.php';
        require_once 'Tournament.php';

        // Create an instance of the Tournament class
        $tournament = new Tournament($db);

     
        if (isset($_POST['search'])) {
            // Retrieve form data
            $location = $_POST['location'];
            $sportCategory = $_POST['sportcategory'];
            $startDate = $_POST['start-date'];
            $endDate = $_POST['end-date'];

            if (!empty($location) || !empty($sportCategory) || !empty($startDate) || !empty($endDate)) {
                // Fetch tournament data from the database based on search criteria
                $tournaments = $tournament->searchTournaments($location, $sportCategory, $startDate, $endDate);

  
                foreach ($tournaments as $t) {
                    echo '<div class="tournament">';
                    echo '<h3>' . $t['name'] . '</h3>';
                    echo '<p>Tournament ID: ' . $t['tournament_id']. '</p>';
                    echo '<h3>' . $t['lname'] . '</h3>';
                    echo '<p>Date: ' . $t['date'] . '</p>';
                    echo '<p>Fee: $' . $t['fee'] . '</p>';

                    echo '<form method="post" action="index.php">';
                    echo '<input type="hidden" name="tournament_id" value="' . $t['tournament_id'] . '">';
                    echo '<input type="hidden" name="name" value="' . $t['name'] . '">';
                    echo '<input type="hidden" name="date" value="' . $t['date'] . '">';
                    echo '<input type="hidden" name="fee" value="' . $t['fee'] . '">';
                    echo '<input type="hidden" name="lname" value="' . $t['lname'] . '">';
                    echo '<input type="submit" name="book" value="Book Now">';
                    echo '</form>';

                    echo '</div>';
                }
            } else {
           
                echo '<p>No search criteria selected. Please select at least one criterion to search for tournaments.</p>';
            }
        }


        ?>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Tournament Web Project. All rights reserved.</p>
</footer>
<script>

</script>
</body>
</html>
