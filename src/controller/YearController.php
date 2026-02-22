<?php
require_once __DIR__ . "/../Bootstrap.php";

class YearController {
    private YearModel $yearModel;
    public function __construct()
    {
        $database = new Database;
        $this->yearModel = new YearModel($database);
    }

    public function getById(int $id){
        return $this->yearModel->getById($id);
    }

    public function getByYear(int $year){
        return $this->yearModel->getByYear($year);
    }

    public function getAll(){
        return $this->yearModel->getAll();
    }
}