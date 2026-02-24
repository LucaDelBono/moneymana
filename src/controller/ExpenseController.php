<?php
require_once __DIR__ . "/../Bootstrap.php";

class ExpenseController {
    private ExpenseModel $expenseModel;
    public function __construct()
    {
        $database = new Database;
        $this->expenseModel = new ExpenseModel($database);
    }

    public function insert() {
        try{
            if(!empty($_SESSION["id"]) && !empty($_POST["id_year"]) && !empty($_POST["id_month"]) && !empty($_POST["description"]) && !empty($_POST["import"])){

                $data = [
                    "id_user" => $_SESSION["id"],
                    "id_year" => $_POST["id_year"],
                    "id_month" => $_POST["id_month"],
                    "description" => $_POST["description"],
                    "import" => $_POST["import"]
                ];
                
                $this->expenseModel->insert($data);

                $_SESSION["flash"] = [
                    "type" => "success",
                    "message" => "Spesa aggiunta con successo!"
                ];

                header("location: /storico_anno?idYear=". $_POST["id_year"] . "&id_month=" . $_POST["id_month"]);
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

    public function delete(){
        try{
            if(!empty($_POST["id"]) && !empty($_POST["id_year"]) && !empty($_POST["id_month"])){
                $this->expenseModel->delete($_POST["id"]);
            }else{
                throw new Exception("Errore di sistema!");
            }
        }catch(Exception $e){
            $_SESSION["flash"] = [
                "type" => "danger",
                "message" => $e->getMessage()
            ];
        }
        header("location: /storico_anno?idYear=". $_POST["id_year"] . "&id_month=" . $_POST["id_month"]);
        exit;
    }
}