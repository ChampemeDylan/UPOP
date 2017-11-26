<?php
session_start();
	 //on se connecte à la base de données:
try
{
    //on se connecte à la base de données
    // en local
    $bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

    //en online
    //$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
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
    $sql = "UPDATE commande_article SET quantiteArticle=:quantiteArticle WHERE numeroCommande=:numeroCommande AND refArticle=:refArticle";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(
        'numeroCommande' => $_SESSION['numCommande'],
        'refArticle' => $_GET['refArticle'],
        'quantiteArticle' => $_GET['qteArticle']
    ));

    $sql = "SELECT stockArticle FROM stock_article WHERE refArticle=:refArticle";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(
        'refArticle' => $_GET['refArticle']
    ));

    $row=$stmt->fetch();
    $stockArticle = $row[0];
    $stockArticleUpdate = $stockArticle - $_GET['qteArticle'];

    $sql = "UPDATE stock_article SET stockArticle=:stockArticle WHERE refArticle=:refArticle";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(
        'refArticle' => $_GET['refArticle'],
        'stockArticle' => $stockArticleUpdate
    ));
}
?>