<?php
session_start();

require "./php/verifConnexion.php";
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="Images\iconeupop.png"/>

<!-- feuilles de style -->
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/main.css"/>
    <link rel="stylesheet" href="./css/figurines.css">

<!-- fichiers javascript -->
    <script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="./js/bootstrap.min.js"></script>

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
                	<li><a href="compte.php"><img class="imgButton" src="images/compte.png"><?php echo ' '.$_SESSION['loginUser'] ?></a></li>
                	<li><a href="panier.php"><img class="imgButton" src="images/panier.png"></a></li>
                    <li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- fin barre de navigation -->

<!-- contenu de la page -->
	<div class="container marginTopPage">
<!-- choix de la catégorie -->
		<div class="row text-center">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href="?categorie=jeux"><img class="imgButton2" src="images/jeux.png"></br><b>Jeux Vidéos</b></a>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href="?categorie=series"><img class="imgButton2" src="images/serie.png"></br><b>Séries</b></a>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL  ( href ) -->
				<a href="?categorie=films"><img class="imgButton2" src="images/film.png"></br><b>Films</b></a>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<!-- /!\ WARNING A COMPLETER AVEC REQUETE SQL ( href ) -->
				<a href="?categorie=animes"><img class="imgButton2" src="images/anime.png"></br><b>Animés</b></a>
			</div>
		</div>
		<div class="row">
			<?php
				if(isset($_GET['categorie'])){
				switch ($_GET['categorie']) {
					case 'films':
						// On récupère tout le contenu de la table via la requête suivante
						echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><h2><b>Films</b></h2></div>';
						break;
					case 'jeux':
						// On récupère tout le contenu de la table via la requête suivante
						echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><h2><b>Jeux vidéos</b></h2></div>';
						break;
					case 'series':
						// On récupère tout le contenu de la table via la requête suivante
						echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><h2><b>Séries</b></h2></div>';
						break;
					case 'animes':
						// On récupère tout le contenu de la table via la requête suivante
						echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><h2><b>Animés</b></h2></div>';
						break;
				}
			} else {
				echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><h2><b>Tous nos produits</b></h2></div>';
			}


			?>
		</div>
		<br/>
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
			// On vérifie si la categorie apparaît dans l'URL pour afficher les produits ciblés...
			if(isset($_GET['categorie'])){
				// SELON la valeur de $_GET['categorie'], le libellé prend une valeur différente
				switch ($_GET['categorie']) {
					case 'films':
						$libelle = 'Film';
						break;
					case 'jeux':
						$libelle = 'Jeu vidéo';
						break;
					case 'series':
						$libelle = 'Série';
						break;
					case 'animes':
						$libelle = 'Dessin Animé';
						break;
				}
				// Requête que l'on va utiliser en fonction de la catégorie choisie
				$reponse = $bdd->query('select fiche_article.refArticle,descriptifArticle,libelleArticle,fiche_article.libelleUnivers,stockArticle,prixArticle,libelleCategorie from fiche_article,univers_categorie,stock_article where fiche_article.libelleUnivers = univers_categorie.libelleUnivers and fiche_article.refArticle = stock_article.refArticle and libelleCategorie="'.$libelle.'";');
			// ... sinon on affiche tous les produits
			} else {
				$reponse = $bdd->query('select * from fiche_article,stock_article where fiche_article.refArticle=stock_article.refArticle order by libelleArticle;');
			}
			// On affiche chaque entrée une à une qu'on récupère dans le conteneur $reponse
			while ($donnees = $reponse->fetch())
			{
		?>
<!-- Modèle d'article -->
		<div class="row panel panel-default">
		<!-- Image de l'article -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<img class="imageArticle" src=<?php echo 'images/'.$donnees['refArticle'].'.png' ?>> <!-- Insertion PHP de la refArticle pour l'affichage de la bonne image -->
			</div>
	<!-- Titre et description de la figurine -->
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<p>
					<b>	<!-- Insertion PHP du titre et du libellé de la figurine -->
						<?php echo $donnees['libelleArticle']; ?> (<?php echo $donnees['libelleUnivers']; ?>)
					</b>
				</p>
				<div id="describe">
					<!-- Insertion PHP de la description de la figurine -->
					<?php echo nl2br($donnees['descriptifArticle']); ?>
				</div>
				<p class="refColor">
					<b>Réf :</b> <!-- Insertion PHP de la refArticle -->
					<?php echo $donnees['refArticle']; ?>
				</p>
			</div>
	<!-- Nombre d'articles en stock -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<p>
					<b>Stock</b>
				</p>
				<p>
					<?php
					if ($donnees['stockArticle']>0)
					{
						echo $donnees['stockArticle'];
					} else {
						echo 'Indisponible';}
					?>
				</p>
			</div>
	<!-- Prix de l'article -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<p><b>Prix</b></p>
				<!-- Insertion PHP du prix de l'article -->
				<p><?php echo $donnees['prixArticle'].' €'; ?></p>
			</div>
	<!-- Bouton d'ajout au panier -->
			<div class="col-sm-1 col-sm-1 col-md-1 col-lg-1">
				<?php 
				if ($donnees['stockArticle']>0)
					echo '<button value='.$donnees['refArticle'].' type="submit">Ajouter au panier</button>';
				 ?>
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
		$("button").click(function(){
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
