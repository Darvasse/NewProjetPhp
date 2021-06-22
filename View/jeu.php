<!-- Jeu -->
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
        <td><a href="<?=$params['DownloadLink']; ?>">
                <button>Telecharger</button>
            </a></td>
    </tr>

    <td>
    <?php
        if ($_SESSION['id'] === $params['creatorID'])
        {
            echo "<tr><td><a href='/jeu/$params[Name]/modifier'><button>Modifier</button></a></td></tr>";
            echo "<tr><td><a href='/jeu/$params[Name]/supprimer'><button> Supprimer</button></a></td></tr>";
        }
    ?>
    </td>

</table>
</body>
</html>
