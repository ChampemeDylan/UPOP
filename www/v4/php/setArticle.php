<?php
	// on verifie si on session est deja ouverte et si non on en ouvre une
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(isset($_GET['refArticle'])){
	$refArticle = $_GET['refArticle'];
} else {
$refArticle = $_SESSION['refArticle'];
$refArticle2 = $_SESSION['refArticle'];
}
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

$sql = "SELECT * FROM fiche_article WHERE refArticle = :refArticle";
$stmt = $bdd->prepare($sql);

$stmt->execute(array(
    'refArticle' => $refArticle
));

// si il y a un résultat, mysqli_num_rows() nous donnera alors 1
// si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
//if(mysqli_num_rows($Requete) == 0) {
if($stmt->rowCount() == 0){
    echo "Cette reference n'existe pas.";
}
else {
    // On récupère le contenu de la table qui correspond a la reference
    //$reponse = $bdd->query('SELECT libelleArticle, descriptifArticle, prixArticle, libelleUnivers FROM FICHE_ARTICLE WHERE refArticle = "'.$refArticle.'"');
    $row=$stmt->fetch();
    // mise a jour
    $_SESSION['refArticle'] = $row['refArticle'];
    $_SESSION['libelleArticle'] = $row['libelleArticle'];
    $_SESSION['descriptifArticle'] = $row['descriptifArticle'];
    $_SESSION['prixArticle'] = $row['prixArticle'];
    $_SESSION['libelleUnivers'] = $row['libelleUnivers'];
}
?>