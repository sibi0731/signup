$(document).ready(function() {
    $('#loginform').submit(function(event) {
        event.preventDefault(); 
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'php/login.php', 
            data: formData,
            dataType: 'json', 
            success: function(response) {
                if (response.success === true) {
                    window.location.href = 'profile.html?id=' +response.id; 
                } else {                
                    $('#myform').html("<div class='alert alert-danger'>Invalid email or password.</div>");
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX request failed:", error); 
            }
        });
    });
});
