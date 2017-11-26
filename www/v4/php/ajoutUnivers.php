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
$libelleUnivers = $_POST['libelleUnivers'];
//$mysqli = mysqli_connect("localhost", "root", "user", "Upop");
$categ1 = 'Jeu Vidéo';
$categ2 = 'Série';
$categ3 = 'Film';
$categ4 = 'Dessin Animé';

// On verifie si les données non nulles ne sont pas vides

if(empty($_POST['libelleUnivers'])) {
	//echo "L'univers est vide.";
	header("Location: ../administration.php?erreurlibelle2=bad_lib2");
} else {
	//$Requete = mysqli_query($mysqli,"SELECT * FROM UNIVERS WHERE libelleUnivers = '".$libelleUnivers."'");
	$sql = "SELECT * FROM UNIVERS WHERE libelleUnivers = :libelleUnivers";
	$stmt = $bdd->prepare($sql);
	
	$stmt->execute(array( 
		'libelleUnivers' => $libelleUnivers
	));
	
	// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
	// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
	//if(mysqli_num_rows($Requete) == 1) {
	if($stmt->rowCount() == 1) {	
		//echo "Cet univers existe deja.";
		header("Location: ../administration.php?erreurexist2=bad_exist2");
	} else {
		//$bdd->exec('INSERT INTO UNIVERS VALUES (\''.$libelleUnivers.'\')');
		$sql = "INSERT INTO UNIVERS VALUES (:libelleUnivers)";
		$stmt = $bdd->prepare($sql);
		$stmt->execute(array(
			'libelleUnivers' => $libelleUnivers
		));
		if(isset($_POST['categ1'])) {
			//$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$libelleUnivers.'\', \''.$categ1.'\')');
			$sql = "INSERT INTO UNIVERS_CATEGORIE VALUES (:libelleUnivers, :categ1)";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers,
				'categ1' => $categ1
			));
		}
		if(isset($_POST['categ2'])) {
			//$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$libelleUnivers.'\', \''.$categ2.'\')');
			$sql = "INSERT INTO UNIVERS_CATEGORIE VALUES (:libelleUnivers, :categ2)";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers,
				'categ2' => $categ2
			));
		}
		if(isset($_POST['categ3'])) {
			//$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$libelleUnivers.'\', \''.$categ3.'\')');
			$sql = "INSERT INTO UNIVERS_CATEGORIE VALUES (:libelleUnivers, :categ3)";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers,
				'categ3' => $categ3
			));
		}
		if(isset($_POST['categ4'])) {
			//$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$libelleUnivers.'\', \''.$categ4.'\')'); 
			$sql = "INSERT INTO UNIVERS_CATEGORIE VALUES (:libelleUnivers, :categ4)";
			$stmt = $bdd->prepare($sql);
			$stmt->execute(array(
				'libelleUnivers' => $libelleUnivers,
				'categ4' => $categ4
			));
		}
		header("Location: ../administration.php?successajoutuniv");
	}
}
?>