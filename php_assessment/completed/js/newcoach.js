$(document).ready(function(){
    console.log('ready');
    $("#search-button").on("click", function () {
        const location = $("#location").val;
        const sport = $("#sport").val;
        $.ajax({
            type:'POST',
            url:window.location.origin+'/search.php',
            data:{location:location,sport:sport},
            success:function(response){
                console.log(response);
        },
            error:function (response){
                console.log(response);
            }
        })

        // const xhr = new XMLHttpRequest();
        // xhr.open("POST", "search.php", true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        //         document.getElementById("results").innerHTML = xhr.responseText;
        //     }
        // };
        //
        // xhr.send("location=" + encodeURIComponent(location) + "&sport=" + encodeURIComponent(sport));
    });
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("get-coaches-button")) {
            const academyId = event.target.dataset.academyId;
            const sport = document.getElementById("sport").value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "get_coaches.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.getElementById("coaches-content").innerHTML = xhr.responseText;
                    document.getElementById("coaches-popup").style.display = "block";

                    // Add event listener for Buy button
                    const buyButtons = document.getElementsByClassName("buy-button");
                    for (const button of buyButtons) {
                        button.addEventListener("click", function () {
                            // console.log(this.next("#buy_coach"));
                            console.log(this.nextElementSibling);
                            const coachName = this.dataset.coachName;
                            const academyName = this.dataset.academyName;
                            const sport = this.dataset.sport;

                            const xhrBuy = new XMLHttpRequest();
                            xhrBuy.open("POST", "book_coach.php", true);
                            xhrBuy.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                            xhrBuy.onreadystatechange = function () {
                                if (xhrBuy.readyState === XMLHttpRequest.DONE && xhrBuy.status === 200) {
                                    if (xhrBuy.responseText === "success") {
                                        alert("Coach booked successfully!");
                                    } else {
                                        alert("Booking failed. Please try again later.");
                                    }
                                }
                            };

                            xhrBuy.send("coach_name=" + encodeURIComponent(coachName) + "&academy_name=" + encodeURIComponent(academyName) + "&sport=" + encodeURIComponent(sport));
                        });
                    }
                }
            };

            xhr.send("academy_id=" + encodeURIComponent(academyId) + "&sport=" + encodeURIComponent(sport));
        }
    });

    document.getElementById("close-button").addEventListener("click", function () {
        document.getElementById("coaches-popup").style.display = "none";
    });
})
