<?php 
session_start();

require "./php/verifConnexion.php";
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset='utf-8'>
	<link rel="icon" type="image/png" href="Images\iconeupop.png"/>

<!-- feuilles de style -->
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/main.css"/>
    <link rel="stylesheet" href="./css/figurines.css">

<!-- fichiers javascript -->
    <script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="./js/bootstrap.min.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>U POP</title>
</head>

<body>

<!-- barre de navigation -->
	<nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container-fluid">
            <div class="nav-header">
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" name="button">
                    <img class="imgButton" src="images/iconeupop.png">
                </button>
            </div>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav">
                    <li><img class="logoBar" src="images/iconeupop.png"></li>
                    <li><a href="accueil.php" ><img class="imgButton" src="images/home.png"></a></li>
                    <li><a href="figurines.php"><img class="imgButton" src="images/figurine.png"></a></li>
                    <!-- <li><h2 id="titre">Accueil</h2></li> -->
                    <li><a href="contact.php"><img class="imgButton" src="images/contact.png"></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                	<li><a href="compte.php"><img class="imgButton" src="images/compte.png"><?php echo ' '.$_SESSION['loginUser'] ?></a></li>
                	<li><a href="panier.php"><img class="imgButton" src="images/panier.png"></a></li>
                    <li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- fin barre de navigation -->

<!-- contenu de la page -->
	<div class="container">
<!-- choix de la catégorie -->
		<div class="row text-center">
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href="" class="filtre"><img class="imgButton2" src="images/jeux.png"></br><b>Jeux Vidéos</b></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href=""><img class="imgButton2" src="images/serie.png"></br><b>Séries</b></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL  ( href ) -->
				<a href=""><img class="imgButton2" src="images/film.png"></br><b>Films</b></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href=""><img class="imgButton2" src="images/anime.png"></br><b>Animés</b></a>
			</div>
		</div>
		<div class="col-xs-12"></div><br />
<!-- fin de choix de la catégorie -->
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
			// On récupère tout le contenu de la table
			$reponse = $bdd->query('select fiche_article.refArticle,descriptifArticle,libelleArticle,fiche_article.libelleUnivers,stockArticle,prixArticle,libelleCategorie from fiche_article,univers_categorie,stock_article where fiche_article.libelleUnivers = univers_categorie.libelleUnivers and fiche_article.refArticle = stock_article.refArticle order by libelleCategorie;');
			// On affiche chaque entrée une à une qu'on affiche
			while ($donnees = $reponse->fetch())
			{
		?>
<!-- Modèle d'article -->
<!-- /!\ A saupoudrer de requêtes SQL-->
		
		<div class="row panel panel-default article <?php echo $donnees['libelleCategorie']?>">
		<!-- Image de l'article -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<img class="imageArticle" src=<?php echo 'images/'.$donnees['refArticle'].'.png' ?>>
			</div>
	<!-- Titre et description de la figurine -->
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<p><b><?php echo $donnees['libelleArticle']; ?> (<?php echo $donnees['libelleUnivers']; ?>)</b></p>
				<div id="describe">
					<?php echo $donnees['descriptifArticle']; ?>
				</div>
				<p class="refColor"><b>Réf :</b> <?php echo $donnees['refArticle']; ?></p>
			</div>
	<!-- Nombre d'articles en stock -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<p><b>Stock</b></p>
				<p><?php echo $donnees['stockArticle']; ?></p>
			</div>
	<!-- Prix de l'article -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<p><b>Prix</b></p>
				<p><?php echo $donnees['prixArticle'].' €'; ?></p>
			</div>
	<!-- Bouton d'ajout au panier -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<button>Ajouter au panier</button>
			</div>
		</div>
		<?php
			}
			$reponse->closeCursor(); // Termine le traitement de la requête
		?>
		<div><hr></div>
<!-- Fin Modèle d'article -->
	</div>

<!-- fin contenu de la page -->

</body>
<script>

</script>
</html>