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
//$loginUser = $_SESSION['loginUser'];
//$passwordUser = $_SESSION['passwordUser'];
//$passwordUser2 = $_POST['passwordUser2'];
$nomUser = $_POST['nomUser'];
$prenomUser = $_POST['prenomUser'];
$genreUser = $_POST['genreUser'];
$dateNaissanceUser = $_POST['dateNaissanceUser'];
$adresseUser = $_POST['adresseUser'];
$cpUser = $_POST['cpUser'];
$villeUser = $_POST['villeUser'];
$mailUser = $_POST['mailUser'];

// On update des données dans notre table
	$bdd->exec("UPDATE fiche_user SET nomUser=\''.$nomUser.'\', prenomUser=\''.$prenomUser.'\', genreUser=\''.$genreUser.'\', dateNaissanceUser=\''.$dateNaissanceUser.'\', adresseUser=\''.$adresseUser.'\', cpUser=\''.$cpUser.'\', villeUser=\''.$villeUser.'\', mailUser=\''.$mailUser.'\' WHERE loginUser='simon' ");

?>
<!-- FERMETURE DE LA BALISE PHP -->
<!-- FIN FICHIER updateunivers.php -->

