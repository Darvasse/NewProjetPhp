<html>

    <head>
        <title>Page de connection</title>
        <meta charset="utf-8" />
    </head>

    <body>     
        <form method="post" action="/connection/validation">
            <h2>Connectez vous</h2>
            Email : <input type="email" name="email" class="emailInput" required/>
            <br/>
            Mot de passe : <input type="password" name="mdp" class="passwordInput" required/>
            <br/>
            <br/>
            <input type="submit" value="Valider" class="submit">
            <br/>
            <br/>
        </form>

    </body>

</html>