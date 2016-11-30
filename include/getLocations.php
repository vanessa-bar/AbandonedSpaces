<?php
	include('init.php');

	$req = 'SELECT * FROM article';
	$response = $bdd->query($req);
	$donnees = $response->fetch();
	$response->closeCursor(); 
	$c = "coucou";
//http://memo-web.fr/categorie-ajax-2.php
	echo $donnees;

	  header('Content-type: application/json');   
?>
   {
      "c": "<?php echo $c;?>"
   }
<?php       
?>