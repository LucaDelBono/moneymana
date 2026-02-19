<?php
require_once __DIR__ . "/../Bootstrap.php";

class UserController {
    private UserModel $userModel;
    private AuthController $authController;
    public function __construct()
    {
        $database = new Database;
        $this->authController = new AuthController;
        $this->userModel = new UserModel($database);
    }

    public function insert() {
        try{
            if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])){
                if($this->checkExistEmail()){
                    throw new Exception("Email già presente nel sistema!");
                }

                if($this->checkExistUsername()){
                    throw new Exception("Username già presente nel sistema!");
                }

                if($_POST["password"] !== $_POST["password_confirm"]){
                    throw new Exception("Username già presente nel sistema!");
                }

                $data = [
                    "username" => $_POST["username"],
                    "email" => $_POST["email"],
                    "password" => password_hash($_POST["password"], PASSWORD_DEFAULT)
                ];
                
                $this->userModel->insert($data);

                $_SESSION["flash"] = [
                    "type" => "success",
                    "message" => "Registrazione avvenuta con successo!"
                ];

                header("location: /accedi");
                exit;
            }else{
                throw new Exception("Compilare correttamente il form!");
            }
        }catch(Exception $e){
            $_SESSION["flash"] = [
                "type" => "danger",
                "message" => $e->getMessage()
            ];
            header("location: /registrazione");
            exit;
        }
    }

    public function update() {
        try{
            if(!empty($_POST["username"]) && !empty($_POST["email"])){
                $user = $this->authController->getAuthUser();
                if($user->getEmail() !== $_POST["email"]){
                    if($this->checkExistEmail()){
                        throw new Exception("Email già presente nel sistema!");
                    }
                }

                if($user->getUsername() !== $_POST["username"]){
                    if($this->checkExistUsername()){
                        throw new Exception("Username già presente nel sistema!");
                    }
                }

                $data = [
                    "id" => $user->getId(),
                    "username" => $_POST["username"],
                    "email" => $_POST["email"]
                ];

                $this->userModel->update($data);

                $_SESSION["flash"] = [
                    "type" => "success",
                    "message" => "Dati aggiornati con successo!"
                ];
                
            }else{
                throw new Exception("Compilare correttamente il form!");
            }
        }catch(Exception $e){
            $_SESSION["flash"] = [
                "type" => "danger",
                "message" => $e->getMessage()
            ];
        }
        header("location: /user/impostazioni");
        exit;
    }

    public function updatePassword(){
        try{
            if(!empty($_POST["old_password"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])){
                $user = $this->authController->getAuthUser();
                if(password_verify($_POST["old_password"], $user->getPassword())){
                    if($_POST["password"] === $_POST["password_confirm"]){
                        $data = [
                            "id" => $user->getId(),
                            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT)
                        ];
                        $this->userModel->updatePassword($data);
                        $_SESSION["flash"] = [
                            "type" => "success",
                            "message" => "Password aggiornata con successo!"
                        ];
                    }else{
                        throw new Exception("La nuova password non coincide con la conferma!");
                    }
                }else{
                    throw new Exception("La vecchia password è errata!");
                }
            }else{
                throw new Exception("Compilare correttamente il form!");
            }
        }catch(Exception $e){
            $_SESSION["flash"] = [
                "type" => "danger",
                "message" => $e->getMessage()
            ];
        }
        header("location: /user/impostazioni");
        exit;
    }

        public function delete(){
        try{
            if(!empty($_POST["password"])){
                $user = $this->authController->getAuthUser();
                if(password_verify($_POST["password"], $user->getPassword())){
                    $this->userModel->delete($user->getId());
                    unset($_SESSION["id"]);
                    unset($_SESSION["logged"]);
                    session_destroy();
                    header("location: /registrazione");
                    exit;
                }else{
                    throw new Exception("La password è errata!");
                }
            }else{
                throw new Exception("Compilare correttamente il form!");
            }
        }catch(Exception $e){
            $_SESSION["flash"] = [
                "type" => "danger",
                "message" => $e->getMessage()
            ];
        }
        header("location: /user/impostazioni");
        exit;
    }

    public function getUserById(int $id){
        return $this->userModel->getUserById($id);
    }

    public function getUserByUsername(string $username){
        return $this->userModel->getUserByUsername($username);
    }

    public function getUserByEmail(){
        return $this->userModel->getUserByEmail($_POST["email"]);
    }

    public function checkExistUsername(){
        $result = $this->userModel->checkExistUsername($_POST["username"]);
        return $result;
    }

    public function checkExistEmail(){
        $result = $this->userModel->checkExistEmail($_POST["email"]);
        return $result;
    }

    public function checkExistUsernameJson(){
        $result = $this->userModel->checkExistUsername($_POST["username"]);
        echo json_encode($result);
    }

    public function checkExistEmailJson(){
        $result = $this->userModel->checkExistEmail($_POST["email"]);
        echo json_encode($result);
    }
}