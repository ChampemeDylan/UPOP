<?php
try
{
	//on se connecte à la base de données:
	try
	{
		$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
	}
	catch (Exception $e)
	{
	die('<br />Erreur : ' . $e->getMessage());
	}

	// Ancien (On se connecte à MySQL avec l'adresse du serveur, l'identifiant et le mot de passe)
		//$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'user');
		//}
		//catch(Exception $e)
		//{
		// En cas d'erreur, on affiche un message et on arrête tout
    //die('Erreur : '.$e->getMessage());
		//}

$mysqli = mysqli_connect("db708219960.db.1and1.com;dbname=db708219960", "dbo708219960", "dbo708219960", "db708219960");
$reference = $_POST['Reference'];

if(empty($_POST['Reference'])) {
	echo "La reference est vide.";
} else {
	$Requete = mysqli_query($mysqli,"SELECT * FROM univers WHERE refArticle = '".$reference."'");
				// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
				// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
				if(mysqli_num_rows($Requete) == 0) {
					echo "Cette reference n'existe pas.";
				} else {
					// On récupère le contenu de la table qui correspond a la reference
					$reponse = $bdd->query('SELECT libelleArticle, descriptionArticle, prixArticle, libelleUnivers FROM fiche_article WHERE refArticle = "'.$reference.'"');
				}
}
