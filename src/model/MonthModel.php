<?php
require_once __DIR__ . "/../Bootstrap.php";

class MonthModel {
    protected Database $db;

    public function __construct($database)
    {
        $this->db = $database;

    }

    public function getById(int $id) :Month|bool{
        $query = $this->db->prepare("SELECT * FROM months WHERE id = :id");
        $params = ["id" => $id];

        if(!$query->execute($params)){
            throw new Exception("MonthModel: error execute query " . __METHOD__);
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Month($row); 
        }

        return (bool) false;
    }

    public function getAll() :array{
        $query = $this->db->prepare("SELECT * FROM months");

        if(!$query->execute()){
            throw new Exception("MonthModel: error execute query " . __METHOD__);
        }
        
        $data = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            if($row){
                $data[] = new Month($row); 
            }
        }
        return $data;
    }
  
}