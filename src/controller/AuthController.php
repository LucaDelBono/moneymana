<?php 
require_once __DIR__ . "/../Bootstrap.php";

class AuthController{

    public function __construct()
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        } 
    }

    public function getAuthUser(){
        $userController = new UserController;
        return $userController->getUserById($_SESSION["id"]);
    }

    public function login(){
        try{
            if(!empty($_POST["email"]) && !empty($_POST["password"])){
                $userController = new UserController();
                $user = $userController->getUserByEmail($_POST["email"]);
                if(!empty($user)){
                    if(password_verify($_POST["password"], $user->getPassword())){
                        $_SESSION["logged"] = true;
                        $_SESSION["id"] = $user->getId();
                        header("location: /user/home");
                        exit;
                    }else{
                        throw new Exception("Credenziali errate");
                    }
                }else{
                    throw new Exception("Credenziali errate");
                }
            }else{
                throw new Exception("Compilare correttamente il form!");
            }
        }catch(Exception $e){
            $_SESSION["flash"] = [
                "type" => "error",
                "message" =>  $e->getMessage()
            ];

            header("location: /accedi");
            exit;
        }
    }

    public function logout(){
        unset($_SESSION["id"]);
        unset($_SESSION["logged"]);
        session_destroy();
        header("location: /accedi");
        exit;
    }
    
    public function checkIfUserIsNotLogged(){
        if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true){
            header("location: /accedi");
        }
    }

    public function checkIfUserIsLogged(){
        if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
            header("location: /accedi");
        }
    }
}