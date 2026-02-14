<?php
require_once "Config.php";

class Database
{
    private $connection;
    
    public function __construct()
    {
        $this->dbConnect();
    }
    public function dbConnect()
    {   
        $this->connection = new PDO("mysql:host=".CONTAINER_NAME_DB.";dbname=".MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD);
    }

    public function query($query){return $this->connection->query($query);}
    public function prepare($query){return $this->connection->prepare($query);}
    public function lastInsertId(){return $this->connection->lastInsertId();}
}
