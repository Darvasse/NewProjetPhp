<!-- Magasin -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <title>Nouveau Steam</title>
    <link rel="stylesheet" type="text/css" href="./MainPage.css">
</head>
<?php include "header.php"?>
<body>
<h1>Nouveau Steam</h1>

<a href="/magasin">Magasin</a>

<h1>Derniers jeux</h1>
<table>

    <?php foreach ($params['games'] as $game) : ?>
        <tr>
            <td><a href="/jeu/<?= $game['Name']; ?>"><?=$game['Name'];?></a></td>
            <td><?= $game['name']; ?></td>
            <td><?= $game['Description']; ?></td>
        </tr>
    <?php endforeach; ?>

</table>
</body>
</html>