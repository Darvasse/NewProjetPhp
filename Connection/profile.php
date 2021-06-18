<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="CSS/indexstyle.css">
		<meta charset="utf-8" />
		<title>Profile</title>
	</head>
	<body>
		<?php include("header.php");
		if (isset($_SESSION['pseudo']))
        {
        	echo "Pseudo : " . $_SESSION['pseudo'] . "<br/>";
        	echo "email : " . $_SESSION['email'] . "<br/>";
        }
        else
        {
        	die("Aucune session enregistrée");
        }
        ?>
	</body>
</html>