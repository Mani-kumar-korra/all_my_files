document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('search-btn').addEventListener('click', function () {
        const location = document.getElementById('location').value;
        const sport = document.getElementById('sport').value;

        $.ajax({
            url: window.location.origin + '/coaching.php',
            type: 'GET',
            data: { location: location, sport: sport },
            success: function (result) {
                const coaches = JSON.parse(result);
                const coachResultsDiv = document.getElementById('coach-results');
                coachResultsDiv.innerHTML = '';

                // Create a list element for each coach and append it to the coach-results div
                coaches.forEach(function (coach) {
                    const coachElement = document.createElement('p');
                    coachElement.textContent = coach;

                    // Add a click event listener to each coach element
                    coachElement.addEventListener('click', function () {
                        // When a coach is clicked, make a booking
                        bookCoach(coach);
                    });

                    coachResultsDiv.appendChild(coachElement);
                });
            },
            error: function () {
                console.log('error');
            }
        });
    });
});

function bookCoach(coachName) {
    const location = document.getElementById('location').value;
    const sport = document.getElementById('sport').value;

    $.ajax({
        url: window.location.origin + '/coaching.php',
        type: 'POST', // Use POST method for booking
        data: { coachName: coachName, location: location, sport: sport },
        success: function (result) {
            if (result === 'success') {
                alert('Booking successful!');
            } else {
                alert('Booking failed. Please try again.');
            }
        },
        error: function () {
            console.log('error');
        }
    });
}
