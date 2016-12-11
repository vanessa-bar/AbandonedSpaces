<?php

include('init.php');

// Retourne les articles appartenant au thème $theme
function selectArticleByTheme($theme, $bdd) {
	if ($theme == 'Ruines')
		$theme_id = 1;
	else if ($theme == 'Lieux Reculés')
		$theme_id = 2;
	else
		$theme_id = 3;

	$req = 'SELECT * FROM article WHERE article.theme ='.$theme_id;
	$response = $bdd->query($req);
	return $response;
}

function selectArticleById($article_id, $bdd) {
	$req = 'SELECT * FROM article WHERE id_article ='.$article_id.' LIMIT 1';
	$response = $bdd->query($req);
	return $response;
}

function selectArticleByKeyword($keyword, $bdd) {
	$req = 'SELECT * FROM article WHERE titre LIKE "%'.$keyword.'%" OR contenu LIKE "%'.$keyword.'%"';
	$response = $bdd->query($req);
	return $response;
}

// Retourne tous les hashtags d'un article
function getArticleHashtags($id_article, $bdd) {
	$req = 'SELECT hashtag.id_hash, hashtag.nom FROM hashtag 
			INNER JOIN article_has_hashtag 
				ON article_has_hashtag.id_hash = hashtag.id_hash 
			WHERE article_has_hashtag.id_article ='.$id_article;
	$response = $bdd->query($req);
	return $response;
}

// Récupére un timestamp et le formate de la forme "3 Nov. 2016"
function formateDate($date) {
	$month = array("Jan.", "Fév.", "Mars", "Avr.", "Mai", "Juin", "Juil.", "Août", "Sept.", "Oct.", "Nov.", "Déc."); 

	$timestamp = strtotime($date);
	$date_exploded = explode('|', date("d|n|Y", $timestamp));
	return  $date_exploded[0] . ' ' . $month[$date_exploded[1]-1] . ' ' . $date_exploded[2];
}

function selectAllHashtagsByTheme($theme, $bdd) {
	if ($theme == 'Ruines')
		$theme_id = 1;
	else if ($theme == 'Lieux Reculés')
		$theme_id = 2;
	else
		$theme_id = 3;


	$req = 'SELECT DISTINCT hashtag.id_hash, hashtag.nom FROM hashtag 
			INNER JOIN article_has_hashtag
				ON article_has_hashtag.id_hash = hashtag.id_hash 
			INNER JOIN article
				ON article_has_hashtag.id_article = article.id_article
			WHERE article.theme ='.$theme_id;

	//$req = 'SELECT * FROM hashtag';
	$response = $bdd->query($req);
	return $response;
}

?>