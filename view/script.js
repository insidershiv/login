var loged_in = 0;
var base_url = "http://localhost:8080/project"

function signup(event) {

    event.preventDefault(); //prevent default action 

    var credentials = {
        'name': document.getElementById("name").value,
        'email': document.getElementById("email").value,
        'password': document.getElementById("password").value
    };
 
    console.log(credentials);

    $.ajax({

        url: base_url + "/api/user",
        type: "POST",
        data: JSON.stringify(credentials),
        success: function (data, status, xhr) {
            body = JSON.parse(data);
            alert(body.msg);
            document.location.href = "index.php";
            $("#login-form").css({
                'display': 'block'
            })

        }
        ,
        error: function (xhr, textStatus, errorMessage) {

            console.log('Error' + xhr.responseText + ' ' + xhr.status);
        }

    });

}


function login(event) {
    event.preventDefault();

    var credentials = {
        'email': document.getElementById("email2").value,
        'password': document.getElementById("password2").value
    };

    console.log(base_url);
    $.ajax({
        url: base_url + "/api/login",
        type: "POST",
        crossDomain:true,
        crossOrigin:true,
        data: JSON.stringify(credentials),
        crossOrigin: true,
        success: function (result, status, xhr) {
            body = JSON.parse(result);

            Cookies.set('id', body.id);
            Cookies.set('token', body.jwt);

            // console.log(Cookies.get('id'));
            // console.log(Cookies.get('token'));
           

            document.location.href = "userprofile.php"



        },
        error: function (data) {
            alert("Incorrect Credentials");
        }


    })
}


function logstatus() {

    if (loged_in) {
        $("#items").css({
            'display': 'none'
        });

        $("#logout_item").css({
            'display': 'inline-block'
        })
    } else {

        $("#items").css({
            'display': 'block'
        });

        $("#logout_item").css({
            'display': 'none'
        })

    }


}

// set cookie method 




$(document).ready(function () {

    $("#signup").click(function () {
        $("#signup-form").css({
            'display': 'block'
        })
        $("#login-form").css({
            'display': 'none'
        })

    });


    $("#signbtn").click(signup);


    // login btn on navbar
    $("#login").click(function () {

        $("#signup-form").css({
            'display': 'none'
        })

        $("#login-form").css({
            'display': 'block'
        })
        if (loged_in) {
            $("#items").css({
                'display': 'none'
            });
        }


    })
    // login submit click
    $("#signin").click(login);


    // logout button click

   



});