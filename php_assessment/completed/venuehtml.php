<?php
session_start();




if (!isset($_SESSION["email"])) {

    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Book Sports Venue</title>
    <link rel="stylesheet" href="css/venue.css">
</head>
<body>
<h1>Book Sports Venue</h1>
<h3><a href="home.php">Go Back</a></h3>
<form id="venueForm" method="post">
   
    <label for="location">Location:</label>
    <select name="location" id="location">
        <option value="Chennai">Chennai</option>
        <option value="Vizag">Vizag</option>
        <option value="Hyderabad">Hyderabad</option>
    </select>
    <br>

    <label for="sport">Sport:</label>
    <select name="sport" id="sport">
        <option value="tennis">Tennis</option>
        <option value="football">Football</option>
        <option value="basketball">Basketball</option>
    </select>
    <br>

    <label for="date">Date:</label>
    <input type="date" name="date" id="date" min="<?php echo date('Y-m-d'); ?>" required>
    <br>

    <label for="timeslot">Timeslot:</label>
    <select name="timeslot" id="timeslot" required>
        <option value="" disabled selected>Select Timeslot</option>
        <option value="10-12">10am - 12pm</option>
        <option value="12-2">12pm - 2pm</option>
        <option value="2-4">2pm - 4pm</option>
        <option value="4-6">4pm - 6pm</option>
    </select>
    <br>

    <button type="submit" id="searchButton">Search Venue</button>
</form>

<div id="venueResults"></div>

<script src="js/script.js"></script>
</body>
</html>
