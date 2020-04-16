<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
</head>



<body>


    <header class="main-header">

        <div class="main-logo">

            <a href="#">Home</li>
        </div>

        <nav class="main-nav">

            <ul class="nav-items" id="items">

              
                <li class="nav-item" id="login"> <a href="#">LogIn</a> </li>
                <li class="nav-item" id="signup"> <a href="#">SignUp</a> </li>


            </ul>
            <ul class="nav-items" id="logout_item">


                <li class="nav-item" id="logout"> <a href="#">Logout</a> </li>


            </ul>

        </nav>

    </header>

    <div id="signup-form">

        <form action="api/user.php" method="POST" class="form-pos" id="sign-form" name="sign-form">
            <input type="text" name="name" id="name" placeholder="username" class="form-data" required>
            <input type="email" name="email" id="email" placeholder="Email" class="form-data" required>
            <input type="text" name="password" id="password" placeholder="password" class="form-data" required>

            <button name="btn" id="signbtn" class="submit">SignUp</button>

        </form>




    </div>



    <!-- login form -->



    <div id="login-form">

        <form action="api/login.php" method="POST" class="form-pos" id="login-form" name="login-form">

            <input type="email" name="email" id="email2" placeholder="Email" class="form-data" required>
            <input type="text" name="password" id="password2" placeholder="password" class="form-data" required>

            <button name="btn" id="signin" class="submit">LogIn</button>

        </form>




    </div>





    <script src="script.js">

    </script>
</body>

</html>