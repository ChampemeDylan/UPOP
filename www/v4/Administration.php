<?php
session_start();

//require "./php/verifConnexion.php";

// test bouton Chercher appuyé
if(isset($_POST['Chercher']))
{
	// inclu editCompte.php à la page courante
	include('php/modifElement.php');
}
?>



<!DOCTYPE html>

<html>
<head>
	<meta charset='utf-8'>
	<link rel="icon" type="image/png" href="Images\iconeupop.png"/>

<!-- feuilles de style -->
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/main.css"/>

<!-- fichiers javascript -->
    <script type="application/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="application/javascript" src="./js/bootstrap.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		#onglets{
			display: none;
		}
		#onglets li{
			position: relative;
			float: left;
			list-style: none;
			padding: 2px 5px 6px;
			margin-right: 5px;
			border: 1px solid Black;
			cursor: pointer;
			background-color: rgb(136,206,98);
			color: white;
			z-index: 1;
			border-bottom: none;
			border-top-left-radius: 15px;
			border-top-right-radius: 15px;
		}
			#onglets .actif{
			border-bottom: none;
			font-weight: bold;
			z-index: 10;
		}
			#contenu{
			clear: both;
			position: relative;
			margin: 0 20px;
			padding: 10px;
			border: 3px solid Black;
			z-index: 5;
			top: -3px;
			color: Black;
			width: calc(100% - 45px);
			overflow: hidden;
			border-radius: 15px;
		}
	</style>
	<script>
		$(function() {
			$('#onglets').css('display', 'block');
			$('#onglets').click(function(event) {
				var actuel = event.target;
				$(actuel).addClass('actif').siblings().removeClass('actif');
				setDisplay();
			});
			function setDisplay() {
				var Affiche;
				$('#onglets li').each(function(couche) {
					Affiche = $(this).hasClass('actif') ? '' : 'none';
					$('.item').eq(couche).css('display', Affiche);
				});
			}
			setDisplay();
		});
		
		
		
	</script>
	<title>Administration</title>
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
                    <li><a href="accueil.html" ><img class="imgButton" src="images/home.png"></a></li>
                    <li><a href="figurines.html"><img class="imgButton" src="images/figurine.png"></a></li>
                    <!-- <li><h2 id="titre">Accueil</h2></li> -->
                    <li><a href="contact.html"><img class="imgButton" src="images/contact.png"></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                	<li><a href="compte.php"><img class="imgButton" src="images/compte.png"><?php echo ' '.$_SESSION['loginUser'] ?></a></li>
                	<li><a href="panier.html"><img class="imgButton" src="images/panier.png"></a></li>
                    <li><a href="index.html"><img class="imgButton" src="images/deco.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- fin barre de navigation -->
<!-- contenu de la page -->
	<div class="container">
<!-- titre d'en tete -->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
				<h1>Administration</h1>
				<div class="col-xs-12"><hr></div>
			</div>
		</div>
		
		<h1>Gestion des produits</h1>
		<ul id="onglets">
			<li class="actif">Ajouter un element</li>
			<li>Modifier un element</li>
			<li>Supprimer un element</li>
		</ul>
	
		<div id="contenu">
			<div class="item">
				<div class="row centered-form">
					<div class="col-xs-12 col-sm-4 col-md-4  col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Ajouter un element.</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="php/ajoutElement.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Reference"  class="form-control input-sm" placeholder="Reference">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Libelle" class="form-control input-sm" placeholder="Libelle">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Description"  class="form-control input-sm" placeholder="Description">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Prix"  class="form-control input-sm" placeholder="Prix">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Univers"  class="form-control input-sm" placeholder="Univers">							
										</div>
									</div>
									<input type="submit" value="Ajouter" class="btn btn-block">   	
								</form>						
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Ajouter un univers.</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="php/ajoutUnivers.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Univers"  class="form-control input-sm" placeholder="Univers">							
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ1" value="Jeux vidéos"> Jeux vidéos
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ2" value="Séries"> Séries
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ3" value="Films"> Films
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ4" value="Animés"> Animés
										</div>
									</div>
									<input type="submit" value="Ajouter" class="btn btn-block">   	
								</form>						
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="row centered-form">
					<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Modifier un element.</h3>
							</div>
							<div class="panel-body">
								<form role="form">
									<div class="col-xs-7 col-sm-7 col-md-7">
										<div class="form-group" method="post" action="php/modifElement.php">
											<?php echo '<input type="text" name="Reference"  class="form-control input-sm" placeholder="refArticle"  value="'.htmlspecialchars($SESSION['refArticle']).'">'; ?>
										</div>
									</div>
									<div class="col-xs-5 col-sm-5 col-md-5">
										<div class="form-group">
											<input type="submit" value="Chercher" class="btn btn-block"> 
										</div>
									</div>
								</form>
							</div>
							<div class="panel-body">
								<form role="form">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group" method="post" action="php/modifElement2.php">
											<?php echo '<input type="text" name="Libelle"  class="form-control input-sm" placeholder="Libelle"  value="'.htmlspecialchars($SESSION['libelleArticle']).'">'; ?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<?php echo '<input type="text" name="Description"  class="form-control input-sm" placeholder="Description" value="'.htmlspecialchars($SESSION['descriptifArticle']).'">'; ?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<?php echo '<input type="text" name="Prix"  class="form-control input-sm" placeholder="Prix" value="'.htmlspecialchars($SESSION['prixArticle']).'">'; ?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<?php echo '<input type="text" name="Univers"  class="form-control input-sm" placeholder="Univers" value="'.htmlspecialchars($SESSION['universArticle']).'">'; ?>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ1" value="Jeux vidéos"> Jeux vidéos
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ2" value="Séries"> Séries
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ3" value="Films"> Films
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="Categ4" value="Animés"> Animés
										</div>
									</div> 
									<input type="submit" value="Modifier" class="btn btn-block">   		
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="row centered-form">
					<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Supprimer un element.</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="php/supprimElement.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Reference"  class="form-control input-sm" placeholder="Reference">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Libelle"  class="form-control input-sm" placeholder="Libelle">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="Univers"  class="form-control input-sm" placeholder="Univers">
										</div>
									</div>
									<input type="submit" value="Supprimer" class="btn btn-block">   		
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
<!-- fin contenu de la page -->
</body>
</html>