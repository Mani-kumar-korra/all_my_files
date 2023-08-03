// Function to handle the venue search
function searchVenue(page, location, sport, date, timeslot) {
    // Make an AJAX request to get matching venues
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('venueResults').innerHTML = xhr.responseText;
            } else {
                console.error('Request failed: ' + xhr.status);
            }
        }
    };

    xhr.open('POST', 'venueBooking.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var data = 'page=' + page + '&location=' + location + '&sport=' + sport + '&date=' + date + '&timeslot=' + timeslot;
    xhr.send(data);
}

// Event listener for form submission
document.getElementById('venueForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission
    var location = document.getElementById('location').value;
    var sport = document.getElementById('sport').value;
    var date = document.getElementById('date').value;
    var timeslot = document.getElementById('timeslot').value;
    searchVenue(1, location, sport, date, timeslot); // Call the searchVenue function with page = 1 to start from the first page
});

// Function to handle venue booking
function buyVenue(venueName, sport, price, venueId) {
    // Prepare the data to be sent to the server.
    var data = {
        venueName: venueName,
        sport: sport,
        price: price,
        location: document.getElementById('location').value,
        date: document.getElementById('date').value,
        timeslot: document.getElementById('timeslot').value,
        userId: "mani",
        venueId: venueId,
    };

    // Send the data to the server using AJAX.
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                alert(xhr.responseText); // Display the response from the server (order status)
            } else {
                console.error("Failed to place the order: " + xhr.status);
                alert("Failed to place the order!"); // Display an alert message on failure
            }
        }
    };

    xhr.open('POST', 'orderPlacement.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(data));
}


document.getElementById('venueForm').addEventListener('submit', function (event) {
    event.preventDefault();
    searchVenue();
});
