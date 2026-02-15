<?php
require_once __DIR__ . "/../Bootstrap.php";

class UserModel {
    protected Database $db;

    public function __construct($database)
    {
        $this->db = $database;

    }

    public function insert(array $data) :int{
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];

        $query = $this->db->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)");
        $params = [
            "username" => $username,
            "email" => $email,
            "password" => $password
        ];
        
        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query insert");
        }
        return (int) $this->db->lastInsertId();
    }

    public function update(array $data) :bool{
        $id = $data["id"];
        $username = $data["username"];
        $email = $data["email"];

        $query = $this->db->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
        $params = [
            "id" => $id,
            "username" => $username,
            "email" => $email
        ];
        
        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query update");
        }
        return true;
    }

    public function updatePassword(array $data) :bool{
        $id = $data["id"];
        $password = $data["password"];

        $query = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $params = [
            "password" => $password,
            "id" => $id
        ];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query updatePassword");
        }

        return true;
    }

    public function delete(int $id) :bool{

        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $params = [
            "id" => $id
        ];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query delete");
        }

        return true;
    }

    public function getUserById(int $id) :User|bool{
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $params = ["id" => $id];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query getUserById");
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new User($row); 
        }

        return (bool) false;
    }

    public function getUserByUsername(string $username) :User|bool{
        $query = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $params = ["username" => $username];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query getUserByUsername");
        };

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($row){
            return new User($row);
        }

        return (bool) false;
    }

    public function getUserByEmail(string $email) :User|bool{
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $params = ["email" => $email];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query login");
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if($row){
            return new User($row);
        }

        return (bool) false;
    }

    public function checkExistUsername(string $username) :bool{
        $query = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $params = ["username" => $username];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query checkExistsUsername");
        }

       return (bool) $query->fetch();
    }

    public function checkExistEmail(string $email) :bool{
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $params = ["email" => $email];

        if(!$query->execute($params)){
            throw new Exception("UserModel: error execute query checkExistsEmail");
        }
        
        return (bool) $query->fetch();
    }
}