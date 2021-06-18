<?php
session_start();
?>

<!DOCTYPE html>

<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', ''); //Connection à la BDD
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage()); //Recup des erreurs
}
session_unset();
$reqRec = $bdd->prepare('INSERT INTO users(username,password,email) VALUES(:username,:password,:email)'); //Enregistrer un utilisateur dans la BDD
$reqEmail = $bdd->prepare('SELECT email FROM users WHERE email = :email'); //Vérification du pseudo
$reqEmail->execute(array('email' => htmlspecialchars($_POST['email'])));

if ($reqEmail->rowCount() > 0) { //Vérification de l'existence du pseudo
    echo "Email utilisé";
} else {
    $reqRec->execute(array(
            'username' => htmlspecialchars($_POST['pseudo']),
            'password' => password_hash($_POST['mdp'],PASSWORD_BCRYPT),
            'email' => htmlspecialchars($_POST['email'])
            )); //Envois du pseudo mdp et email à la BDD
    header('location:../site.php'); //Redirection vers le site

}


     

?>

<html>

    <head>
        <title>Page de connection</title>
        <meta charset="utf-8" />
    </head>

    <body>

        <p>Vous allez être redirigé, veuillez patienter...</p>

    </body>

</html>