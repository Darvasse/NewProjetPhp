<?php

namespace Model;

use Database\Database;

class SteamModel
{
    private $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAllGames()
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description FROM jeu j INNER JOIN categorie c WHERE c.id = j.CategorieID ORDER BY j.Name');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOneGame($name)
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description FROM jeu j INNER JOIN categorie c WHERE c.id = j.CategorieID AND j.Name LIKE :name');
        $query->execute([':name' => $name]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function searchByName($name)
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description FROM jeu j INNER JOIN categorie c WHERE c.id = j.CategorieID AND j.Name LIKE :search ORDER BY j.Name');
        $query->execute([':search' => '%' . $name . '%']);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchByCategory($category)
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description FROM jeu j INNER JOIN categorie c WHERE c.id = j.CategorieID AND c.name LIKE :search ORDER BY j.Name');
        $query->execute([':search' => $category]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function validationConnection($email, $password)
    {
        
    }
}