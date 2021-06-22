<!-- Modifier -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8" />
    <title>Nouveau Steam</title>
</head>
<body>
<table>
    <tr>
        <td>
            <form action="/modify" method="post">
                <p>Mettre à jour les informations de <?=$params['Name']?> :</p>
                <input type="hidden" name="id" value="<?=$params['id']?>">
                <input type="text" name="name" placeholder="Nom du jeu">
                <input type="text" name="desc" placeholder="Description">
                <select type="number" name="category">
                    <option value="0" SELECTED>Categorie</option>
                    <option value="2">Action</option>
                    <option value="3">Aventure</option>
                    <option value="4">Course</option>
                    <option value="1">Survie</option>
                </select>
                <input type="text" name="link" placeholder="Lien de téléchargement">
                <input type="submit" value="Mettre a jour">
            </form>
        </td>

</table>
</body>
</html>

