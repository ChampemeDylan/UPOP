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
  $refA = $_GET['refArticle'];
  $reponse = $bdd->query('select * from fiche_article,stock_article where fiche_article.refArticle=stock_article.refArticle and fiche_article.refArticle="'.$refA.'";');
  $donnees = $reponse->fetch();
  ?>
<!-- Nom de l'article -->
  <div class="row panel-heading">
    <div class="col-xs-12 panel-title">
      <h2> <?php echo $donnees['libelleArticle']; ?> (<?php echo $donnees['libelleUnivers']; ?>)</h2>
    </div>
  </div>
  <div class="row">

<!-- Photo de l'article -->
    <div class="col-xs-12 col-md-4">
      <img src="<?php echo 'images/'.$donnees['refArticle'].'.png' ?>" class="imageProduit">
    </div>

<!-- Description de l'article -->
    <div class="col-xs-12 col-md-6">
      <div class="paddingArticle">
        <p><?php echo nl2br($donnees['descriptifArticle']); ?></p>
        <p class="refColor"><b>Réf : </b><?php echo $donnees['refArticle']; ?></p>
      </div>
    </div>

<!-- Prix Quantité AddCart -->
    <div class="col-xs-12 col-md-2">
      <div class="row">
        <div class="paddingArticle">

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
    					echo '<button class="validationPanier btn btn-default" value='.$donnees['refArticle'].' type="submit">Ajouter au panier</button>';
    		 		?>
            
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script>
$(".validationPanier").click(function(){
  var ref = $(this).val();
  $.ajax({
    url: 'php/ajoutPanier.php',
      data: 'refArticle='+ ref,
      success: function(reponse) {
        alert(reponse); // reponse contient l'affichage du fichier PHP (soit echo)
      }
  });
})
</script>

</html>
