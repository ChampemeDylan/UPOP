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

// fonction de hashage du password
function hashPassword($password) {
    $hash = 'sha512'; // type de hash
    $salt = 'Upop Rules'; // grain de sel pour le cryptage
    return hash_hmac($hash, $password, $salt); // retourne le password hashé
}

$passwordUserCrypted = hashPassword($passwordUser); // mot de passe hashé

try
{

	//on se connecte à la base de données
	// en local
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');
	
	//en online
	//$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
	//$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960','dbo708219960','dbo708219960', $pdo_options);

	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// test de login présent dans la base de donnée
	$sql = "SELECT * FROM fiche_user WHERE loginUser=:loginUser";
	$stmt = $bdd->prepare($sql);

	$stmt->execute(array(
		'loginUser' => $loginUser
	));
	$row=$stmt->fetch();

	// si rowCount() retourne 0 c'est qu'il a trouvé aucun résultat
	if($stmt->rowCount() == 1) {
		header("Location: ../index.php?loginexistant=error_login");
	}
	else {
			
		// On insère des données dans notre table

		if ($passwordUser2===$passwordUser) //comparaison des 2 passwords rentrés
		{
			// on rentre les données du nouvel utilisateur dans la base de données
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

//Récupération des vriables du formulaire :
				$mailUser  = $_POST['mailUser'];
				$loginUser = $_POST['loginUser'];
				 
// Mail :
				$objet = 	'Confirmation de votre inscription UPop';
				$contenu =  '<html>
								<head>
									<div>
										<span>
											<img src="http://upop.champemedylan.fr/images/iconeupop.png" style="width: 140px;"></img>
										</span>
									</div>
									
									<hr>
								</head>
									<body>
									    <p style="font-size: 22px;">	Bonjour '.$prenomUser.',
											vous venez de vous inscrire sur Upop et nous vous en remercions.
											Merci de votre confiance et à bientôt sur Upop.
										</p><br>
										<p style="font-size: 22px;">
											Cordialement l\'équipe U\'pop
										</p>
											<hr>
										<p style="font-size: 12px;">
											© 2017 Copyright: U\'Pop -- Ce site est un projet étudiant et non un site de vente
										</p>

									</body>
							</html>';

//Configuration :
							
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'From:'.$loginUser.' <'.$mailUser.'>' . "\r\n" .
							'Reply-To:'.$mailUser. "\r\n" .
							'Content-Type: text/html; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
							'Content-Disposition: inline'. "\r\n" .
							'Content-Transfer-Encoding: 8bit'." \r\n" .
							'X-Mailer:PHP/'.phpversion();
                         
//Envoi du mail :

			mail($mailUser, $objet, $contenu, $headers);

			header("Location: ../index.php?validinscription=validee"); // Redirection du navigateur
		}
		else
		{
			header("Location: ../index.php?erreurpassword=error_password");
		}
	}
}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}

$bdd = null;
?>



