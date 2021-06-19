<!-- Magasin -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;
charset=utf-8" />
    <title>Nouveau Steam</title>
</head>
<body>
<h1>Jeux</h1>

<table>
    <tr>
        <td><form action="/magasin" method="post">
                <p>Rechercher un jeu :</p>
                <input type="text" name="name">
                <input type="submit">
            </form></td>
    </tr>

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