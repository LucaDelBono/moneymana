<?php
require_once __DIR__ . "/../Bootstrap.php";

class ExpenseModel {
    protected Database $db;

    public function __construct($database)
    {
        $this->db = $database;

    }

    public function insert(array $data) :int{

        $query = $this->db->prepare("INSERT INTO expenses(id_user, id_year, id_month, description, import) VALUES (:id_user, :id_year, :id_month, :description, :import)");
        $params = [
            "id_user" => $data["id_user"],
            "id_year" => $data["id_year"],
            "id_month" => $data["id_month"],
            "description" => $data["description"],
            "import" => $data["import"]
        ];
        
        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query " . __METHOD__);
        }
        return (int) $this->db->lastInsertId();
    }

    public function delete(int $id) :bool{

        $query = $this->db->prepare("DELETE FROM expenses WHERE id = :id");
        $params = [
            "id" => $id
        ];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query " . __METHOD__);
        }

        return (bool) true;
    }
}