<?php
	include('include/init.php');
	include('include/functions.php');	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>A propos</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link rel="icon" type="image/png" href="img/favicon.png" />
	</head>

	<body>
		<?php
			include("include/aProposHeader.php");
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
			<div class="about-container">
				<h1>Le concept</h1>

				<p class="about-content">
					Un site sur le voyage ? Encore un ? <br/>
					Oui ! Mais cette fois un site différent !<br/>
					Oh oui, tous les sites sont différents... Mais le nôtre l’est plus !<br/>

					<br/>
					Avez-vous déjà secrètement rêvé, sans oser réellement y penser, de voyager dans l’inconnu ? De découvrir des nouveaux espaces, inexplorés ? Des lieux où se mélangent la nature et les constructions humaines ? Ou simplement la nature. Sans trace humaine ! Pour une fois, être seul… Se mesurer à l’existence, une réflexion sur l’Homme et la nature, sur nous-même et pourquoi pas, sur la société elle-même et son superflu. <br/>

					<br/>
					Oui ? C’est bien pourquoi vous êtes sur cette page ! Nous aussi !<br/>
					Vous pourrez donc explorer différentes catégories de lieux et de possibles voyages et fonction du type de voyage qui vous attire le plus :<br/> 
						<span class="indented-line">- le passé et son lien avec le présent</span><br/>
						<span class="indented-line">- la nature et son lien avec le temps</span><br/>
						<span class="indented-line">- la nature et elle-même, seule et unique</span><br/>
					Ces catégories sont poreuses et nous vous incitons et fortement à explorer chacune d’elles !<br/>
				</p>

				<h1>Qui sommes-nous ?</h1>
				
				<div class="about-content">
					<div class="row">
						<div class="flex-1 img-container">
							<img class="profil-img" src="img/vanessa.png" alt="Vanessa Bar">
						</div>
						<div class="flex-2">
							<h2>Vanessa Bar</h2>
							<br/>
							<p>Vanessa au bout du monde. De l’Asie à la Turquie pour elle il n’y a qu’un pas. Partant à la 
							découverte des cultures et du patrimoine, temples et coutumes qu’elle photographie avec délicatesse. 
							Elle emporte avec elle et fait voyager les souvenirs laissés par les rencontres, qui font de fait le 
							tour du monde avec elle.</p>

							<div style="text-align: center">	
								<span class="hashtag">#rencontres</span> 
								<span class="hashtag">#souvenirs</span>
								<span class="hashtag">#photos</span>
							</div>
						</div>
					</div>

					<div class="space"></div>

					<div class="row">
						<div class="flex-2">
							<h2>Elise Ritoux</h2>
							<br/>
							<p>Elise. Toujours en sac à dos, parfois à l'hôtel, d’autres fois à l’auberge de jeunesse, souvent chez
							 l’habitant, et le reste du temps sous sa tente. À la découverte des cultures et des trésors de la nature,
							  Elise part tantôt dans la nature, tantôt dans les villes.<br/>
							<br/>
							</p>

							<div style="text-align: center">	
								<span class="hashtag">#rencontres</span> 
								<span class="hashtag">#sacàdos</span> 
								<span class="hashtag">#toutseul</span>
							</div>
						</div>
						<div class="flex-1 img-container">
							<img class="profil-img" src="img/elise.png" alt="Elise Ritoux">
						</div>
					</div>

					<div class="space"></div>

					<div class="row">
						<div class="flex-1 img-container">
							<img class="profil-img" src="img/julie.png" alt="Julie Puech">
						</div>
						<div class="flex-2">
							<h2>Julie Puech</h2>
							<br/>
							<p>Julie, l’avez vous vu ? On cherche activement un sac à dos sur pattes ! À peine revenue de randonnée,
							 ce sac est déjà reparti, difficile à suivre ! Vous pouvez lui parler d’exploration, de lieux déserts et
							  isolés, de bâtiments et de villes vides... Mais surtout ne vous avisez pas de lui parler des relations
							   humaines qu’elle a tissé au cours de ses voyages !! <br/>
							</p>

							<div style="text-align: center">	
								<span class="hashtag">#sacàdos</span> 
								<span class="hashtag">#jeparsàlaventure</span>  
								<span class="hashtag">#toutseul</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
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
		</script>
	</body>

</html>