<?php
require_once __DIR__ . "/../Bootstrap.php";

class MonthController {
    private MonthModel $monthModel;
    public function __construct()
    {
        $database = new Database;
        $this->monthModel = new MonthModel($database);
    }

    public function getById(int $id){
        return $this->monthModel->getById($id);
    }

    public function getAll(){
        return $this->monthModel->getAll();
    }
}