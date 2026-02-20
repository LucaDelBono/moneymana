<?php 
class Month{
    private $id;
    private $name;
    private $number;
    private $createdAt;
    private $lastUpdate;

    public function __construct(array $values)
    {
        $this->id = $values["id"] ?? "";
        $this->name = $values["name"] ?? "";
        $this->number = $values["number"] ?? "";
        $this->createdAt = $values["created_at"] ?? "";
        $this->lastUpdate = $values["last_update"] ?? "";
    }

    public function toArray(){
        $values = [];
        $values["id"] = $this->id;
        $values["name"] = $this->name;
        $values["number"] = $this->number;
        $values["created_at"] = $this->createdAt;
        $values["last_update"] = $this->lastUpdate;

        return $values;
    }

    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
    public function getNumber(){return $this->number;}
    public function getCreatedAt(){return $this->createdAt;}
    public function getLastUpdate(){return $this->lastUpdate;}
}