<?php
//session_start();

$loginUser = $_SESSION['loginUser'];
$nomUser = htmlentities($_POST['nomUser'], ENT_QUOTES, "ISO-8859-1");
$prenomUser = htmlentities($_POST['prenomUser'], ENT_QUOTES, "ISO-8859-1");
$genreUser = htmlentities($_POST['genreUser'], ENT_QUOTES, "ISO-8859-1");
$dateNaissanceUser = htmlentities($_POST['dateNaissanceUser'], ENT_QUOTES, "ISO-8859-1");
$adresseUser = htmlentities($_POST['adresseUser'], ENT_QUOTES, "ISO-8859-1");
$cpUser = htmlentities($_POST['cpUser'], ENT_QUOTES, "ISO-8859-1");
$villeUser = htmlentities($_POST['villeUser'], ENT_QUOTES, "ISO-8859-1");
$mailUser = htmlentities($_POST['mailUser'], ENT_QUOTES, "ISO-8859-1");

try
{
	// connexion à MySQL avec l'adresse du serveur, l'identifiant et le mot de passe
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// On update des données dans notre table
	$sql = "UPDATE fiche_user SET nomUser= :nomUser, prenomUser= :prenomUser, genreUser= :genreUser, dateNaissanceUser= :dateNaissanceUser, adresseUser= :adresseUser, cpUser= :cpUser, villeUser= :villeUser, mailUser= :mailUser WHERE loginUser= :loginUser";

    $stmt = $bdd->prepare($sql);

	$stmt->execute(array(
		'nomUser' => $nomUser,
		'prenomUser' => $prenomUser,
		'genreUser' => $genreUser,
		'dateNaissanceUser' => $dateNaissanceUser,
		'adresseUser' => $adresseUser,
		'cpUser' => $cpUser,
		'villeUser' => $villeUser,
		'mailUser' => $mailUser,
		'loginUser' => $loginUser
	));

	//mise à jour des variables de session
	$_SESSION['nomUser'] = $nomUser;
	$_SESSION['prenomUser'] = $prenomUser;
	$_SESSION['genreUser'] = $genreUser;
	$_SESSION['dateNaissanceUser'] = $dateNaissanceUser;
	$_SESSION['adresseUser'] = $adresseUser;
	$_SESSION['cpUser'] = $cpUser;
	$_SESSION['villeUser'] = $villeUser;
	$_SESSION['mailUser'] = $mailUser;
	// echo a message to say the UPDATE succeeded
	//echo $stmt->rowCount() . " records UPDATED successfully";

}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}

$bdd = null;
?>