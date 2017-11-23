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
$descriptifArticle = $_POST['descriptifArticle'];
$prixArticle = $_POST['prixArticle'];
$libelleUnivers = $_POST['libelleUnivers'];

// On verifie si les données non nulles ne sont pas vides

if(empty($_POST['refArticle'])) {
	//echo "La reference est vide.";
	header("Location: ../administration.php?erreurref=bad_ref");
} else {
	if(empty($_POST['libelleArticle'])) {
		//echo "Le libelle est vide.";
		header("Location: ../administration.php?erreurlibelle=bad_lib");
	} else {
		if(empty($_POST['descriptifArticle'])) {
			//echo "La description est vide.";
			header("Location: ../administration.php?erreurarticle=bad_article");
		} else {
			if(empty($_POST['prixArticle'])) {
				//echo "Le prix est vide.";
				header("Location: ../administration.php?erreurprix=bad_prix");
			} else {
				//$Requete = mysqli_query($mysqli,"SELECT * FROM UNIVERS WHERE libelleUnivers = '".$libelleUnivers."'");
				$sql = "SELECT * FROM UNIVERS WHERE libelleUnivers = :libelleUnivers";
				$stmt = $bdd->prepare($sql);
				
				$stmt->execute(array(
					'libelleUnivers' => $libelleUnivers
				));
				
				// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
				// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
				//if(mysqli_num_rows($Requete) == 0) {
				if($stmt->rowcount() == 0){
					//echo "Cet univers n'existe pas.";
					header("Location: ../administration.php?erreurexist=bad_exist");
				} else {
					//$bdd->exec('INSERT INTO FICHE_ARTICLE VALUES (\''.$refArticle.'\', \''.$libelleArticle.'\', \''.$descriptifArticle.'\', '.$prixArticle.', \''.$libelleUnivers.'\')');
					$sql = "INSERT INTO FICHE_ARTICLE VALUES (:refArticle, :libelleArticle, :descriptifArticle, :prixArticle, :libelleUnivers)";
					$stmt = $bdd->prepare($sql);
					$stmt->execute(array(
						'refArticle' => $refArticle,
						'libelleArticle' => $libelleArticle,
						'descriptifArticle' => $descriptifArticle,
						'prixArticle' => $prixArticle,
						'libelleUnivers' => $libelleUnivers
					));
				}
			}
		}
	}
}

?>