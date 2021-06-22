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
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description, COUNT(uj.idjeu) as nbTelechargement FROM jeu j INNER JOIN categorie c ON c.id = j.CategorieID LEFT JOIN userjeu uj ON uj.idjeu = j.id GROUP BY j.Name ORDER BY j.Name');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOneGame($name)
    {
        $query = $this->conn->prepare('SELECT j.id, j.Name, c.name, j.Description, j.DownloadLink, j.creatorID FROM jeu j INNER JOIN categorie c WHERE c.id = j.CategorieID AND j.Name LIKE :name');
        $query->execute([':name' => $name]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getLastGames()
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description, COUNT(uj.idjeu) as nbTelechargement FROM jeu j INNER JOIN categorie c ON c.id = j.CategorieID LEFT JOIN userjeu uj ON uj.idjeu = j.id GROUP BY j.id ORDER BY j.id DESC LIMIT 5 ');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDownloadedGames($idUser)
    {
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description, COUNT(uj.idjeu) as nbTelechargement FROM jeu j 
INNER JOIN categorie c ON c.id = j.CategorieID
LEFT JOIN userjeu uj ON uj.iduser = :idUser WHERE j.id = uj.idjeu GROUP BY j.Name');
        $query->execute(['idUser' => $idUser]);
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
        $query = $this->conn->prepare('SELECT j.Name, c.name, j.Description, COUNT(uj.idjeu) as nbTelechargement FROM jeu j INNER JOIN categorie c ON c.id = j.CategorieID LEFT JOIN userjeu uj ON uj.idjeu = j.id WHERE c.name LIKE :search GROUP BY j.Name ORDER BY j.Name');
        $query->execute([':search' => $category]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function downloadGame($idUser, $idJeu)
    {
        $verif = $this->conn->prepare('SELECT iduser FROM userjeu WHERE iduser = :id AND idjeu = :idjeu');
        $query = $this->conn->prepare('INSERT INTO userjeu (iduser, idjeu) VALUES (:idUser, :idJeu)');
        $verif->execute(['id' => $idUser, 'idjeu' => $idJeu]);
        if ($verif->rowCount() >= 1) {
            return;
        }
        else {
           $query->execute(['idUser' => $idUser, 'idJeu' => $idJeu]); 
        }
        return;
    }

    public function modifyGame($id, $newName, $newDesc,int $newCategory, $newLink)
    {
        if ($newName != null)
        {
            $query = $this->conn->prepare('UPDATE jeu SET Name = :newName WHERE jeu.id = :id');
            $query->execute(['newName' => htmlspecialchars($newName), 'id' => $id]);
        }

        if ($newDesc != null)
        {
            $query = $this->conn->prepare('UPDATE jeu SET Description = :newDesc WHERE jeu.id = :id');
            $query->execute(['newDesc' => htmlspecialchars($newDesc), 'id' => $id]);
        }

        if ($newCategory != 0)
        {
            $query = $this->conn->prepare('UPDATE jeu SET CategorieID = :newCategory WHERE jeu.id = :id');
            $query->execute(['newCategory' => htmlspecialchars($newCategory), 'id' => $id]);
        }

        if ($newLink != null)
        {
            $query = $this->conn->prepare('UPDATE jeu SET DownloadLink = :newLink WHERE jeu.id = :id');
            $query->execute(['newLink' => htmlspecialchars($newLink), 'id' => $id]);
        }
        return;
    }

    public function deleteGame($name, $userID)
    {
        $query = $this->conn->prepare('DELETE FROM userjeu WHERE id = :userID;
DELETE FROM jeu WHERE jeu.Name = :name');
        return $query->execute(['name' => htmlspecialchars($name), 'userID' => $userID]);

    }

    public function uploadGame($name, $desc, $category, $link, $creatorID)
    {
        $query = $this->conn->prepare('INSERT INTO jeu (Name, Description, CategorieID, DownloadLink, creatorID) VALUES (:name, :desc, :category, :link, :creatorID);');
        return $query->execute([
            ':name' => htmlspecialchars($name),
            ':desc' => htmlspecialchars($desc),
            ':category' => htmlspecialchars($category),
            ':link' => htmlspecialchars($link),
            'creatorID' => htmlspecialchars($creatorID)
        ]);
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
        session_unset();
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

    public function modifyProfile($id, $pseudo, $mail)
    {
        if($pseudo != null)
        {
            $_SESSION['pseudo'] = htmlspecialchars($pseudo);
            $query = $this->conn->prepare('UPDATE users SET username = :pseudo WHERE users.id = :id; ');
            $query->execute([
                'pseudo' => htmlspecialchars($pseudo),
                'id' => htmlspecialchars($id)
            ]);
        }
        if($mail != null)
        {
            $_SESSION['email'] = htmlspecialchars($mail);
            $query = $this->conn->prepare('UPDATE users SET email = :mail WHERE users.id = :id;');
            $query->execute([
                'mail' => htmlspecialchars($mail),
                'id' => htmlspecialchars($id)
            ]);
        }
        return;
    }

}
