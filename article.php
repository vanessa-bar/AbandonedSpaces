<?php
	include('include/init.php');
	include('include/functions.php');	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Nature Immuable</title>
		<meta charset="UTF-8"/>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="icon" type="image/png" href="img/favicon.png" />
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
		?>

		<nav>
			<button class="mobile-nav">Menu</button>
			<div class="clearfix"></div>
			<div class="hidden">
				<ul class="navbar">
					<li class="search-hide"><a href="index.html"><img class="nav-menuIcon" src="img/menuIcon.png" alt="Accueil"/></a></li>
					<li class="search-hide"><a href="ruines.php">Passé Suspendu</br>
							<span class="nav-subtitle">- vestiges -</span></a>
					</li>
					<li class="search-hide"><a href="urbain.php">Quotidien Figé</br>
						<span class="nav-subtitle">- urbains -</span></a>
					</li>
					<li class="search-hide"><a href="nature.php">Nature Immuable</br>
						<span class="nav-subtitle">- lieux reculés -</span></a>
					</li>
					<li class="search-hide"><a href="carte.php">Carte</a></li>
					<li class="search-hide"><a href="a_propos.php">A Propos</a></li>
					<li class="search-link">
						<form method="POST" action="resultats.php">
							<input type="text" name="keyword" value="">
							<input type="submit" class="submit-search-btn" value="">
						</form>
					</li>
				</ul>
			</div>
			<img src="img/menuLine.png" style="position:absolute;bottom:0;">
		</nav>

		<div class="container">
			<?php
				$response = selectArticleById($_GET['article-id'], $bdd);
				$donnees = $response->fetch();
				$response->closeCursor(); 
			?>
				<div class="article-container">
			<?php
				if ($_GET['theme'] == 1) {
					echo '<a href="ruines.php">Retour</a>';
				} else if ($_GET['theme'] == 2) {
					echo '<a href="nature.php">Retour</a>';
				} else {
					echo '<a href="urbain.php">Retour</a>';
				}
			?>

				<?php
					echo '<h1 class="article-title">'.$donnees['titre'].'</h1>';

					echo '<p>Difficulté : ';
					$diff = $donnees['difficulte'];
					for ($i = 0; $i < $diff; $i++) {
						if ($_GET['theme'] == 1) {
							echo '<img class="difficulty-icon" src="img/RISQUE_VESTIGES.png" alt="diff">';
						} else if ($_GET['theme'] == 2) {
							echo '<img class="difficulty-icon" src="img/RISQUE_NATURE.png" alt="diff">';
						} else {
							echo '<img class="difficulty-icon" src="img/RISQUE_URBAIN.png" alt="diff">';
						}
						
					}
					for ($i; $i < 3; $i++) {
						if ($_GET['theme'] == 1) {
							echo '<img class="difficulty-icon" src="img/RISQUE_VESTIGES_GRIS.png" alt="diff">';
						} else if ($_GET['theme'] == 2) {
							echo '<img class="difficulty-icon" src="img/RISQUE_NATURE_GRIS.png" alt="diff">';
						} else {
							echo '<img class="difficulty-icon" src="img/RISQUE_URBAIN_GRIS.png" alt="diff">';
						}
					}
					echo '</p>';
					echo '<img class="article-img" src='.$donnees['image'].' alt="article-img" />';
					echo '<p class="article-info">Par '.$donnees['auteur'].', le ';
					echo formateDate($donnees['date']);
					echo '</p>';
					echo '<p class="article-content">'.$donnees['contenu'].'</p>';

				?>
					<div class="article-complementary-info">
					<?php
						$response_hashtags = getArticleHashtags($_GET['article-id'], $bdd);	
						echo "<form action='resultats.php' method='POST'>";
						while ($donnees_hashtags = $response_hashtags->fetch()) {
							echo "<input type='submit' name='hashtag' value=".$donnees_hashtags['nom']." data-filter='."
							.$donnees_hashtags['nom']."' class='hashtag'>";
						}
						echo '</form>';
						$response_hashtags->closeCursor();
					?>

						<div id="map-article">
						</div>

						<form class="map-form" action="carte.php">
							<input class="map-button" type="submit" value="Voir la carte complète">
						</form>
					</div>
			</div>

			<h1>Articles similaires</h1>

			<?php
				if ($_GET['article-id'] == 1) {
			?>	
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Grand_Zimbabwe.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 12 Oct. 2016</p>
							<p class="article-item-title">Le Grand Zimbabwe et ses pierres, reflet d’un empire déchu</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="9" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="1">
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
						<img class="article-item-img" src="img/Hashima.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 4 Déc. 2016</p>
							<p class="article-item-title">Ambiance apocalyptique à Hashima</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="8" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="3">
							</form>
						</div>
					</div>
					
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Pripyat.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Déc. 2016</p>
							<p class="article-item-title">Tchernobyl, explosion et nucléaire : le lendemain à Pripyat</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="10" type="submit">
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
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Salar_Uyuni.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 11 Déc. 2016</p>
							<p class="article-item-title">Plaine salée en Bolivie, cap sur sur le désert d’Uyuni</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="13" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
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
						<img class="article-item-img" src="img/Hashima.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 4 Déc. 2016</p>
							<p class="article-item-title">Ambiance apocalyptique à Hashima</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="8" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="3">
							</form>
						</div>
					</div>
					
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Pripyat.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Déc. 2016</p>
							<p class="article-item-title">Tchernobyl, explosion et nucléaire : le lendemain à Pripyat</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="10" type="submit">
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

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Vinicunca.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Déc. 2016</p>
							<p class="article-item-title">Entre lamas et couleurs, à la découverte des Rainbow Mountains</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="11" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

				</div>

			<?php
			
				} else if ($_GET['article-id'] == 6) {
			?>	
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Machu_Picchu.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 30 Nov. 2016</p>
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

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Grand_Zimbabwe.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Déc. 2016</p>
							<p class="article-item-title">Le Grand Zimbabwe et ses pierres, reflet d’un empire déchu</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="9" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="1">
							</form>
						</div>
					</div>
				</div>
			
			<?php
				} else if ($_GET['article-id'] == 7) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Auckland_Islands.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Nov. 2016</p>
							<p class="article-item-title">L’archipel d’Auckland : sept îles à la biodiversité hors du commun</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="12" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Vinicunca.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Déc. 2016</p>
							<p class="article-item-title">Entre lamas et couleurs, à la découverte des Rainbow Mountains</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="11" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

				</div>

			<?php
				} else if ($_GET['article-id'] == 8) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="iimg/Nara_Dreamland.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 30 Nov. 2016</p>
							<p class="article-item-title">Nara Dreamland, exploration des rêves abandonnés</p>
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
					
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Pripyat.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Déc. 2016</p>
							<p class="article-item-title">Tchernobyl, explosion et nucléaire : le lendemain à Pripyat</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="10" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="3">
							</form>
						</div>
					</div>

				</div>
			
			<?php
				} else if ($_GET['article-id'] == 9) {
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

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Machu_Picchu.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 30 Nov. 2016</p>
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
				} else if ($_GET['article-id'] == 10) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Hashima.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 4 Déc. 2016</p>
							<p class="article-item-title">Ambiance apocalyptique à Hashima</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="8" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="3">
							</form>
						</div>
					</div>
					
					<div class="article-item grid-item">
						<img class="article-item-img" src="iimg/Pyramiden.jpg" alt="img_article">
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
				} else if ($_GET['article-id'] == 11) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Auckland_Islands.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Nov. 2016</p>
							<p class="article-item-title">L’archipel d’Auckland : sept îles à la biodiversité hors du commun</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="12" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Terre_de_Feu.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 4 Déc. 2016</p>
							<p class="article-item-title">Terre de Feu et bout du monde : la Patagonie intacte</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="7" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

				</div>
			<?php
				} else if ($_GET['article-id'] == 12) {
			?>
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Vinicunca.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 10 Déc. 2016</p>
							<p class="article-item-title">Entre lamas et couleurs, à la découverte des Rainbow Mountains</p>
							<p class="article-item-hashtag">
								
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="11" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Terre_de_Feu.jpg" alt="img_article">
						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 4 Déc. 2016</p>
							<p class="article-item-title">Terre de Feu et bout du monde : la Patagonie intacte</p>
							<p class="article-item-hashtag">
									
							</p>

							<form method="GET" action="article.php"> 
								<button class="article-item-link" name="article-id" value="7" type="submit">
									<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
								</button>
								<input type="hidden" name="theme" value="2">
							</form>
						</div>
					</div>

				</div>

			<?php
			
				} else if ($_GET['article-id'] == 13) {
			?>	
				<div class="grid">
					<div class="grid-sizer"></div>
					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Machu_Picchu.jpg" alt="img_article">

						<div class="article-item-description">
							<p class="article-item-info">Par Elise le 30 Nov. 2016</p>
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

					<div class="article-item grid-item">
						<img class="article-item-img" src="img/Grand_Zimbabwe.jpg" alt="img_article">
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
				</div>
			
			<?php

				} else {
					echo "Aucun article similaire.";
				}
			?>
	
		</div>

		<div class="clearfix"></div>

		<div class="footer">
			<?php
			if ($_GET['theme'] == 1) {
				echo '<img src="img/footer_vestige.png"><div class="footer-infos">';
			} else if ($_GET['theme'] == 2) {
				echo '<img src="img/footer_nature.png"><div class="footer-infos">';
			} else {
				echo '<img src="img/footer_urbain.png"><div class="footer-infos">';
			}
			?>
			<p>Plan du Site - Mentions Légales
				<br/>
				IMAC2 - 2016</p>
			</div>
		</div>

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

		function getUrlVars() {
			var vars = {};
			var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
			});
			return vars;
		}

		var map;
	    var m;
	     
	    function initialize() {
	    	var id = getUrlVars()["article-id"];
		    var coords;
		    if (id == 1) {
		    	coords = [3.8796, 49.8945];
		    } else if (id == 2) {
		    	coords = [78.6546, 16.3448];
		    } else if (id == 3) {
		    	coords = [26.7112, 13.3365];
		    } else if (id == 4) {
		    	coords = [34.6996, 135.8205];
		    } else if (id == 5) {
		    	coords = [-13.1631, -72.5450];
		    } else if (id == 6) {
		    	coords = [56.4037154,-5.0274038];
		    } else if (id == 7) {
		    	coords = [-54.8019121, -68.3029511];
		    } else if (id == 8) {
		    	coords = [32.6278, 129.7386];
		    } else if (id == 9) {
		    	coords = [-20.2675, 30.9316];
		    } else if (id == 10) {
		    	coords = [51.4045, 30.0542];
		    } else if (id == 11) {
		    	coords = [-13.7985, -71.2924];
		    } else {
		    	//TO NOTHING
		    }
	    // Creation de la map
	    var center = new google.maps.LatLng(coords[0], coords[1]);

	    map = new google.maps.Map(document.getElementById('map-article'), {
	    	zoom: 3,
	    	center: center,
	    	mapTypeId: google.maps.MapTypeId.ROADMAP
	    });

	    // Style de la map
	    var styles = [
	    {
	     	stylers: [
	      	{ saturation: -100 }
	      	]
	    },{
	      	featureType: "road",
	      	elementType: "geometry",
	      	stylers: [
	      	{ lightness: 100 },
	      	{ visibility: "simplified" }
	      	]
	    },{
	      	featureType: "road",
	      	elementType: "labels",
	      	stylers: [
	      	{ visibility: "off" }
	      	]
	    }
	    ];

	    map.setOptions({styles: styles});

	    var image = 'img/mapIcon.png';

	    m = new google.maps.Marker({
	    	position: new google.maps.LatLng(coords[0], coords[1]),
	    	icon: image
	    });

		m.setMap(map);
		}
	    </script>
	    <script async defer
	      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKCtDPvAUSer_1leo6WTMHSncwyk9GOxk&callback=initialize">
	    </script>
	</body>
</html>
