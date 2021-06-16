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

    public function search()
    {
        //TODO Lilian
    }
}