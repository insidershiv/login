<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

use  models as m;

require_once "../autoloader.php";

$req_method = $_SERVER["REQUEST_METHOD"];

$usermanager = new m\UserManager();

if ($req_method == "GET") {

    $headers = apache_request_headers();
    $ispermitted = Token::verify_token($headers['Authorization']);

    if($ispermitted){
        
            // Access is granted. Add code of the operation here 

            $input = explode('/',rtrim($_GET['id'],'/'));
            if(count($input) == 1){
                // fectch all userers
                http_response_code(200);
                $res = $usermanager->getallusers(); 
            
            } else {
                $id = $input[count($input)-1];
                $res = $usermanager->getuser($id);    
                if($res == false){
                    http_response_code(404);
                    $res = [
                        "error" => "No User Found"
                    ];
                } 
                echo json_encode($res);

            }
    
    } else{

        // autorization failed
    
        http_response_code(401);
        echo json_encode(array(
            "error" => "Access denied.",
        ));

    }
    

}   // end of GET

else if ($req_method == "POST") {
    
    $val = json_decode(file_get_contents('php://input'), true);
    $val["isadmin"] = 0;

    //  $var = isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']);

    if ($val) {

        if ($usermanager->insertuser($val)) {
            $res = array(
                'msg' => "User have been registered"
            );
        }
        else {
            http_response_code(400);
            $res = array('msg'=> "user was not created");
        }
    }
     else {
        http_response_code(400);
        $res = array(
            'msg' => "Please Specify All the entries",
        );
    }
    echo json_encode($res);
}
?>