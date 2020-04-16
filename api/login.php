<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");

use models as m;


require_once "../autoloader.php";


$req_method = $_SERVER["REQUEST_METHOD"];
$usermanager = new m\UserManager();


if ($req_method == "POST") {

    $val = json_decode(file_get_contents('php://input'), true);

    $success_token = $usermanager->verify_user($val);
    if($success_token) {
        http_response_code(200);
        echo $success_token;
        
    }else {
       http_response_code(404);
    }

}

