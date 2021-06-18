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

    public function searchByName($name)
    {
        $query = $this->conn->prepare('SELECT g.name, g.category, g.description FROM game g WHERE g.name LIKE :search ORDER BY g.name');
        $query->execute([':search' => '%' . $name . '%']);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchByCategory($category)
    {
        $query = $this->conn->prepare('SELECT g.name');
    }
}