<!-- MainView -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <title>Nouveau Steam</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../MainPage.css">
</head>

<body>
<?php include "header.php"?>
<h1>Nouveau Steam</h1>

<a href="/magasin">Magasin</a>

<h1>Derniers jeux</h1>
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