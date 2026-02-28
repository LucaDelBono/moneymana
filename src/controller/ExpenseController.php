<?php
require_once __DIR__ . "/../Bootstrap.php";

class ExpenseController {
    private ExpenseModel $expenseModel;
    private AuthController $authController;

    public function __construct()
    {
        $database = new Database;
        $this->authController = new AuthController;
        $this->expenseModel = new ExpenseModel($database);
    }

    public function insert() {
        try{
            if(!empty($_SESSION["id"]) && !empty($_POST["year"]) && !empty($_POST["month"]) && !empty($_POST["description"]) && !empty($_POST["import"])){
                $idMonth = MONTHS[$_POST["month"]];
                $idYear = YEARS[$_POST["year"]];
                if(empty($idMonth) || empty($idYear)){
                    throw new Exception("Errore presente nel sistema");
                }

                $data = [
                    "id_user" => $_SESSION["id"],
                    "id_year" => $idYear,
                    "id_month" => $idMonth,
                    "description" => $_POST["description"],
                    "import" => $_POST["import"]
                ];
                
                $this->expenseModel->insert($data);

                $_SESSION["flash"] = [
                    "type" => "success",
                    "message" => "Spesa aggiunta con successo!"
                ];

                header("location: /user/spese_mensili?month=". $_POST["month"] . "&year=" . $_POST["year"]);
                exit;
            }else{
                throw new Exception("Compilare correttamente il form!");
            }
        }catch(Exception $e){
            $_SESSION["flash"] = [
                "type" => "danger",
                "message" => $e->getMessage()
            ];

            header("location: /user/spese_mensili?month=". $_POST["month"] . "&year=" . $_POST["year"]);
            exit;
        }
    }

    public function delete(){
        try{
            if(!empty($_POST["id"]) && !empty($_POST["month"]) && !empty($_POST["year"])){
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
        header("location: /user/spese_mensili?month=". $_POST["month"] . "&year=" . $_POST["year"]);
        exit;
    }

    public function getAllByIdMonthAndIdYear($idMonth, $idYear){
        if(!empty($idMonth) && !empty($idYear)){
            return $this->expenseModel->getAllByIdMonthAndIdYear($idMonth, $idYear);
        }else{
            throw new Exception("Errore di sistema!");
        }
    }

    public function getDeleteModal(){
        ?>
        <div class="modal fade" id="deleteExpenseModal" tabindex="-1" aria-labelledby="deleteExpenseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteExpenseModalLabel">Conferma Eliminazione</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Questa azione è <strong>irreversibile</strong>.</p>
                        <p>La spesa verrà eliminata definitivamente.</p>
                        <form action="/user/spese_mensili/delete" method="POST">
                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="month" name="month">
                            <input type="hidden" id="year" name="year">
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