<?php 
class Year{
    private $id;
    private $year;
    private $createdAt;
    private $lastUpdate;

    public function __construct(array $values)
    {
        $this->id = $values["id"] ?? "";
        $this->year = $values["year"] ?? "";
        $this->createdAt = $values["created_at"] ?? "";
        $this->lastUpdate = $values["last_update"] ?? "";
    }

    public function toArray(){
        $values = [];
        $values["id"] = $this->id;
        $values["year"] = $this->year;
        $values["created_at"] = $this->createdAt;
        $values["last_update"] = $this->lastUpdate;

        return $values;
    }

    public function getId(){return $this->id;}
    public function getYear(){return $this->year;}
    public function getCreatedAt(){return $this->createdAt;}
    public function getLastUpdate(){return $this->lastUpdate;}
}