<html>

    <head>
        <title>Page de connection</title>
        <meta charset="utf-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./formCSS.css">
    </head>

    <body>     
        <form method="post" action="/connection/validation">
            <h2>Connectez vous</h2>
            Email : <input type="email" name="email" class="Input" required/>
            <br/>
            Mot de passe : <input type="password" name="mdp" class="Input" required/>
            <br/>
            <br/>
            <input type="submit" value="Valider" class="submit">
            <br/>
            <br/>
        </form>
    </body>
</html>