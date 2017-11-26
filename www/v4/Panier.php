<?php
session_start();
require "./php/verifConnexion.php";
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<link rel="icon" type="image/png" href="Images\iconeupop.png"/>
<!-- feuilles de style -->
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/main.css"/>
    <link rel="stylesheet" href="./css/panier.css"/>
<!-- fichiers javascript -->
    <script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="./js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv= "Content-Type" content= "text/html; charset=utf-8"/>

	<title>U POP - Panier</title>
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
                                //$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
                                //$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960','dbo708219960','dbo708219960', $pdo_options);
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
                    	<!-- insertion d'un compteur caché au chargement de la page -->
                    	<input type="number" id="compteur" value=<?php echo $row[0] ?>>
                    	<span id="countArticle"> </span>
                    	</a>
                    </li>
                    <li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- fin barre de navigation -->

<!-- contenu de la page -->
	<div class="container marginTopPage">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Panier</h3>
					</div>
					<div class="panel-body">
						<!-- bloc titre des colonnes du panier -->
						<div class="row fond">
							<div class="col-xs-1 col-sm-1 col-md-1">				
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2">	
								<div><b>Ref. Article</b></div>			
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4">				
								<div><b>Titre de l'article</b></div>
							</div>
							<div class="col-xs-1 col-sm-1 col-md-1">				
								<div class="prixProduit"><b>Prix Unit. (en €)</b></div>
							</div>
							<div class="col-xs-1 col-sm-1 col-md-1">				
								<div class="quantiteArticle"><b>Quantité</b></div>
							</div>
							<div class="col-xs-1 col-sm-1 col-md-1">				
								<div class="prixProduitTotal"><b>Prix Total (en €)</b></div>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2">				
							</div>	
						</div>
						<hr>
						<?php 
							try
							{
							    //on se connecte à la base de données
							    // en local
							    $bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

							    //en online
                                //$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
                                //$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960','dbo708219960','dbo708219960', $pdo_options);
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
							    $sql = "SELECT commande.numeroCommande,commande_article.refArticle,libelleArticle,libelleUnivers,prixArticle,stockArticle,quantiteArticle FROM commande,commande_article,fiche_article,stock_article WHERE stock_article.refArticle=fiche_article.refArticle AND fiche_article.refArticle=commande_article.refArticle AND commande.numeroCommande=commande_article.numeroCommande AND loginUser=:loginUser AND etatCommande='En cours'";
							    $stmt = $bdd->prepare($sql);
							    $stmt->execute(array(
							        'loginUser' => $_SESSION['loginUser']
							    ));
							    while ($row = $stmt->fetch())
							    	{
							    		$_SESSION['numCommande'] = $row['numeroCommande'];
						?>
						<!-- bloc d'un article du panier -->
						<div class="row fond article">
							<!-- image de l'article du panier -->
							<div class="col-xs-1 col-sm-1 col-md-1">				
								<img id="ImgPerso" src=<?php echo 'images/'.$row['refArticle'].'.png' ?>>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 refArticle">	
								<?php echo $row['refArticle']; ?>		
							</div>
							<!-- libellé de l'article du panier -->
							<div class="col-xs-4 col-sm-4 col-md-4">				
								<div class="libelleArticle"><?php echo $row['libelleArticle']; ?></div>
								<div class="libelleUnivers"><?php echo $row['libelleUnivers']; ?></div>
							</div>
							<!-- prix unitaire de l'article du panier -->
							<div class="col-xs-1 col-sm-1 col-md-1 prixProduit">				
								<?php echo $row['prixArticle']; ?>
							</div>
							<!-- quantite de l'article du panier -->
							<div class="col-xs-1 col-sm-1 col-md-1" class="qteArticle">	
								<input class="quantiteArticle" type="number" min="0" max=<?php echo $row['stockArticle'] ?> value=<?php echo $row['quantiteArticle'] ?>></input>			
							</div>
							<!-- montant total pour cet article du panier -->
							<div class="col-xs-1 col-sm-1 col-md-1 prixProduitTotal">				
								<?php 
									$qte = $row['quantiteArticle'];
									$prix = $row['prixArticle']; 
									$prixTotal = $qte*$prix;
									echo $prixTotal;	
								?>
							</div>
							<!-- suppresion de l'article du panier -->
							<div class="col-xs-2 col-sm-2 col-md-2">
								<input type="button" value="Supprimer" class="suppressionArticle btn" id=<?php echo $row['refArticle']; ?>>				
							</div>
						</div>
						<?php
							}
							$stmt->closeCursor(); // Termine le traitement de la requête
						}
						?>	
						<hr>
						<div class="row fond">
							<div class="col-xs-12 col-sm-12 col-md-12 text-right">
						    	<div>
						        	<label>Total HT</label>
						      		<div class="totalCommande" id="sousTotalPanier"></div>
						    	</div>
						    	<div>
						    	    <label>TVA (20%)</label>
						        	<div class="totalCommande" id="tvaPanier"></div>
						    	</div>
						    	<div>
						    	    <label>Total Commande</label>
						      		<div class="totalCommande" id="totalPanier"></div>
						    	</div>
						    	<br>
							<input type="button" value="Commander" class="btn validationCommande">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- fin contenu de la page -->
