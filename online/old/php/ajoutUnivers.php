<?php
//on se connecte à la base de données:
try
{
	$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
}
catch (Exception $e)
{
die('<br />Erreur : ' . $e->getMessage());
}

	// Ancien :
			//try
			//{
			// On se connecte à MySQL avec l'adresse du serveur, l'identifiant et le mot de passe
			//$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960;charset=utf8', 'dbo708219960', 'dbo708219960');
			//}
			//catch(Exception $e)
			//{
			// En cas d'erreur, on affiche un message et on arrête tout
      //die('Erreur : '.$e->getMessage());
			//}

// On associe la valeur de l'input à la variable
$univers = $_POST['Univers'];
$mysqli = mysqli_connect("db708219960.db.1and1.com", "dbo708219960", "dbo708219960", "db708219960");
$categ1 = 'Jeux vidéos';
$categ2 = 'Séries';
$categ3 = 'Films';
$categ4 = 'Animés';
// On verifie si les données non nulles ne sont pas vides

if(empty($_POST['Univers'])) {
	echo "L'univers est vide.";
} else {
	$Requete = mysqli_query($mysqli,"SELECT * FROM univers WHERE libelleUnivers = '".$univers."'");
	// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
	// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
	if(mysqli_num_rows($Requete) == 1) {
		echo "Cet univers existe deja.";
	} else {
		$bdd->exec('INSERT INTO univers VALUES (\''.$univers.'\')');
		if(isset($_POST['Categ1'])) {
			$bdd->exec('INSERT INTO univers_categorie VALUES (\''.$univers.'\', \''.$categ1.'\')');
		}
		if(isset($_POST['Categ2'])) {
			$bdd->exec('INSERT INTO univers_categorie VALUES (\''.$univers.'\', \''.$categ2.'\')');
		}
		if(isset($_POST['Categ3'])) {
			$bdd->exec('INSERT INTO univers_categorie VALUES (\''.$univers.'\', \''.$categ3.'\')');
		}
		if(isset($_POST['Categ4'])) {
			$bdd->exec('INSERT INTO univers_categorie VALUES (\''.$univers.'\', \''.$categ4.'\')');
		}
	}
}
?>
