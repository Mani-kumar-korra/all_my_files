<!DOCTYPE html>
<html>
<head>
    <title>Styled Output</title>
    <style>
        body {
            background-color: white;
            color: black;
            font-family: Arial, sans-serif;
        }

        h3 {
            color: black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: black;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        div {
            border: 1px solid black;
            padding: 10px;
            margin-bottom: 20px;
        }

        h2 {
            color: #ff0000; /* Minimal red color */
            margin-bottom: 10px;
        }
    </style>
</head>
<body>


<?php
session_start();

echo "<h3> " . $_SESSION["name"] . "!</h3>";

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

require_once 'con/newConfig.php';

class BookedTournaments {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayBookedTournaments() {
        $email = $_SESSION["email"];
        $sql = "SELECT * FROM booked_tournaments WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<div style="border: 1px solid black; padding: 10px;">';
                echo '<h2>Booked Tournaments</h2>';
                echo '<table style="border-collapse: collapse; width: 100%;">';
                echo '<tr><th>Order ID</th><th>Tournament ID</th><th>Location</th><th>Sport Category</th><th>Date</th><th>Fee</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["order_id"] . '</td>';
                    echo '<td>' . $row["tournament_id"] . '</td>';
                    echo '<td>' . $row["location"] . '</td>';
                    echo '<td>' . $row["sportcategory"] . '</td>';
                    echo '<td>' . $row["date"] . '</td>';
                    echo '<td>' . $row["fee"] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';
            } else {
                echo "No results found for booked tournaments.";
            }

            $stmt->close();
        } else {
            echo "Error in the SQL query: " . $this->conn->error;
        }
    }
}

class BookedCoaches {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayBookedCoaches() {
        $user_id = $_SESSION["user_id"]; // Corrected the variable name to "user_id"
        $sql = "SELECT * FROM booked_coaches WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<div style="border: 1px solid black; padding: 10px;">';
                echo '<h2>Booked Coaches</h2>';
                echo '<table style="border-collapse: collapse; width: 100%;">';
                echo '<tr><th>Booking ID</th><th>User ID</th><th>Sport</th><th>Coach</th><th>Academy</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["booking_id"] . '</td>';
                    echo '<td>' . $row["user_id"] . '</td>';
                    echo '<td>' . $row["sport"] . '</td>';
                    echo '<td>' . $row["coach"] . '</td>';
                    echo '<td>' . $row["academy"] . '</td>';
                    echo '<td>' . $row["coach_id"] . '</td>';
                    echo '<td>' . $row["coach_price"] . '</td>';


                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';
            } else {
                echo "No results found for booked coaches.";
            }

            $stmt->close();
        } else {
            echo "Error in the SQL query: " . $this->conn->error;
        }
    }
}

class BookedVenues {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayBookedVenues() {
        $user_id = $_SESSION["user_id"];
        $sql = "SELECT * FROM ordered_venue WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo '<div style="border: 1px solid black; padding: 10px;">';
                echo '<h2>Booked Venues</h2>';
                echo '<table style="border-collapse: collapse; width: 100%;">';
                echo '<tr><th>Booking ID</th><th>Venue ID</th><th>Sport</th><th>Venue Name</th><th>Location</th><th>Timeslot</th><th>Venue Price</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["order_id"] . '</td>';
                    echo '<td>' . $row["venue_id"] . '</td>';
                    echo '<td>' . $row["sport"] . '</td>';
                    echo '<td>' . $row["venue_name"] . '</td>';
                    echo '<td>' . $row["location"] . '</td>';
                    echo '<td>' . $row["timeslot"] . '</td>';
                    echo '<td>' . $row["venue_price"] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>';
            } else {
                echo "No results found for booked venues.";
            }

            $stmt->close();
        } else {
            echo "Error in the SQL query: " . $this->conn->error;
        }
    }
}

// Create a new database connection
$dbConnection = new config();
$conn = $dbConnection->getConnection();

// Create instances of the classes and display the data
$bookedTournaments = new BookedTournaments($conn);
$bookedTournaments->displayBookedTournaments();

$bookedCoaches = new BookedCoaches($conn);
$bookedCoaches->displayBookedCoaches();

$bookedVenues = new BookedVenues($conn);
$bookedVenues->displayBookedVenues();

$conn->close();
?>
</body>
</html>
