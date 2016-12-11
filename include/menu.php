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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	function search() {
		$(".search-form-menu").show();
		$(".quitSearch").show();
		$(".search-hide").hide();
	}

	function quitSearch() {
		$(".search-form-menu").hide();
		$(".quitSearch").hide();
		$(".search-hide").show();
	}

</script>
