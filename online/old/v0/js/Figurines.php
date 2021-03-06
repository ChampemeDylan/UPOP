<?php
session_start()
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3c.org/TR/xhtml1/DTD/xtmlhtml1-strict.dtd">


<html>
<head>
	<meta charset='utf-8'>
	<link rel="icon" type="image/png" href="Images\iconeupop.png"/>

<!-- feuilles de style -->
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/main.css"/>
    <link rel="stylesheet" href="./css/figurines.css">

<!-- fichiers javascript -->
    <script type="application/javascript" src="./js/jquery-2.1.1.min.js"></script>
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
				<a href=""><img class="imgButton2" src="images/jeux.png"></br>Jeux Vidéos</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href=""><img class="imgButton2" src="images/serie.png"></br>Séries</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL  ( href ) -->
				<a href=""><img class="imgButton2" src="images/film.png"></br>Films</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href=""><img class="imgButton2" src="images/anime.png"></br>Animés</a>
			</div>
		</div>
		<div class="col-xs-12"><hr></div>
<!-- fin de choix de la catégorie -->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<h2>A remplir en fonction de la requête SQL</h2>
			</div>
			<div class="col-xs-12"><hr></div>
		</div>
<!-- Modèle d'article -->
<!-- /!\ A saupoudrer de requêtes SQL-->
		<div class="row panel panel-default">
	<!-- Image de l'article -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<img class="imageArticle" src="images/got1.jpg">
			</div>
	<!-- Titre et description de la figurine -->
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<p><b>Titre figurine</b></p>
				<a href="#describe" class="" data-toggle="collapse">Description...</a>
				<div id="describe" class="collapse">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit,
					sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</div>
				<p class="refColor">Réf : 01010101</p>
			</div>
	<!-- Nombre d'articles en stock -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<p>En stock</p>
			</div>
	<!-- Prix de l'article -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<p>Prix</p>
			</div>
	<!-- Bouton d'ajout au panier -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<button>Add Cart</button>
			</div>
		</div>
		<div><hr></div>
<!-- Fin Modèle d'article -->
	</div>

<!-- fin contenu de la page -->

</body>
</html>
