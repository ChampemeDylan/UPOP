<?php
try
{
	//on se connecte à la base de données
	// en local
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');
	
	//en online
	//$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
	//$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960','dbo708219960','dbo708219960', $pdo_options);
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
// On associe la valeur de l'input à la variable
//$mysqli = mysqli_connect("localhost", "root", "user", "Upop");
$libelleUnivers = $_POST['libelleUnivers'];


// On verifie si les données non nulles ne sont pas vides

if(empty($_POST['libelleUnivers'])) {
	//echo "L'univers est vide.";
	header("Location: ../administration.php?erreurexist4=bad_exist4");
} else {
		//$Requete = mysqli_query($mysqli,"SELECT * FROM FICHE_ARTICLE WHERE libelleUnivers = '".$libelleUnivers."' AND refArticle = '".$refArticle."' AND libelleArticle = '".$libelleArticle."'");
		$sql = "SELECT * FROM univers WHERE libelleUnivers = :libelleUnivers";
		$stmt = $bdd->prepare($sql);
		
		$stmt->execute(array(
			'libelleUnivers' => $libelleUnivers
		));
		
		// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
		// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
		//if(mysqli_num_rows($Requete) == 1) {
		if($stmt->rowcount() == 0){	
			//echo "Cet univers n'existe pas.";
			header("Location: ../administration.php?erreurexist5=bad_exist5");
		} else {
			// fonctionne directement sur la bdd mais pas sur le site.
			/* $sql = "DELETE FROM COMMANDE_ARTICLE WHERE refArticle IN (SELECT refArticle FROM FICHE_ARTICLE WHERE libelleUnivers = :libelleUnivers)";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			));
			$sql = "DELETE FROM STOCK_ARTICLE WHERE refArticle IN (SELECT refArticle FROM FICHE_ARTICLE WHERE libelleUnivers = :libelleUnivers)";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			)); */
			$sql = "DELETE FROM fiche_articleE WHERE libelleUnivers = :libelleUnivers";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			));
			$sql = "DELETE FROM univers_categorie WHERE libelleUnivers = :libelleUnivers";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			));
			$sql = "DELETE FROM univers WHERE libelleUnivers = :libelleUnivers";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			));
			header("Location: ../administration.php?successsupuniv=good_supuniv");
		}
	}
?>