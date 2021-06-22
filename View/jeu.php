<!-- Jeu -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../jeuCss.css">
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
        <td><!--<a href="<?=$params['DownloadLink']; ?>">-->
            <form method="POST" action="/downloadGame">
                <input type="text" name="dllink" value="<?=$params['DownloadLink'];?>" hidden/>
                <input type="text" name="idjeu" value="<?=$params['id'];?>" hidden/>
                <input type="submit" value="Telecharger" />
            </form>
            <!--<a href="/<?=$params['DownloadLink'];?>">
                    <button>Telecharger</button>
            </a>--></td>
    </tr>

    <td>
    <?php

    session_start();
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
