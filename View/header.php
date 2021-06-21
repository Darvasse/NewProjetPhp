<p>
	<hr/>
		<h1 class="Title">Bienvenue sur le nouveau steam !</h1>
		<?php 
		session_start();
		if (isset($_SESSION["pseudo"]) && isset($_SESSION["password"])) {
			echo "Bienvenue " . $_SESSION["pseudo"];
		}
		else {
			echo "<div>
                	<button>Connection</button>
                	<button>Inscription</button>
        		</div>";
		}
		?>
	<hr/>
</p>
