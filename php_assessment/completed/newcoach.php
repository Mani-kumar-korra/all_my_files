<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

echo "<h2> " . $_SESSION["name"] . "!</h2>";


if (!isset($_SESSION["email"])) {

    header("Location: login.php");
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Sports Academies and Coaches</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<!--    <script data-main="js/main" src = "js/requirejs.org_docs_release_2.3.6_comments_require.js"></script>-->
<!--    <script src="js/newcoach.js"></script>-->
    <link rel="stylesheet" href="css/coach.css">

</head>
<body>
<h4><a href="home.php">HOME</a></h4>
<h4><a href ="accounts.html">Back</a></h4>
<center><h1>Discover Sports Academies and Coaches</h1></center>
<form id="search-form">
    <label for="location">Select Location:</label>
    <select name="location" id="location">
        <option value="Chennai">Chennai</option>
        <option value="Vizag">Vizag</option>
        <option value="Hyderabad">Hyderabad</option>
    </select>

    <label for="sport">Select Sport:</label>
    <select name="sport" id="sport">
        <option value="Football">Football</option>
        <option value="Basketball">Basketball</option>
        <option value="Tennis">Tennis</option>
    </select>

    <button type="button" id="search-button">Search</button>
</form>

<div id="results">
    
</div>

<div id="coaches-popup" class="popup" style="display: none;">
    <button id="close-button">Close</button>
    <div id="coaches-content">
      
    </div>
</div>

<script>
    $(document).ready(function(){
        console.log('ready');
        $("#search-button").on("click", function () {
            const location = document.getElementById("location").value;
            const sport = document.getElementById("sport").value;
            // For search ajax request
            $.ajax({
                type:'POST',
                url:'search.php',
                data:{location:location,sport:sport},
                success:function(response){
                    $("#results").html(response);
                },
                error:function (response){
                    console.log(response);
                }
            });
        });
        $(".get-coaches-button").on("click",function(){
           console.log(this);
        });

        document.getElementById("close-button").addEventListener("click", function () {
            document.getElementById("coaches-popup").style.display = "none";
        });
    });
    function getCoachesAJaxCall(academyId){
        console.log(academyId);
        let sport = document.getElementById("sport").value;
       
        $.ajax({
            type:'POST',
            url:'get_coaches.php',
            data:{academy_id:academyId,sport:sport},
            success:function(response){
                $("#coaches-content").html(response);
                $("#coaches-popup").show();
            },
            error:function (response){
                console.log(response);
            }
        });
    }

    function buyButtonAjaxCall(coachId, coachPrice, self) {
        let sport = document.getElementById("sport").value;
        console.log(self.dataset.coachName);

        // For search ajax request
        $.ajax({
            type: 'POST',
            url: 'book_coach.php',
            data: {
                coach_name: self.dataset.coachName,
                coach_id: coachId,
                coach_price: coachPrice,
                sport: sport,
                academy_id: self.dataset.academyId
            },
            success: function (response) {
                // Check if the response is "success" to show the alert message
                if (response === "success") {
                    alert("Coach booked successfully!");
                }

                // Update the #results element with the new data (if required)
                $("#results").html(response);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

</script>
</body>
</html>
