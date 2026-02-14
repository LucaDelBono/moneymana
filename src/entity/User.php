<?php 
class User{
    private $id;
    private $name;
    private $surname;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $lastUpdate;

    public function __construct(array $values)
    {
        $this->id = $values["id"] ?? "";
        $this->name = $values["name"] ?? "";
        $this->surname = $values["surname"] ?? "";
        $this->username = $values["username"] ?? "";
        $this->email = $values["email"] ?? "";
        $this->password = $values["password"] ?? "";
        $this->createdAt = $values["created_at"] ?? "";
        $this->lastUpdate = $values["last_update"] ?? "";
    }

    public function toArray(){
        $values = [];
        $values["id"] = $this->id;
        $values["name"] = $this->name;
        $values["surname"] = $this->surname;
        $values["username"] = $this->username;
        $values["email"] = $this->email;
        $values["password"] = $this->password;
        $values["created_at"] = $this->createdAt;
        $values["last_update"] = $this->lastUpdate;

        return $values;
    }

    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
    public function getSurname(){return $this->surname;}
    public function getUsername(){return $this->username;}
    public function getEmail(){return $this->email;}
    public function getPassword(){return $this->password;}
    public function getCreatedAt(){return $this->createdAt;}
    public function getLastUpdate(){return $this->lastUpdate;}
}