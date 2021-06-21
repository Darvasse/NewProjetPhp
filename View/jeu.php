<!-- Magasin -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <title>Nouveau Steam</title>
</head>
<body>
<h1><?=$params['Name']; ?></h1>

<table>


    <tr>
        <td><?=$params['name']; ?></td>
    </tr>
    <tr>
        <td><?=$params['Description']; ?></td>
    </tr>
    <tr>
        <td>  </td>
    </tr>
    <tr>
        <td><a href="<?=$params['DownloadLink']; ?>">Telecharger</a></td>
    </tr>

    <?php
        if ($_SESSION['id'] === $params['creatorID'])
        {
            echo "<a href='/delete'><button> Supprimer</button></a>";
        }
    ?>

</table>
</body>
</html>
