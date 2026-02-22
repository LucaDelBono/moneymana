<?php
require_once __DIR__ . "/../Bootstrap.php";

class YearModel {
    protected Database $db;

    public function __construct($database)
    {
        $this->db = $database;

    }

    public function getById(int $id) :Year|bool{
        $query = $this->db->prepare("SELECT * FROM years WHERE id = :id");
        $params = ["id" => $id];

        if(!$query->execute($params)){
            throw new Exception("YearModel: error execute query " . __METHOD__);
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Year($row); 
        }

        return (bool) false;
    }

    public function getByYear(int $year) :Year|bool{
        $query = $this->db->prepare("SELECT * FROM years WHERE year = :year");
        $params = ["year" => $year];

        if(!$query->execute($params)){
            throw new Exception("YearModel: error execute query " . __METHOD__);
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Year($row); 
        }

        return (bool) false;
    }

    public function getAll() :array{
        $query = $this->db->prepare("SELECT * FROM years");

        if(!$query->execute()){
            throw new Exception("YearModel: error execute query " . __METHOD__);
        }
        
        $data = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            if($row){
                $data[] = new Year($row); 
            }
        }
        return $data;
    }
  
}