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
            header("location: /user/home");
        }
    }

    public function getDeleteModal(){
        ?>
        <div class="modal fade" id="deleteAuthUserModal" tabindex="-1" aria-labelledby="deleteAuthUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteAuthUserModalLabel">Conferma Eliminazione</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Questa azione è <strong>irreversibile</strong>.</p>
                        <p>Tutti i tuoi dati verranno eliminati definitivamente.</p>
                        <form action="/user/delete" method="POST">
                            <div class="mb-3">
                                <label>Inserisci la tua password per confermare</label>
                                <input type="password" name="password" class="form-control" placeholder="****" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                                Annulla
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    Elimina definitivamente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}