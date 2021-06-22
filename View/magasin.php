<!-- Magasin -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />

    <title>Nouveau Steam</title>
</head>
<body>
<h1>Jeux</h1>


<table>
    <tr>
        <td>
            <a href="/poster-jeu"><button>Poster un jeu</button></a>
        </td>
    </tr>
    <tr>
        <td><form action="/magasin" method="post">
                <p>Rechercher un jeu :</p>
                <input type="text" name="name">
                <input type="submit">
            </form></td>
        <td width="100" align="center">
            <a href="/magasin/Action">Action</a>
        </td>
        <td width="100" align="center">
            <a href="/magasin/Aventure">Aventure</a>
        </td>
        <td width="100" align="center">
            <a href="/magasin/Course">Course</a>
        </td>
        <td width="100" align="center">
            <a href="/magasin/Survie">Survie</a>
        </td>
    </tr>
</table>
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