<?php


session_start();




if (!isset($_SESSION["name"])) {

    header("Location: login.php");
    exit();
}


class Tournament
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    
    public function searchTournaments($location, $sportCategory, $startDate, $endDate)
    {
        // Prepare the query
        $query = "SELECT l.name as lname, t.*,l.*,sc.*
                  FROM tournaments t
                  INNER JOIN locations l ON t.location_id = l.location_id
                  INNER JOIN sport_categories sc ON t.sport_category_id = sc.sport_category_id
                  WHERE 1";

        // Add conditions for search criteria if provided
        if (!empty($location)) {
            $query .= " AND l.name LIKE :location";
        }
        if (!empty($sportCategory)) {
            $query .= " AND sc.name = :sport_category";
        }
        if (!empty($startDate)) {
            $query .= " AND t.date >= :start_date";
        }
        if (!empty($endDate)) {
            $query .= " AND t.date <= :end_date";
        }

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind search criteria values if provided
        if (!empty($location)) {
            $stmt->bindValue(':location', '%' . $location . '%');
        }
        if (!empty($sportCategory)) {
            $stmt->bindParam(':sport_category', $sportCategory);
        }
        if (!empty($startDate)) {
            $stmt->bindParam(':start_date', $startDate);
        }
        if (!empty($endDate)) {
            $stmt->bindParam(':end_date', $endDate);
        }

        // Execute the query
        $stmt->execute();

        // Fetch all the results into an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function bookTournament($tournament_id,$name ,$user_id,$date,$fee,$lname)
    {

        try {
            // Create a new booking record in the database
            $query = "INSERT INTO booked_tournaments (tournament_id,sportCategory, user_id,date,fee,location) VALUES (?,?,?, ?,?,?)";
            $stmt = $this->conn->prepare($query);


            if ($stmt->execute([$tournament_id,$name, $user_id,$date,$fee,$lname])) {
                return true;
            } else {
                return false;
            }
        }catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }


}

require_once  'con/config.php';

if (isset($_POST['book'])) {
    // Retrieve form data
    $tournament_id = $_POST['tournament_id'];
    $user_id = $_SESSION["email"];
    $date = $_POST['date'];
    $fee = $_POST['fee'];
    $lname = $_POST['lname'];
    $name=$_POST['name'];

    $tournament = new Tournament($db);


    if ($tournament->bookTournament($tournament_id ,$name, $user_id,$date,$fee,$lname)) {
        echo '<div class="alert">Successfully booked!</div>';
    } else {
        echo '<div class="alert">Booking failed. Please try again later.</div>';
    }
}
