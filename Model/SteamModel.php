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
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description, COUNT(uj.idjeu) as nbTelechargement FROM jeu j INNER JOIN categorie c ON c.id = j.CategorieID INNER JOIN userjeu uj ON uj.idjeu = j.id GROUP BY j.Name ORDER BY j.Name');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOneGame($name)
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description, j.DownloadLink, j.creatorID FROM jeu j INNER JOIN categorie c WHERE c.id = j.CategorieID AND j.Name LIKE :name');
        $query->execute([':name' => $name]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getLastGames()
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description, COUNT(uj.idjeu) as nbTelechargement FROM jeu j INNER JOIN categorie c ON c.id = j.CategorieID LEFT JOIN userjeu uj ON uj.idjeu = j.id GROUP BY j.id ORDER BY j.id DESC LIMIT 5 ');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchByName($name)
    {
        $query = $this->conn->prepare('SELECT j.id, j.Name, c.name, j.Description, COUNT(uj.idjeu) as nbTelechargement FROM jeu j INNER JOIN categorie c ON c.id = j.CategorieID LEFT JOIN userjeu uj ON uj.idjeu = j.id WHERE j.Name LIKE :search GROUP BY j.Name ORDER BY j.Name');
        $query->execute([':search' => '%' . $name . '%']);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchByCategory($category)
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description FROM jeu j, COUNT(uj.idjeu) as nbTelechargement INNER JOIN categorie c ON c.id = j.CategorieID LEFT JOIN userjeu uj ON uj.idjeu = j.id WHERE c.name LIKE :search GROUP BY j.Name ORDER BY j.Name');
        $query->execute([':search' => $category]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function downloadGame($idUser, $idJeu)
    {
        $query = $this->conn->prepare('INSERT INTO userjeu (iduser, idjeu) VALUES (:idUser, :idJeu)');
        $query->execute(['idUser' => $idUser, 'idJeu' => $idJeu]);
        return;
    }

    public function modifyGame($id, $newName, $newDesc, $newCategory, $newLink)
    {
        if ($newName != null)
        {
            $query = $this->conn->prepare('UPDATE jeu SET Name = :newName WHERE jeu.id = :id');
            $query->execute(['newName' => $newName, 'id' => $id]);
        }

        if ($newDesc != null)
        {
            $query = $this->conn->prepare('UPDATE jeu SET Description = :newDesc WHERE jeu.id = :id');
            $query->execute(['newDesc' => $newDesc, 'id' => $id]);
        }

        if ($newCategory != null)
        {
            $query = $this->conn->prepare('UPDATE jeu SET CategoryID = :newCategory WHERE jeu.id = :id');
            $query->execute(['newCategory' => $newCategory, 'id' => $id]);
        }

        if ($newLink != null)
        {
            $query = $this->conn->prepare('UPDATE jeu SET DownloadLink = :newLink WHERE jeu.id = :id');
            $query->execute(['newLink' => $newLink, 'id' => $id]);
        }
        return;
    }

    public function deleteGame($name, $userID)
    {
        $query = $this->conn->prepare('DELETE FROM userjeu WHERE id = :userID;
DELETE FROM jeu WHERE jeu.Name = :name');
        $query->execute(['name' => $name, 'userID' => $userID]);
        return;
    }

    public function validationInscription($email, $password, $pseudo)
    {
        $verify = $this->conn->prepare('SELECT email FROM users WHERE email = :email');
        $add = $this->conn->prepare('INSERT INTO users(username,password,email) VALUES(:username,:password,:email)');
        $verify->execute(array('email' => htmlspecialchars($email)));

        if ($verify->rowCount() > 0) 
        { //Vérification de l'existence du pseudo
            echo "Email utilisé";
        } 

        else 
        {
        $add->execute(array(
            'username' => htmlspecialchars($pseudo),
            'password' => password_hash($password,PASSWORD_BCRYPT),
            'email' => htmlspecialchars($email)
            )); //Envois du pseudo mdp et email à la BDD
        }
    }
    public function validationConnection($email, $password) {
        session_start();
        //session_unset();
        $reqValidation = $this->conn->prepare('SELECT id,username,password,email FROM users WHERE email = ?'); //recuperation du champ correspondant au pseudo
        $reqValidation->execute(array(
            htmlspecialchars($email)
        ));
        $result = $reqValidation->fetch(\PDO::FETCH_ASSOC);
        if (password_verify($password,$result['password'] )) //Vérification du hash
        {        
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $result['username'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['email'] = $result['email'];
        }
        else
        {
            echo "Identifiants invalides";
        }
    }
}