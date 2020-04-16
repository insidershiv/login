$(document).ready(function () {

    var id = Cookies.get('id');
    var token = Cookies.get('token');
   
    var base_url = "http://localhost:8080/project";
    var test = base_url + "/api/user" + "/" + id;
    console.log(test);
    $.ajax({
        type: "GET",
        url: test,
        headers: { 
            Authorization: 'Bearer ' + token,
            
        },
        crossDomain:true,
        crossOrigin: true,
        success: function (response) {
            response = JSON.parse(response);
          
            console.log("here");
            dom(response.name);


        },
        error: function (xhr, textStatus, errorMessage) {
            
            console.log(xhr.response);
            
              //document.location.href = "index.php";
        }

    });




});



// Functions body 

function dom(username) {

    var name = username;

    document.getElementById("username").innerHTML = name;

}


$("#logout").click(function () {
    Cookies.remove('id');
    Cookies.remove('token');
    document.location.href = "index.php";

})

