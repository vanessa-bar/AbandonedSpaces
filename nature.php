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
	</head>

	<body>
		<?php
			include("include/natureHeader.php");
			include("include/menu.php");
		?>

		<div class="container">
			<h1>Tous les articles</h1>


			<div class="all-hashtags button-group filter-button-group">
				<?php
					$reponse = selectAllHashtagsByTheme("Lieux Reculés", $bdd);

					while ($donnees = $reponse->fetch()) {
						echo "<button data-filter='.".$donnees['nom']."' class='hashtag'>#".$donnees['nom']."</button>";
					}
				?>
			</div>

			<div class="grid">
			  <!-- width of .grid-sizer used for columnWidth -->
			  <div class="grid-sizer"></div>
			  		<?php
						$reponse = selectArticleByTheme("Lieux Reculés", $bdd);
						while ($donnees = $reponse->fetch()) {
							
					?>

						<div class=
							<?php
								echo '"grid-item article-item';
								$reponse_hash = getArticleHashtags($donnees['id_article'], $bdd);
								while ($donnees_hash = $reponse_hash->fetch()) {
									echo ' '.$donnees_hash['nom'];
								} 
								$reponse_hash->closeCursor(); 
								echo '"';
							?>

						>
							<img class="article-item-img" src=<?php echo '"'.$donnees['image'].'"'; ?> alt="img_article">

							<div class="article-item-description">
								<p class="article-item-info">Par <?php echo $donnees['auteur']; ?>, le <?php echo formateDate($donnees['date']); ?></p>

								<p class="article-item-title"><?php echo $donnees['titre']; ?></p>

								<p class="article-item-hashtag">
									<?php
										$reponse_hash = getArticleHashtags($donnees['id_article'], $bdd);
										while ($donnees_hash = $reponse_hash->fetch()) {
											echo '#'.$donnees_hash['nom'].' ';
										} 
										$reponse_hash->closeCursor(); 
									?>
								</p>

								<form method="GET" action="article.php"> 
									<button class="article-item-link" name="article-id" value=<?php echo '"'.$donnees['id_article'].'"'; ?> type="submit">
										<img class="article-item-btn" src="img/article-btn.png" alt="Lire plus">
									</button>
									<input type="hidden" name="theme" value="2">
								</form>
								
							</div>
						</div>
					<?php
						}
						$reponse->closeCursor();
					?>
			</div>
		</div>

		<div class="footer">
			<p>Plan du Site - Mentions Légales
			<br/>
			IMAC2 - 2016</p>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
		<script>
		/* Bouton Menu sur mobile */
		$( ".mobile-nav" ).click(function() {
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

		// Tri des articles en fonction des hashtag sélectionnés grace à la lib Isotope
		var grid = $('.grid').isotope({
		  itemSelector: '.grid-item',
		  percentPosition: true,
		  layoutMode: 'fitRows',
			masonry: {
		    // use element for option
		    columnWidth: '.grid-sizer'
		  }
		});
		
		$('.filter-button-group').on('click', 'button', function() {

			if ($(this).attr('class') == "hashtag") {
				$(this).attr('class', "hashtag-selected");
			} else {
				$(this).attr('class', "hashtag");
			}

			// On récupére tous les hashtags sélectionnés
			var inclusives = [];
			$('.hashtag-selected').each(function() {
			  inclusives.push($(this).attr('data-filter'));
			});

			  // combine inclusive filters
			  var filterValue = inclusives.length ? inclusives.join(', ') : '*';

			  grid.isotope({ filter: filterValue });
		});
		</script>
	</body>

</html>
