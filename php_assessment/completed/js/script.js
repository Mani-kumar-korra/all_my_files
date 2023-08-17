
function searchVenue(page, location, sport, date, timeslot) {
  
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


document.getElementById('venueForm').addEventListener('submit', function (event) {
    event.preventDefault(); 
    var location = document.getElementById('location').value;
    var sport = document.getElementById('sport').value;
    var date = document.getElementById('date').value;
    var timeslot = document.getElementById('timeslot').value;
    searchVenue(1, location, sport, date, timeslot); 
});


function buyVenue(venueName, sport, price, venueId) {
    
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

    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                alert(xhr.responseText);
            } else {
                console.error("Failed to place the order: " + xhr.status);
                alert("Failed to place the order!"); 
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