</body>
<script>
	var tauxTVA = 0.20;
	var fadeTime = 200;

	$(window).on('load',function(){
		calculPanier();
    	count = parseInt($("#compteur").val());
    	$("#countArticle").append(count);
    });

	$('.quantiteArticle').change( function() {
    	modifQuantite(this);
	});

    $('.suppressionArticle').click( function() {
  		deleteArticle(this);
	});

	function calculPanier()
	{
		var sousTotal = 0;

		$('.article').each(function () {
			sousTotal += parseFloat($(this).children('.prixProduitTotal').text());
		});

		var TVA = sousTotal * tauxTVA;
		var totalCommande = sousTotal + TVA;

		$('.totalCommande').fadeOut(fadeTime, function() {
			$('#sousTotalPanier').html(sousTotal.toFixed(2));
			$('#tvaPanier').html(TVA.toFixed(2));
			$('#totalPanier').html(totalCommande.toFixed(2));
			if(totalCommande == 0){
				$('.validationCommande').fadeOut(fadeTime);
			}else{
				$('.validationCommande').fadeIn(fadeTime);
			}
		$('.totalCommande').fadeIn(fadeTime);
		});
	};

	function deleteArticle(boutonSuppression)
	{
    	var ligneArticle = $(boutonSuppression).parent().parent();
    	var prixArticleEnCours = parseFloat(ligneArticle.children('.prixProduit').text());
		var qteArticleEnCours = parseInt(ligneArticle.children().children('.quantiteArticle').val());
		var refArticleEnCours = ligneArticle.children('.refArticle').text();

		console.log(prixArticleEnCours,qteArticleEnCours,refArticleEnCours);
		$.ajax({
				url: 'php/suppressionPanier.php',
	    		data: 'refArticle='+ refArticleEnCours,
	    		success: function(){
	    			count-=1;
		    			$("#countArticle").html(count);
	    		}
			});

    	ligneArticle.slideUp(fadeTime, function() {
    		ligneArticle.remove();
    		calculPanier();
    	});
	};

	function modifQuantite(quantiteSaisie)
	{
		var ligneArticle = $(quantiteSaisie).parent().parent();
		var prix = parseFloat(ligneArticle.children('.prixProduit').text());
		var quantite = parseInt($(quantiteSaisie).val());
		var prixTotal = prix * quantite;

		ligneArticle.children('.prixProduitTotal').each(function () {
			$(this).fadeOut(fadeTime, function() {
				$(this).text(prixTotal.toFixed(2));
				calculPanier();
				$(this).fadeIn(fadeTime);
			});
		});  
	};
</script>
</html>