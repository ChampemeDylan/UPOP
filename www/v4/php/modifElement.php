<?php

$loginUser = $_SESSION['loginUser'];
$refArticle = htmlentities($_POST['refArticle'], ENT_QUOTES, "ISO-8859-1");
$libelle = htmlentities($_POST['libelleArticle'], ENT_QUOTES, "ISO-8859-1");
$description = htmlentities($_POST['descriptifArticle'], ENT_QUOTES, "ISO-8859-1");
$prix = htmlentities($_POST['prixArticle'], ENT_QUOTES, "ISO-8859-1");
$univers = htmlentities($_POST['libelleUnivers'], ENT_QUOTES, "ISO-8859-1");

try
{
	//on se connecte à la base de données
	// en local
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');
	
	//en online
	//$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$mysqli = mysqli_connect("localhost", "root", "user", "Upop");
$refArticle = $_POST['refArticle'];

if(empty($_POST['refArticle'])) {
	echo "La reference est vide.";
} else {
	$Requete = mysqli_query($mysqli,"SELECT * FROM UNIVERS WHERE refArticle = '".$refArticle."'");
		// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
		// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
		if(mysqli_num_rows($Requete) == 0) {
			echo "Cette reference n'existe pas.";
		} else {
			// On récupère le contenu de la table qui correspond a la reference
			$reponse = $bdd->query('SELECT libelleArticle, descriptifArticle, prixArticle, libelleUnivers FROM FICHE_ARTICLE WHERE refArticle = "'.$refArticle.'"');
		}
		
		// mise a jour
		$SESSION['refArticle'] = $refArticle;
		$SESSION['libelleArticle'] = $libelle;
		$SESSION['descriptifArticle'] = $description;
		$SESSION['prixArticle'] = $prix;
		$SESSION['libelleUnivers'] = $univers;
}