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
$reqValidation = $bdd->prepare('SELECT id,username,password,email FROM users WHERE email = :email'); //recuperation du champ correspondant au pseudo
$reqValidation->execute(array(
	'email' => htmlspecialchars($_POST['email'])
));


$result = $reqValidation->fetch(PDO::FETCH_ASSOC); //Conversion du résultat en array

if (password_verify($_POST['mdp'],$result['password'] )) //Vérification du hash
{
	

    header('location:../site.php'); //Redirection vers le site
    
    $_SESSION['id'] = $result['id'];
    $_SESSION['pseudo'] = $result['username'];
    $_SESSION['password'] = $result['password'];
    $_SESSION['email'] = $result['email'];

} 

else 
{
    echo "Pseudo ou mot de passe incorrecte";
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