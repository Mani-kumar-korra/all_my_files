<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

echo "<h2> " . $_SESSION["name"] . "!</h2>";


if (!isset($_SESSION["email"])) {

    header("Location: login.php");
    exit();
}

require_once 'con/Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $location = $_POST["location"];
    $sport = $_POST["sport"];

    // Fetch matching academies from the database
    $sql_academies = "SELECT * FROM academies WHERE location = '$location' AND sportCategory = '$sport'";
    $result_academies = $conn->query($sql_academies);

    if ($result_academies->num_rows > 0) {
        while ($row_academy = $result_academies->fetch_assoc()) {
            $academy_name = $row_academy['name'];
            $academy_location = $row_academy['location'];
            $academy_email = $row_academy['contact_email'];

            echo "<div>
                    <p><strong>Academy Name:</strong> $academy_name</p>
                    <p><strong>Location:</strong> $academy_location</p>
                    <p><strong>Contact Email:</strong> $academy_email</p>
                    <button onclick='getCoachesAJaxCall({$row_academy['academy_id']})' class='get-coaches-button' data-academy-id='{$row_academy['academy_id']}'>Get Coaches</button>
                </div>";
        }
    } else {
        echo "<p>No academies found for the selected location and sport.</p>";
    }
}
$conn->close();