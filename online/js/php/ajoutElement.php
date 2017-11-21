<?php
try
{
	// On se connecte à MySQL avec l'adresse du serveur, l'identifiant et le mot de passe
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'user');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
// On associe la valeur de l'input à la variable
$mysqli = mysqli_connect("localhost", "root", "user", "Upop");
$reference = $_POST['Reference'];
$libelle = $_POST['Libelle'];
$description = $_POST['Description'];
$prix = $_POST['Prix'];
$univers = $_POST['Univers'];

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
					$bdd->exec('INSERT INTO FICHE_ARTICLE VALUES (\''.$reference.'\', \''.$libelle.'\', \''.$description.'\', '.$prix.', \''.$univers.'\')');
				}
			}
		}
	}
}

?>