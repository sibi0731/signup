
$(document).ready(function(){

      const params = getUrlParams();
      console.log(params);     
      var id =params.id
     
    $.ajax({
        type: 'GET',
        url: 'php/profile.php?id='+params.id,      
        data:[],
         success: function(response) {
            console.log("GET response:", response); 
            var resp=JSON.parse(response);
            console.log("GET response:", resp); 
            document.getElementById("name").value = resp.name;
            document.getElementById("email").value = resp.email;
          
        },
        error: function() {
            $('#profileform').html('<p>Error: Failed to fetch user information.</p>');

        }
   
    });

    $('#profileform').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        formData += '&id=' + id;
      
        $.ajax({
            type: 'POST',
            url: 'php/profile.php',
            data: formData,
            success: function(response){
                $('#myprofile').html(response);
                $('#profileform')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});

function getUrlParams() {
    const urlParams = new URLSearchParams(window.location.search);
    const params = {};
    for (const [key, value] of urlParams) {
      params[key] = value;
    }
    return params;
  }

  document.getElementById('logoutbtn').addEventListener('click', function() {
   
    window.location.href = 'logout.php';
  });
  
  

