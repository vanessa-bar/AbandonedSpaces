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
					echo '<p>'.$donnees['continent'].' '.$donnees['climat'].'</p>';
					echo '<p class="article-content">'.$donnees['contenu'].'</p>';
				?>

			</div>

			<h1>Articles similaires</h1>

			<?php
				if ($_GET['article-id'] == 1) {
			?>	
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Um_El_Ma.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 30 Nov. 2016</p>
							<p class="article-item-title">Mère de l’eau au Sahara, l’histoire simple d’un lac en Libye</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="3" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Machu_Picchu.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Test le 30 Nov. 2016</p>
							<p class="article-item-title">Du Cruzco au Machu Picchu : une traversée Inca</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="5" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="1">
							</form>
						</div>
					</div>
				</div>
			<?php
				} else if ($_GET['article-id'] == 2) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Nara_Dreamland.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Test le 30 Nov. 2016</p>
							<p class="article-item-title">Nara Dreamland, exploration au pays des rêves abandonnés</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="4" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="3">
							</form>
						</div>
					</div>
				</div>
			<?php
				} else if ($_GET['article-id'] == 3) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Lion_de_Babylone.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Nov. 2016</p>
							<p class="article-item-title">Là où les passés s’entremêlent et le présent s’en mèle, Babylone</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="1" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="1">
							</form>
						</div>
					</div>
				</div>
			<?php
				} else if ($_GET['article-id'] == 4) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Pyramiden.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 19 Nov. 2016</p>
							<p class="article-item-title">Pyramiden, au delà du cercle polaire, ville russe en Norvège</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="2" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="3">
							</form>
						</div>
					</div>
				</div>
			<?php
				} else if ($_GET['article-id'] == 5) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Lion_de_Babylone.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Nov. 2016</p>
							<p class="article-item-title">Là où les passés s’entremêlent et le présent s’en mèle, Babylone</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="1" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="1">
							</form>
						</div>
					</div>
				</div>
			<?php
				} else {
					echo "Aucun article similaire.";
				}

			?>
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
		<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
		<script>
		/* Bouton Menu sur mobile */
		$(".mobile-nav").click(function() {
			$(".hidden").toggle();
		});

		/* Animation du bouton "Lire plus" des articles */
		$(".article-item-link")
		.mouseenter(function() {
			btn = $(this).find($("img"));
			btn.fadeOut(300, function() {
				btn.attr("src","img/article-btn-hover.png");
				btn.fadeIn(300);
			});
		})
		.mouseleave(function() {
			btn = $(this).find($("img"));
			btn.attr('src', "img/article-btn.png");
		});

		var grid = $('.grid').isotope({
		  itemSelector: '.grid-item',
		  percentPosition: true,
		  layoutMode: 'fitRows',
			masonry: {
		    // use element for option
		    columnWidth: '.grid-sizer'
		  }
		});
		</script>
	</body>
</html>
