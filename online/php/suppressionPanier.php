<?php
session_start();
	 //on se connecte à la base de données:
try
{
    //on se connecte à la base de données
    // en local
    //$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

    //en online
    $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
    $bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960','dbo708219960','dbo708219960', $pdo_options);
}
catch (Exception $e)
{
die('<br />Erreur : ' . $e->getMessage());
}

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//on vérifie que la connexion s'effectue correctement
if(!$bdd){
    header("Location: ../panier.php?erreurbdd=error_bdd");
}
else
{
    $sql = "DELETE FROM commande_article WHERE numeroCommande=:numeroCommande AND refArticle=:refArticle";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(
        'numeroCommande' => $_SESSION['numCommande'],
        'refArticle' => $_GET['refArticle']
    ));
}
?>
