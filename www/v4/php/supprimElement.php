<?php
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
// On associe la valeur de l'input à la variable
//$mysqli = mysqli_connect("localhost", "root", "user", "Upop");
$refArticle = $_POST['refArticle'];
$libelleArticle = $_POST['libelleArticle'];
$libelleUnivers = $_POST['libelleUnivers'];


// On verifie si les données non nulles ne sont pas vides

if(empty($_POST['refArticle'])) {
	//echo "La reference est vide.";
	header("Location: ../administration.php?erreurref2=bad_ref2");
} else {
	if(empty($_POST['libelleArticle'])) {
		//echo "Le libelle est vide.";
		header("Location: ../administration.php?erreurlibelle3=bad_lib3");
	} else {
		//$Requete = mysqli_query($mysqli,"SELECT * FROM FICHE_ARTICLE WHERE libelleUnivers = '".$libelleUnivers."' AND refArticle = '".$refArticle."' AND libelleArticle = '".$libelleArticle."'");
		$sql = "SELECT * FROM FICHE_ARTICLE WHERE libelleUnivers = :libelleUnivers AND refArticle = :refArticle AND libelleArticle = :libelleArticle";
		$stmt = $bdd->prepare($sql);
		
		$stmt->execute(array(
			'libelleUnivers' => $libelleUnivers,
			'refArticle' => $refArticle,
			'libelleArticle' => $libelleArticle
		));
		
		// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
		// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
		//if(mysqli_num_rows($Requete) == 1) {
		if($stmt->rowcount() == 0){	
			//echo "Cet element n'existe pas.";
			header("Location: ../administration.php?erreurexist3=bad_exist3");
		} else {
			//$bdd->exec('DELETE FROM FICHE_ARTICLE WHERE refArticle = "'.$refArticle.'"');
			$sql = "DELETE FROM FICHE_ARTICLE WHERE refArticle = :refArticle";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'refArticle' => $refArticle
			));
			header("Location: ../administration.php?successsupelem=good_supelem");
		}
	}
}


?>