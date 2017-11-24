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
	<link rel="stylesheet" href="./css/accueil.css">

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
                    <!-- Insertion du logo Admin sous condition -->
                    <?php
                        if ($_SESSION['typeUser']>0) {
                            echo '<li><a href="Administration.php"><img class="imgButton" src="images/admin.png">';
                        }
                    ?>
                    <li><a href="compte.php"><img class="imgButton" src="images/compte.png"><span id="login"><?php echo ' '.$_SESSION['loginUser'] ?></span></a></li>
                    <?php
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
                                // VERIFICATION DE LA COMMANDE EN COURS
                                $sql = "SELECT count(*) FROM commande,commande_article WHERE commande.numeroCommande=commande_article.numeroCommande AND loginUser=:loginUser AND etatCommande='En cours';";
                                $stmt = $bdd->prepare($sql);
                                $stmt->execute(array(
                                    'loginUser' => $_SESSION['loginUser']
                                ));
                                $row = $stmt->fetch();
                            }
                                    
                    ?>
                    <li>
                        <a href="panier.php"><img class="imgButton" src="images/panier.png">
                        <span id="countArticle"> <?php echo $row[0] ?></span>
                        </a>
                    </li>
                    <li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>

   <!-- fin barre de navigation -->


<!-- contenu de la page -->
<div class="container">
	<div class="row">
	    <!-- Card -->


    <div class="container mt-4 mb-5">

<!-- debut vidéo responsive -->
		<div class="video-container">
            <!-- <iframe src="videos/StrangerThings2pops.mp4" frameborder="0"></iframe> -->
            <video src="videos/coming soon sonic pops.mp4" type="video/mp4" autoplay loop muted>Prochainement</video>
		</div>
    </div>
</div>
	<!-- fin vidéo responsive -->
        <h3 class="display-4 text-center"> Présentation des Produits </h3>
        <hr class="bg-dark mb-4 w-25">
        <div class="row">
            <div class="col-md-4">
                <div class="card panel panel-default">
                    <img class="image1" src="./images/King.png">
                    <div class="card-block p-3">
                        <h4 class="card-title">Nouveautées !</h4>
                        <p class="card-text">De nouveaux produits sont en stocks dans nos rayons, venez vite les découvrir avant que tous nos U'POPS partent !</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card panel panel-default">
                    <img class="image1" src="./images/Trooper.png">
                    <div class="card-block p-3">
                        <h4 class="card-title">A nouveau présent !</h4>
                        <p class="card-text">Les U'POPS de la catégorie STARS WARS ont été victimes de leurs succès ! Mais grâce à notre réactivité, ils sont à nouveau disponible !</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card panel panel-default">
                    <img class="image1" src="./images/Snow.png">
                    <div class="card-block p-3">
                        <h4 class="card-title">Winter is COMING ! </h4>
                        <p class="card-text">Le mois de décembre arrive à grand pas ! N'hésitez pas vous équiper en conséquence ! Toutes notre collections U'POP est présente !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->

    <div class="container mb-5">
        <div class="row  panel panel-default">
            <div class="col-md-8">
                <h3 class="display-4">Histoire des U'POPS</h3>
                <hr class="bg-dark w-25 ml-0">
                <p class="lead">
                Bienvenue sur le premier site français consacré aux figurines Pop !
                </p>
                <p>
                Nous suivons et partageons leur actualité depuis 2014, et sommes nous-même collectionneurs. Nous publions en permanence de nouvelles U'POP
				(personnages de séries, films ou jeux vidéo, etc...). Nous traitons l'actualité des Funko Pop, enfin, nous publions régulièrement des articles
				spécialisés : il y a par exemple nos conseils pour trouver des figurines U'POP sur notre sites composés en différents onglets.
                <br>
				Les différentes catégories présentent sur notre sites sont :
				</p>
                <ul class="list-unstyled pl-4">
                    <li><i class="fa fa-check"></i> Les séries </li>
                    <li><i class="fa fa-check"></i> Les films</li>
                    <li><i class="fa fa-check"></i> Les jeux vidéos</li>
					<li><i class="fa fa-check"></i> Les dessins-animés</li>
                </ul>
            </div>
			 <!-- Carousel  -->
    	<div id="carousel-example-generic" class="carousel slide col-md-4" data-ride="carousel">

			<ol class="carousel-indicators">
			  	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
			    <div class="item active">
			    	<img src="./images/trooper.png" alt="First slide">

                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <div class="">
                            </div>
                        </div>
                    </div>
			    </div>
			    <div class="item">
			    	<img src="./images/deadpool.png" alt="Second slide">

                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <div class="">
                            </div>
                        </div>
                    </div>
			    </div>
			    <div class="item">
			    	<img src="./images/king.png" alt="Third slide">

                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <div class="">
                            </div>
                        </div>
                    </div>
			    </div>
			</div>

			<a class="controle-caroussel.gauche" href="#carousel-example-generic" data-slide="prev"></a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next"></a>
		</div>
	 </div>
</div>
        </div
    </div>


<!-- fin articles de la page -->

<!-- fin contenu de la page -->

</body>
</html>
