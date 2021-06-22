<p id="Page">
	<link rel="stylesheet" type="text/css" href="./HeaderCSS.css">
		<h1 class="Title">Bienvenue sur le nouveau steam !</h1>
		<?php 
		//session_start();
		if (isset($_SESSION["pseudo"]) && isset($_SESSION["password"])) {
			echo "Bienvenue " . $_SESSION["pseudo"];
			echo "<button class=\"buttonHeader\" onclick=\"window.location.href = '/profile'\">Profile</button>";
		}
		else {
			?>
				<div class="buttonContainer">
                	<button class="buttonHeader" onclick="window.location.href = '/connection'">Connection</button>
                	<button class="buttonHeader" onclick="window.location.href = '/inscription'">Inscription</button>

        		</div>
			<?php
		}
		?>
</p>
