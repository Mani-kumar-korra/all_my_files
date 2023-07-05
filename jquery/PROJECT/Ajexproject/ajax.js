$(document).ready(function() {
    $('#appointmentForm').submit(function(e) {
        e.preventDefault();
        
        var name = $('#name').val();
        var userId = $('#userid').val();
        var email = $('#email').val();
        var healthIssue = $('#healthissue').val();
        
        var formData = {
            name: name,
            userId: userId,
            email: email,
            healthIssue: healthIssue
        };
        console.log(formData)
        var jsonData = JSON.stringify(formData);
        console.log(jsonData)
       
        localStorage.setItem(userId, jsonData);
        
        $.ajax({
            url: 'https://reqres.in/api/users', // dema serverformy refe
            type: 'POST',
            success: function(response) {
                alert('Form submitted successfully!');
            },
            error: function() {
                alert('An error occurred while submitting the form.');
            }
        });
    });

    $('#searchButton').click(function() {
        var searchUserId = $('#searchUserId').val();
        var patientData = localStorage.getItem(searchUserId);//(here i  retrieving data using userid)
        
        if (patientData) {
            var patient = JSON.parse(patientData);
            var patientDetails = 'Name: ' + patient.name + '<br>' +
                                'User ID: ' + patient.userId + '<br>' +
                                'Email: ' + patient.email + '<br>' +
                                'Health Issue: ' + patient.healthIssue;
            $('#patientDetails').html(patientDetails);
        } else {
            $('#patientDetails').html('No patient found with the given User ID.');
        }
    });
});