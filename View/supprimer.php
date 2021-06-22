<!-- Supprimer -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <title>Nouveau Steam</title>
</head>
<body>

    <p>Etes vous sûr de vouloir suppimer <?=$params['Name']?> du site ?</p>
    <a href="/delete/<?=$params['Name']?>"><button>Oui</button></a>
    <a href="/jeu/<?=$params['Name']?>"><button>Non</button></a>
</body>
</html>
