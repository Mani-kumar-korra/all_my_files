<?php

session_start();




if (!isset($_SESSION["email"])) {

    header("Location: login.php");
    exit();
}



require_once 'con/newConfig.php';

class OrderPlacement
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function placeOrder($data)
    {
       
        $venueName = mysqli_real_escape_string($this->conn, $data['venueName']);
        $sport = mysqli_real_escape_string($this->conn, $data['sport']);
        $price = floatval($data['price']);
        $location = mysqli_real_escape_string($this->conn, $data['location']);
        $date = mysqli_real_escape_string($this->conn, $data['date']);
        $timeslot = mysqli_real_escape_string($this->conn, $data['timeslot']);
        $userId = mysqli_real_escape_string($this->conn, $_SESSION["user_id"]);
        $venueId = mysqli_real_escape_string($this->conn, $data['venueId']);

        $query = "INSERT INTO ordered_venue (venue_id, venue_name, location, sport, timeslot, date, user_id, venue_price) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssd", $venueId, $venueName, $location, $sport, $timeslot, $date, $userId, $price);
        $result = $stmt->execute();

        if ($result) {
            echo "Order placed successfully!";
        } else {
            echo "Failed to place the order: " . $this->conn->error;
        }
    }
}

// Handle the AJAX 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    $config = new Config();
    $conn = $config->getConnection();

    $orderPlacement = new OrderPlacement($conn);
    $data = json_decode(file_get_contents('php://input'), true);

    $orderPlacement->placeOrder($data);
}
?>
