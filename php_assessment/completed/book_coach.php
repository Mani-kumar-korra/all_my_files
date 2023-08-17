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
    if (isset($_POST["coach_name"]) && isset($_POST["academy_id"]) && isset($_POST["sport"]) && isset($_SESSION["user_id"])) {

    $coachName = $_POST["coach_name"];
    $academyId = $_POST["academy_id"];
    $sport = $_POST["sport"];
    $user_id = $_SESSION["user_id"];
    $coach_id =$_POST["coach_id"];
    $coach_price= $_POST['coach_price'];

   
    $sql = "INSERT INTO booked_coaches (user_id, sport, coach, academy, coach_id,coach_price) VALUES (?, ?, ?, ?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $user_id, $sport, $coachName, $academyId,$coach_id,$coach_price);
    $stmt->execute();
        if ($stmt->execute()) {
            echo "successfully booked";
        } else {
            echo "error: " . $stmt->error;
        }
    } else {
        echo "error: Required data not provided.";
    }
}

$conn->close();
?>
