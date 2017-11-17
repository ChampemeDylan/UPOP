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
$univers = $_POST['Univers'];
$mysqli = mysqli_connect("localhost", "root", "user", "Upop");
$categ1 = 'Jeux vidéos';
$categ2 = 'Séries';
$categ3 = 'Films';
$categ4 = 'Animés';
// On verifie si les données non nulles ne sont pas vides

if(empty($_POST['Univers'])) {
	echo "L'univers est vide.";
} else {
	$Requete = mysqli_query($mysqli,"SELECT * FROM UNIVERS WHERE libelleUnivers = '".$univers."'");
	// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
	// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
	if(mysqli_num_rows($Requete) == 1) {
		echo "Cet univers existe deja.";
	} else {
		$bdd->exec('INSERT INTO UNIVERS VALUES (\''.$univers.'\')');
		if(isset($_POST['Categ1'])) {
			$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$univers.'\', \''.$categ1.'\')');
		}
		if(isset($_POST['Categ2'])) {
			$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$univers.'\', \''.$categ2.'\')');
		}
		if(isset($_POST['Categ3'])) {
			$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$univers.'\', \''.$categ3.'\')');
		}
		if(isset($_POST['Categ4'])) {
			$bdd->exec('INSERT INTO UNIVERS_CATEGORIE VALUES (\''.$univers.'\', \''.$categ4.'\')'); 
		}
	}
}
?>