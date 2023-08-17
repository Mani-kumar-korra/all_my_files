<?php
session_start();

echo "<h2> " . $_SESSION["email"] . "!</h2>";


if (!isset($_SESSION["email"])) {

    header("Location: login.php");
    exit();
}



require_once 'con/newConfig.php';


class VenueBooking
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getMatchingVenues($page, $location, $sport, $date, $timeslot)
    {
        $query = "SELECT * FROM location_venue WHERE location = ? AND sports = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $location, $sport);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Database query error: " . $this->conn->error);
        }

        $results_per_page = 2;
        $num_results = $result->num_rows;
        $num_pages = ceil($num_results / $results_per_page);
        $start_index = ($page - 1) * $results_per_page;

        
        $query_with_limit = $query . " LIMIT ?, ?";
        $stmt_with_limit = $this->conn->prepare($query_with_limit);
        $stmt_with_limit->bind_param("ssii", $location, $sport, $start_index, $results_per_page);
        $stmt_with_limit->execute();
        $result_with_limit = $stmt_with_limit->get_result();

        if (!$result_with_limit) {
            die("Database query error: " . $this->conn->error);
        }

        if ($result_with_limit->num_rows > 0) {
            while ($row = $result_with_limit->fetch_assoc()) {
                echo "<p>Venue: " . $row['venue'] . ", venueId: " . $row['venue_id'] . ", Sport: " . $row['sports'] . ", Price: " . $row['venue_price'] . " <button onclick='buyVenue(\"" . $row['venue'] . "\", \"" . $row['sports'] . "\", " . $row['venue_price'] . ", " . $row['venue_id'] . ")'>Buy</button></p>";
            }
        } else {
            echo "No matching venues found.";
        }

        if ($num_pages > 1) {
            echo "<div class='pagination'>";

            if ($page > 1) {
                echo "<a href='javascript:void(0);' onclick='searchVenue(" . ($page - 1) . ", \"$location\", \"$sport\", \"$date\", \"$timeslot\")'>&laquo; Previous</a> ";
            } else {
                echo "<span class='disabled'>&laquo; Previous</span> ";
            }

            for ($page_number = 1; $page_number <= $num_pages; $page_number++) {
                if ($page_number == $page) {
                    echo "<span class='active'>$page_number</span> ";
                } else {
                    echo "<a href='javascript:void(0);' onclick='searchVenue($page_number, \"$location\", \"$sport\", \"$date\", \"$timeslot\")'>$page_number</a> ";
                }
            }

            
            if ($page < $num_pages) {
                echo "<a href='javascript:void(0);' onclick='searchVenue(" . ($page + 1) . ", \"$location\", \"$sport\", \"$date\", \"$timeslot\")'>Next &raquo;</a> ";
            } else {
                echo "<span class='disabled'>Next &raquo;</span> ";
            }

            echo "</div>";
        }
    }
}

// Handle the AJAX request to search for venues
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $config = new Config();
    $conn = $config->getConnection();

    $venueBooking = new VenueBooking($conn);
    $page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
    $location = $_POST["location"];
    $sport = $_POST["sport"];
    $date = $_POST["date"];
    $timeslot = $_POST["timeslot"];

    $venueBooking->getMatchingVenues($page, $location, $sport, $date, $timeslot);
}
?>
