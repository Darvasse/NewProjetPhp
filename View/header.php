<link rel="stylesheet" type="text/css" href="../HeaderCSS.css">
<p id="Page">
		<h1 class="Title">Bienvenue sur le nouveau steam !</h1>
		<?php 
		if (isset($_SESSION["pseudo"]) && isset($_SESSION["password"])) {
			echo "Bienvenue " . $_SESSION["pseudo"];
			echo "<button class=\"buttonHeader\" id=\"ProfButtib\" onclick=\"window.location.href = '/profile'\">Profile</button>";
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
