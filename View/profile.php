<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./profileCss.css">
	<title>Profile</title>
</head>
<body>
	<h1>Profile</h1>
    <table>
        <tr>
            <form action="/profile/modify" method="post">
                <p>Modifier informations :</p>
                <input type="text" name="pseudo" placeholder="Pseudo" >
                <input type="text" name="mail" placeholder="E-mail" >
                <input type="submit" value="Mettre à jour">
            </form>
        </tr>
    </table>
    <table>
        <tr><td>Vos jeux</td></tr>
        <?php foreach ($params['games'] as $game) : ?>
            <tr>
                <td class="disp" width="100" align="center"><a href="/jeu/<?= $game['Name']; ?>"><?=$game['Name'];?></a></td>
                <td class="disp" width="100" align="center"><?= $game['name']; ?></td>
                <td width='150' align='center'>Téléchargé <?=$game['nbTelechargement']; ?> fois</td>
                <td align="center"><?= $game['Description']; ?></td>
            </tr>
        <?php endforeach; ?>


    </table>
</body>
</html>