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

    $academy_id = $_POST["academy_id"];
    $sport = $_POST["sport"];


    $sql_coaches = "SELECT * FROM coaches WHERE academy_id = '$academy_id' AND sport = '$sport'";
    $result_coaches = $conn->query($sql_coaches);

    if ($result_coaches->num_rows > 0) {
        echo "<h3>Coaches for Academy (Sport: {$sport})</h3>";
        while ($row_coach = $result_coaches->fetch_assoc()) {
            $coach_id = $row_coach['coach_id'];
            $coach_name = $row_coach['name'];
            $coach_price = $row_coach['price'];

            echo "<div>
                    <p><strong>Coach Name:</strong> $coach_name</p>
                    <p><strong>Price:</strong> $coach_price</p>
                    <button onclick='buyButtonAjaxCall($coach_id,$coach_price,this)' 
                    class='buy-button' data-coach-id='$coach_id'
                    data-coach-name='{$coach_name}' data-academy-id='{$academy_id}'>Book Coach</button>
                </div>";
        }
    } else {
        echo "<p>No coaches found for the selected sport in this academy.</p>";
    }
}
$conn->close();
?>
