<?php

class DatabaseService
{

    private $databaseName;
    private $userName;
    private $userPassword;

    public function __construct()
    {
        $this->databaseName = "beb_test_05052020";
        $this->userName = "root";
        $this->userPassword = "";
    }

    public function connect()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=$this->databaseName;charset=utf8", $this->userName, $this->userPassword);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

    public function queryData($sqlStatement)
    {
        return $this->connect()->query($sqlStatement)->fetchAll(PDO::FETCH_ASSOC);
    }
}