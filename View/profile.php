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
    <table>
        <?php foreach ($params['games'] as $game) : ?>
            <tr>
                <td width="100" align="center"><a href="/jeu/<?= $game['Name']; ?>"><?=$game['Name'];?></a></td>
                <td width="100" align="center"><?= $game['name']; ?></td>
                <td width="150" align="center">Téléchargé <?= $game['nbTelechargement']; ?> fois</td>
                <td align="center"><?= $game['Description']; ?></td>
            </tr>
        <?php endforeach; ?>


    </table>
</body>
</html>