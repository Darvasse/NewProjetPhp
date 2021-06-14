<?php

namespace Database;
class Database {
    private $dbh;
    public function __construct($host, $name, $user, $pass)
    {
        try{
            $this->dbh = new \PDO("mysql:host=$host;dbname=$name", $user, $pass);
        }catch (\PDOException $e){
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getConnection(){
        return $this->dbh;
    }
}