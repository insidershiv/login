<?php


require "../vendor/autoload.php";
use \Firebase\JWT\JWT;



class Token {
    

    private static $secret_key = "mykeyisthis" ;
    
  
    private function __construct()  {

    }

public static function verify_token($authHeader) {


    $arr = explode(" ", $authHeader);
    $jwt = $arr[1];
    if($jwt){

    try {

        $decoded = JWT::decode($jwt, self::$secret_key, array('HS256'));
        
    }catch (Exception $e){
       return false;
    }

      
   } else{
      return false;
   }
return true;
    }
}

?>