<?php
try
{
	//on se connecte à la base de données
	// en local
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', '');
	
	//en online
	//$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
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
		$sql = "SELECT * FROM UNIVERS WHERE libelleUnivers = :libelleUnivers";
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
			//$bdd->exec('DELETE FROM FICHE_ARTICLE WHERE refArticle = "'.$refArticle.'"');
			$sql = "DELETE FROM UNIVERS WHERE libelleUnivers = :libelleUnivers";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			));
			$sql = "DELETE FROM UNIVERS_CATEGORIE WHERE libelleUnivers = :libelleUnivers";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			));
			$sql = "DELETE FROM FICHE_ARTICLE WHERE libelleUnivers = :libelleUnivers";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers
			));
			echo "Univers supprimer";
		}
	}


?>