<p>
	<hr/>
		<h1 class="Title">Bienvenue sur le nouveau steam !</h1>
		<?php 
		session_start();
		if (isset($_SESSION["pseudo"]) && isset($_SESSION["password"])) {
			echo "Bienvenue " . $_SESSION["pseudo"];
		}
		else {
			?>
				<div>
                	<button onclick="window.location.href = '/connection'">Connection</button>
                	<button onclick="window.location.href = '/inscription'">Inscription</button>
        		</div>
			<?php
		}
		?>
	<hr/>
</p>
