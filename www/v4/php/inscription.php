<?php
try
{
	// On se connecte à MySQL avec l'adresse du serveur, l'identifiant et le mot de passe
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
// On associe la valeur de l'input name='libelleUnivers' à la variable nom
$loginUser = $_POST['loginUser'];
$passwordUser = $_POST['passwordUser'];
$passwordUser2 = $_POST['passwordUser2'];
$nomUser = $_POST['nomUser'];
$prenomUser = $_POST['prenomUser'];
$genreUser = $_POST['genreUser'];
$dateNaissanceUser = $_POST['dateNaissanceUser'];
$adresseUser = $_POST['adresseUser'];
$cpUser = $_POST['cpUser'];
$villeUser = $_POST['villeUser'];
$mailUser = $_POST['mailUser'];
// On insère des données dans notre table
if ($passwordUser2===$passwordUser)
	{
	$bdd->exec('INSERT INTO fiche_user VALUES (\''.$loginUser.'\',\''.$nomUser.'\',\''.$prenomUser.'\',\''.$genreUser.'\',\''.$dateNaissanceUser.'\',\''.$passwordUser.'\',\''.$adresseUser.'\',\''.$cpUser.'\',\''.$villeUser.'\',\''.$mailUser.'\',0)');
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Attention les 2 mots de passe ne sont pas identiques")';
		echo '</script>';
		header("Location: ../index.html"); // Redirection du navigateur
		exit;
	}
?>
<!-- FERMETURE DE LA BALISE PHP -->
<!-- FIN FICHIER updateunivers.php -->

