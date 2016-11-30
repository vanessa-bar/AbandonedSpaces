<?php
	include('include/init.php');
	include('include/functions.php');	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Nature Immuable</title>
		<meta charset="UTF-8"/>	
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" href="css/style.css"/>
	</head>

	<body>
		<?php
			if ($_GET['theme'] == 1) {
				include("include/ruineHeader.php");
			} else if ($_GET['theme'] == 2) {
				include("include/natureHeader.php");
			} else {
				include("include/urbainHeader.php");
			}

			include("include/menu.php");
		?>

		<div class="container">
			<?php
				$response = selectArticleById($_GET['article-id'], $bdd);
				$donnees = $response->fetch();
				$response->closeCursor(); 
			?>
				<div class="article-container">
					<a href="nature.php">Retour</a>

				<?php
					echo '<h1 class="article-title">'.$donnees['titre'].'</h1>';

					echo '<p>Difficulté : ';
					$diff = $donnees['difficulte'];
					for ($i = 0; $i < $diff; $i++) {
						echo '<img class="difficulty-icon" src="img/difficulty.png" alt="diff">';
					}
					for ($i; $i < 3; $i++) {
						echo '<img class="difficulty-icon" src="img/difficultyNone.png" alt="diffNone">';
					}
					echo '</p>';
					echo '<img class="article-img" src='.$donnees['image'].' alt="article-img" />';
					echo '<p class="article-info">Par '.$donnees['auteur'].', le ';
					echo formateDate($donnees['date']);
					echo '</p>';
					echo '<p class="article-content">'.$donnees['contenu'].'</p>';
				?>

			</div>

			<h1>Articles similaires</h1>
		</div>

		<?php
			if ($_GET['theme'] == 1) {
				include("include/ruineFooter.php");
			} else if ($_GET['theme'] == 2) {
				include("include/natureFooter.php");
			} else {
				include("include/urbainFooter.php");
			}
		?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
		/* Bouton Menu sur mobile */
		$(".mobile-nav").click(function() {
			$(".hidden").toggle();
		});
		</script>
	</body>
</html>
