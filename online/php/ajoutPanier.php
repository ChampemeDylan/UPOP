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
    header("Location: ../figurines.php?erreurbdd=error_bdd");
}
else
{
    // VERIFICATION DE LA COMMANDE EN COURS
    $sql = "SELECT numeroCommande FROM commande WHERE loginUser=:loginUser AND dateCommande=:dateCommande AND etatCommande='En cours'";
    $stmt = $bdd->prepare($sql);
    $dateDuJour = date("Y-m-d");
    $stmt->execute(array(
        'loginUser' => $_SESSION['loginUser'],
        'dateCommande' => $dateDuJour
    ));
    $row=$stmt->fetch();

    // SI PAS DE COMMANDE EN COURS...
    if($stmt->rowCount() == 0) {

    	// CREATION DE LA COMMANDE
    	$sql = "INSERT INTO commande SET loginUser=:loginUser,dateCommande=:dateCommande,etatCommande='En cours'";
    	$stmt = $bdd->prepare($sql);
    	$stmt->execute(array(
        	'loginUser' => $_SESSION['loginUser'],
        	'dateCommande' => $dateDuJour
   		));

    	// RECUPERATION DU NUMERO DE COMMANDE PRECEDEMMENT CREE
    	$sql = "SELECT numeroCommande FROM commande WHERE loginUser=:loginUser AND dateCommande=:dateCommande AND etatCommande='En cours'";
    	$stmt = $bdd->prepare($sql);
    	$stmt->execute(array(
        	'loginUser' => $_SESSION['loginUser'],
        	'dateCommande' => $dateDuJour
   		));
    	$row=$stmt->fetch();

    	// INSERTION DE L'ARTICLE DANS LA COMMANDE EN COURS
    	$sql = "INSERT INTO commande_article SET numeroCommande=:numeroCommande,refArticle=:refArticle,quantiteArticle='1'";
    	$stmt = $bdd->prepare($sql);
    	$stmt->execute(array(
        	'refArticle' => $_GET['refArticle'],
        	'numeroCommande' => $row['numeroCommande']
   		));
  		echo 'Votre article a été ajouté au panier.';
    }
    // ... SINON LA COMMANDE EXISTE
    else
    {
    	$presenceArticle = '';
        // VERIFICATION DES ARTICLES DANS LA COMMANDE EN COURS
    	$sql = "SELECT refArticle FROM commande_article WHERE numeroCommande=:numeroCommande";
    	$stmt = $bdd->prepare($sql);
    	$stmt->execute(array(
        	'numeroCommande' => $row['numeroCommande']
   		));
   		while ($donnees=$stmt->fetch()){
   			if ($donnees['refArticle'] == $_GET['refArticle']){
   				$presenceArticle = 1;
   			}
   		}

        // SI L'ARTICLE EXISTE PAS... ON INSERE DANS LA COMMANDE
   		if ($presenceArticle == 0){
   			$sql = "INSERT INTO commande_article SET numeroCommande=:numeroCommande,refArticle=:refArticle,quantiteArticle='1'";
    		$stmt = $bdd->prepare($sql);
    		$stmt->execute(array(
        		'refArticle' => $_GET['refArticle'],
        		'numeroCommande' => $row['numeroCommande']
   			));
			echo 'Votre article a été ajouté au panier.';
   		}
        // SINON ON
   		else
   		{
   			echo 'L\'article est déjà présent dans le panier';
   		}
    }
}
?>
