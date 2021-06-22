<!-- Poster -->
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
            <form action="/poster" method="post">
                <p>Poster un jeu</p>
                <input type="text" name="name" placeholder="Nom du jeu" required>
                <input type="text" name="desc" placeholder="Description" required>
                <select type="number" name="category" required>
                    <option value="0" disabled selected>Categorie</option>
                    <option value="2">Action</option>
                    <option value="3">Aventure</option>
                    <option value="4">Course</option>
                    <option value="1">Survie</option>
                </select>
                <input type="text" name="link" placeholder="Lien de téléchargement" required>
                <input type="submit" value="Poster">
            </form>
        </td>

</table>
</body>
</html>

