<?php


// On associe la valeur de l'input à la variable
$loginUser = htmlentities($_POST['loginUser'], ENT_QUOTES, "ISO-8859-1");
$passwordUser = htmlentities($_POST['passwordUser'], ENT_QUOTES, "ISO-8859-1");
$passwordUser2 = htmlentities($_POST['passwordUser2'], ENT_QUOTES, "ISO-8859-1");
$nomUser = htmlentities($_POST['nomUser'], ENT_QUOTES, "ISO-8859-1");
$prenomUser = htmlentities($_POST['prenomUser'], ENT_QUOTES, "ISO-8859-1");
$genreUser = htmlentities($_POST['genreUser'], ENT_QUOTES, "ISO-8859-1");
$dateNaissanceUser = htmlentities($_POST['dateNaissanceUser'], ENT_QUOTES, "ISO-8859-1");
$adresseUser = htmlentities($_POST['adresseUser'], ENT_QUOTES, "ISO-8859-1");
$cpUser = htmlentities($_POST['cpUser'], ENT_QUOTES, "ISO-8859-1");
$villeUser = htmlentities($_POST['villeUser'], ENT_QUOTES, "ISO-8859-1");
$mailUser = htmlentities($_POST['mailUser'], ENT_QUOTES, "ISO-8859-1");

function hashPassword($password) {
	$hash = 'sha512';
	$salt = 'Upop Rules';
	return hash_hmac($hash, $password, $salt);
}

$passwordUserCrypted = hashPassword($passwordUser); // mot de passe haché

try
{
	// On se connecte à MySQL avec l'adresse du serveur, l'identifiant et le mot de passe
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// On insère des données dans notre table
if ($passwordUser2===$passwordUser)
	{
		$sql="INSERT INTO fiche_user VALUES (:loginUser, :nomUser, :prenomUser, :genreUser, :dateNaissanceUser, :passwordUser, :adresseUser, :cpUser, :villeUser, :mailUser, 0)";
		
		$stmt = $bdd->prepare($sql);
		
		$stmt->execute(array(
			'loginUser' => $loginUser,
			'nomUser' => $nomUser,
			'prenomUser' => $prenomUser,
			'genreUser' => $genreUser,
			'dateNaissanceUser' => $dateNaissanceUser,
			'passwordUser' => $passwordUserCrypted,
			'adresseUser' => $adresseUser,
			'cpUser' => $cpUser,
			'villeUser' => $villeUser,
			'mailUser' => $mailUser			
		));

		header("Location: ../index.html"); // Redirection du navigateur
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Attention les 2 mots de passe ne sont pas identiques")';
		echo '</script>';
		exit;
	}
}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}

$bdd = null;
?>
