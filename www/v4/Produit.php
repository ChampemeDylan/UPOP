<?php
// Ouverture de session
session_start();
require "./php/verifConnexion.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" type="image/png" href="Images\iconeupop.png"/>
  	<!-- feuilles de style -->
  	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
  	<link rel="stylesheet" href="./css/main.css"/>
  	<link rel="stylesheet" href="./css/produit.css">
  	<!-- fichiers javascript -->
  	<script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
  	<script type="application/javascript" src="./js/bootstrap.min.js"></script>
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<title>U POP</title>
  </head>
  <body>

<!-- Barre de navigation -->
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
  					<li><a href="compte.php"><img class="imgButton" src="images/compte.png"><?php echo ' '.$_SESSION['loginUser']?></a></li>
  					<li><a href="panier.php"><img class="imgButton" src="images/panier.png"><span class="countArticle">45</span></a></li>
  					<li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
  				</ul>
  			</div>
  		</div>
  	</nav>

<!-- Fin de Barre de navigation -->
    <div class="container marginTopPage panel-default">

<!-- Nom de l'article -->
      <div class="row panel-heading">
        <div class="col-xs-12 panel-title">
          <h2>Nom de l'article <?php echo $donnees['libelleArticle']; ?> (<?php echo $donnees['libelleUnivers']; ?>Univers)</h2>
        </div>
      </div>
      <div class="row">

<!-- Photo de l'article -->
        <div class="col-xs-12 col-md-4">
          <img src="./images/010101.png" class="imageProduit">
          <img src="<?php echo 'images/'.$donnees['refArticle'].'.png' ?>" class="imageProduit">
        </div>

<!-- Description de l'article -->
        <div class="col-xs-12 col-md-6">
          <p>lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet lorem ipsum dolir sit amet
          </p>
          <p><?php echo nl2br($donnees['descriptifArticle']); ?></p>
          <p><b>Réf : </b><?php echo $donnees['refArticle']; ?>999999</p>
        </div>

<!-- Prix Quantité AddCart -->
        <div class="col-xs-12 col-md-2">
          <div class="row">

            <!-- Prix de l'article -->
            <div class="col-xs-12">
              <p><b>Prix : </b><?php echo $donnees['prixArticle'].' €'; ?></p>
            </div>

            <!-- Quantité -->
            <div class="col-xs-12">
              <p><b>Qté : </b><?php
  							if ($donnees['stockArticle']>0)
  								{
  									echo $donnees['stockArticle'];
  								} else {
  									echo 'Indisponible';
  								}
  						?></p>
            </div>

            <!-- Bouton ajout au panier -->
            <div class="col-xs-12">
              <?php
      				if ($donnees['stockArticle']>0)
      					echo '<a href="#"><img class="imgButton" src="./images/panier.png"></a>';
      		 		?>
            </div>
          </div>

        </div>
      </div>
    </div>


  </body>
</html>
