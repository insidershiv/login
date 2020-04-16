<?php

namespace models;

require_once "../autoloader.php";
require "../vendor/autoload.php";

use \Firebase\JWT\JWT;

class UserManager
{

    public $secret_key = "mykeyisthis";
    public $error;
    public function __construct()
    {
        $this->tbname = "User";
        $this->conn = Connection::getConnection();
        $this->error = "No error";
    }

    public function insertuser($user)
    {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);


        $query = "INSERT INTO $this->tbname (name, email, password, isadmin) VALUES (:name, :email, :password, :isadmin)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($user);

        if ($stmt->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    private function fetch_user($user)
    {

        if ($user["email"]) {
            $var = "email";
        } else {

            $var = "id";
        }

        $query = "SELECT * FROM $this->tbname WHERE $var =" . ":" . $var;

        $stmt = $this->conn->prepare($query);
        $stmt->execute($user);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($stmt->rowCount()) {
            return $row;
        }
        return false;
    }

    public function geterror()
    {
        return $this->error;
    }

// verifying login credentials and generating TOKEN
    public function verify_user($user)
    {

        // when evrythin is right
        if ($user["email"]) {
            $search_constraint = array("email" => $user["email"]);
        } else {
            $search_constraint = array("id" => $user["id"]);
        }
        $data = $this->fetch_user($search_constraint);
        if ($data) {
            $password = $user["password"];

            if (password_verify($password, $data["password"])) {

                $token = array(

                    "iat" => time(),
                    "data" => array(
                        "id" => $data["id"],
                        "name" => $data["name"],
                        "email" => $data["email"]
                    )
                );


                $jwt = JWT::encode($token, $this->secret_key);
                return json_encode(
                    array(
                        "message" => "Successful login.",
                        "jwt" => $jwt,
                        "email" => $data["email"],
                        "id"=>$data["id"]

                    )
                );



            
            } else {
                $this->error = "Password Mismatch";
                return false;
            }
        } else {
            $this->error = "No such User Found";
            return false;
        }
    }



    public function getuser($id)
    {
        $bind_param = ["id" => $id];
        $query = "SELECT id,name,email FROM $this->tbname WHERE id = :id";
        $stmnt = $this->conn->prepare($query);
        $stmnt->execute($bind_param);
        $row   = $stmnt->fetch(\PDO::FETCH_ASSOC);


        if ($stmnt->rowCount() == 0)
            return false;
        return $row;
    }


    public function getallusers()
    {

        $query = "SELECT id,name,email FROM $this->tbname";
        $stmnt = $this->conn->prepare($query);
        $stmnt->execute();
        $rows   = $stmnt->fetchAll(\PDO::FETCH_ASSOC);
        if ($rows)
            return $rows;
        else
            return false;
    }
}
