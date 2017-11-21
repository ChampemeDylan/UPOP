<?php

// fonction de hashage du password
function hashPassword($password) {
    $hash = 'sha512'; // type de hash
    $salt = 'Upop Rules'; // grain de sel pour le cryptage
    return hash_hmac($hash, $password, $salt); // retourne le password hashé
}

// On associe la valeur de l'input à la variable
$loginUser = $_SESSION['loginUser'];
$nomUser = htmlentities($_POST['nomUser'], ENT_QUOTES, "ISO-8859-1");
$prenomUser = htmlentities($_POST['prenomUser'], ENT_QUOTES, "ISO-8859-1");
$genreUser = htmlentities($_POST['genreUser'], ENT_QUOTES, "ISO-8859-1");
$dateNaissanceUser = htmlentities($_POST['dateNaissanceUser'], ENT_QUOTES, "ISO-8859-1");
$adresseUser = htmlentities($_POST['adresseUser'], ENT_QUOTES, "ISO-8859-1");
$cpUser = htmlentities($_POST['cpUser'], ENT_QUOTES, "ISO-8859-1");
$villeUser = htmlentities($_POST['villeUser'], ENT_QUOTES, "ISO-8859-1");
$mailUser = htmlentities($_POST['mailUser'], ENT_QUOTES, "ISO-8859-1");
$passwordUser = htmlentities($_POST['passwordUser'], ENT_QUOTES, "ISO-8859-1");
$passwordUser2 = htmlentities($_POST['passwordUser2'], ENT_QUOTES, "ISO-8859-1");

try
{
	//on se connecte à la base de données
	// en local
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

	//en online
	//$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// Test confirmation mot de passe
	
	if(empty($_POST['passwordUser'])) {
		$passwordUserCrypted = $_SESSION['passwordUser'];
		$passwordEtat = 1;
	}
	else {
		if ($passwordUser2===$passwordUser){
			$passwordUserCrypted = hashPassword($passwordUser); // mot de passe haché
			$passwordEtat = 1;
		}
		else {
			$passwordEtat = 0;
		}
	}
	if ($passwordEtat == 1){
		// On update des données dans notre table
		$sql = "UPDATE fiche_user SET nomUser= :nomUser, prenomUser= :prenomUser, genreUser= :genreUser, dateNaissanceUser= :dateNaissanceUser, adresseUser= :adresseUser, cpUser= :cpUser, villeUser= :villeUser, mailUser= :mailUser, passwordUser= :passwordUser WHERE loginUser= :loginUser";

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
			'passwordUser' => $passwordUserCrypted,
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
		$_SESSION['passwordUser'] = $passwordUserCrypted;

	}
}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}

$bdd = null;
?>