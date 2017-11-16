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
// On associe la valeur de l'input à la variable
$reference = $_POST['Reference'];
$lebelle = $_POST['Libelle'];
$description = $_POST['Description'];
$prix = $_POST['Prix'];
$univers = $_POST['Univers'];

$categ1 = $_POST['Categ1'];
$categ1 = $_POST['Categ2'];
$categ1 = $_POST['Categ3'];
$categ1 = $_POST['Categ4'];

// On verifie si les données non nulles ne sont pas vides

if(empty($_POST['Reference'])) {
	echo "La reference est vide.";
} else {
	if(empty($_POST['Libelle'])) {
		echo "Le libelle est vide.";
	} else {
		if(empty($_POST['Description'])) {
			echo "La description est vide.";
		} else {
			if(empty($_POST['Prix'])) {
				echo "Le prix est vide.";
			} else {
				$Requete = mysqli_query($mysqli,"SELECT * FROM UNIVERS WHERE libelleUnivers = '".$univers."'");
				// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
				// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
				if(mysqli_num_rows($Requete) == 0) {
					echo "Cet univers n'existe pas.";
				} else {
					$bdd->exec('INSERT INTO UNIVERS VALUES (\''.$reference.'\', \''$libelle'\', \''$description'\', \''$prix'\', \''$univers'\')');
				}
				
	/* if(isset($POST['Categ1']))
		$bdd->exec('INSERT INTO UNIVER_CATEGORIE VALUES (\''.$univers.'\', \''.$categ1.'\')');
	if(isset($POST['Categ2']))
		$bdd->exec('INSERT INTO UNIVER_CATEGORIE VALUES (\''.$univers.'\', \''.$categ2.'\')');
	if(isset($POST['Categ3']))
		$bdd->exec('INSERT INTO UNIVER_CATEGORIE VALUES (\''.$univers.'\', \''.$categ3.'\')');
	if(isset($POST['Categ4']))
		$bdd->exec('INSERT INTO UNIVER_CATEGORIE VALUES (\''.$univers.'\', \''.$categ4.'\')'); */

?>