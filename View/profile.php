<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
</head>
<body>
	<h1>Profile</h1>
	<?php
	session_start();
	if (isset($_SESSION["pseudo"]) && isset($_SESSION["password"])) {
		echo "<b>Pseudo: </b>" . $_SESSION["pseudo"];
		echo "<br/>";
		echo "<b>E-mail: </b>" . $_SESSION["email"];
	}
	?>
</body>
</html>