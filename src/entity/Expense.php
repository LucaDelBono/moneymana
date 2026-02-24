<?php 
class Expense{
    private $id;
    private $idUser;
    private $idYear;
    private $idMonth;
    private $description;
    private $import;
    private $createdAt;
    private $lastUpdate;

    public function __construct(array $values)
    {
        $this->id = $values["id"] ?? "";
        $this->idUser = $values["id_user"] ?? "";
        $this->idYear = $values["id_year"] ?? "";
        $this->idMonth = $values["id_month"] ?? "";
        $this->description = $values["description"] ?? "";
        $this->import = $values["import"] ?? "";
        $this->createdAt = $values["created_at"] ?? "";
        $this->lastUpdate = $values["last_update"] ?? "";
    }

    public function toArray(){
        $values = [];
        $values["id"] = $this->id;
        $values["id_user"] = $this->idUser;
        $values["id_year"] = $this->idYear;
        $values["id_month"] = $this->idMonth;
        $values["description"] = $this->description;
        $values["import"] = $this->import;
        $values["created_at"] = $this->createdAt;
        $values["last_update"] = $this->lastUpdate;

        return $values;
    }

    public function getId(){return $this->id;}
    public function getIdUser(){return $this->idUser;}
    public function getIdYear(){return $this->idYear;}
    public function getIdMonth(){return $this->idMonth;}
    public function getDescription(){return $this->description;}
    public function getImport(){return $this->import;}
    public function getCreatedAt(){return $this->createdAt;}
    public function getLastUpdate(){return $this->lastUpdate;}
}