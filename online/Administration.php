<?php
session_start();

require "./php/verifConnexion.php";
require "./php/setArticle.php";

function debug_to_console($data) {
    if(is_array($data) || is_object($data))
	{
		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
	} else {
		echo("<script>console.log('PHP: ".$data."');</script>");
	}
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
    <link rel="stylesheet" href="./css/administration.css">

<!-- fichiers javascript -->
    <script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="./js/bootstrap.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
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
                                //$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

                                //en online
                                $bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
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
                    <li><a href="index.php"><img class="imgButton" src="images/deco.png"></a></li>
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
				<br />
				<br />
				<div class="col-xs-12"><hr></div>
			</div>
		</div>

		<h1>Gestion des produits</h1><br />
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
<!-- Ajouter element -->
								<h3 class="panel-title">Ajouter un article.</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="php/ajoutElement.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="refArticle"  class="form-control input-sm" placeholder="Reference">
											<?php if(isset($_GET['erreurref'])){
												echo '<div style="text-align:center;color:red;">Aucune reference</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="libelleArticle" class="form-control input-sm" placeholder="Libelle">
											<?php if(isset($_GET['erreurlibelle'])){
												echo '<div style="text-align:center;color:red;">Aucun libelle</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="descriptifArticle"  class="form-control input-sm" placeholder="Description">
											<?php if(isset($_GET['erreurarticle'])){
												echo '<div style="text-align:center;color:red;">Aucune description</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="prixArticle"  class="form-control input-sm" placeholder="Prix">
											<?php if(isset($_GET['erreurprix'])){
												echo '<div style="text-align:center;color:red;">Aucun prix</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="libelleUnivers"  class="form-control input-sm" placeholder="Univers">
											<?php if(isset($_GET['erreurexist'])){
												echo '<div style="text-align:center;color:red;">Cet univers n\'existe pas</div>';
											} else if(isset($_GET['successajoutelem'])){
												echo '<div style="text-align:center;color:green;">L\'element à été ajouté</div>';
											}
											?>
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
<!-- ajouter un univers -->
								<h3 class="panel-title">Ajouter un univers.</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="php/ajoutUnivers.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="libelleUnivers"  class="form-control input-sm" placeholder="Univers">
											<?php if(isset($_GET['erreurlibelle2'])){
												echo '<div style="text-align:center;color:red;">Aucun univers</div>';
											} else if(isset($_GET['erreurexist2'])){
												echo '<div style="text-align:center;color:red;">Cet univers existe deja</div>';
											} else if(isset($_GET['successajoutuniv'])){
												echo '<div style="text-align:center;color:green;">L\'univers à été ajouté</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="categ1" value="Jeu Vidéo"> Jeu Vidéo
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="categ2" value="Série"> Série
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="categ3" value="Film"> Film
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="checkbox" name="categ4" value="Dessin Animé"> Dessin Animé
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
<!-- modifier un element -->
								<h3 class="panel-title">Modifier un element.</h3>
							</div>
							<div class="panel-body">
<!-- recherche d'un element et affichage -->
								<form role="form" method="post">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<!--<input type="text" name="refArticle"  class="form-control input-sm" placeholder="Reference">-->
											<?php echo '<input type="text" name="refArticle"  class="form-control input-sm reference" placeholder="Reference"  value="'.htmlspecialchars($_SESSION['refArticle']).'">'; ?>
											<?php if(isset($_GET['erreurref5'])){
												echo '<div style="text-align:center;color:red;">Aucune reference</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-5 col-sm-5 col-md-5">
										<div class="form-group">
											<?php echo '<input type="submit" name="Chercher" class="btn btn-block chercher">' ?>
										</div>
									</div>
								</form>
							</div>
							<div class="panel-body">
<!-- modification d'un element -->
								<form role="form" method="post" action="php/modifElement.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group" style="display: none;">
											<?php echo '<input type="text" name="refArticle"  class="form-control input-sm" placeholder="Libelle"  value="'.htmlspecialchars($_SESSION['refArticle']).'">'; ?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<?php if(isset($_GET['successmodifelem'])){
												echo '<div style="text-align:center;color:green;">Modification effectuée</div>';
											}
											?>
											<?php echo '<input type="text" name="libelleArticle"  class="form-control input-sm" placeholder="Libelle"  value="'.htmlspecialchars($_SESSION['libelleArticle']).'">'; ?>
											<?php if(isset($_GET['erreurlibelle6'])){
												echo '<div style="text-align:center;color:red;">Aucun libelle</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<?php echo '<textarea cols="40" rows="20" name="descriptifArticle"  class="form-control input-sm" placeholder="Description">'.htmlspecialchars($_SESSION['descriptifArticle']).'</textarea>'; ?>
											<?php if(isset($_GET['erreurarticle6'])){
												echo '<div style="text-align:center;color:red;">Aucune description</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<?php echo '<input type="text" name="prixArticle"  class="form-control input-sm" placeholder="Prix" value="'.htmlspecialchars($_SESSION['prixArticle']).'">'; ?>
											<?php if(isset($_GET['erreurprix6'])){
												echo '<div style="text-align:center;color:red;">Aucun prix</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<?php echo '<input type="text" name="libelleUnivers"  class="form-control input-sm" placeholder="Univers" value="'.htmlspecialchars($_SESSION['libelleUnivers']).'">'; ?>
											<?php if(isset($_GET['erreurexist6'])){
												echo '<div style="text-align:center;color:red;">Cet univers n\'existe pas</div>';
											}
											?>
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
					<div class="col-xs-12 col-sm-4 col-md-4  col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading">
<!-- supprimer un article -->
								<h3 class="panel-title">Supprimer un article.</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="php/supprimElement.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="refArticle"  class="form-control input-sm" placeholder="Reference">
											<?php if(isset($_GET['erreurref2'])){
												echo '<div style="text-align:center;color:red;">Aucune reference</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="libelleArticle"  class="form-control input-sm" placeholder="Libelle">
											<?php if(isset($_GET['erreurlibelle3'])){
												echo '<div style="text-align:center;color:red;">Aucun libelle</div>';
											}
											?>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="libelleUnivers"  class="form-control input-sm" placeholder="Univers">
											<?php if(isset($_GET['erreurexist3'])){
												echo '<div style="text-align:center;color:red;">Cet univers n\'existe pas</div>';
											} else if(isset($_GET['successsupelem'])){
												echo '<div style="text-align:center;color:green;">L\'element à été supprimé</div>';
											}
											?>
										</div>
									</div>
									<input type="submit" value="Supprimer" class="btn btn-block">
								</form>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
<!-- supprimer un element -->
								<h3 class="panel-title">Supprimer un univers.</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="php/supprimUnivers.php">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="libelleUnivers"  class="form-control input-sm" placeholder="Univers">
											<?php if(isset($_GET['erreurexist4'])){
												echo '<div style="text-align:center;color:red;">Aucun univers</div>';
											} else if(isset($_GET['erreurexist5'])){
												echo '<div style="text-align:center;color:red;">Cet univers n\'existe pas</div>';
											} else if(isset($_GET['successsupuniv'])){
												echo '<div style="text-align:center;color:green;">L\'univers à été supprimé</div>';
											}
											?>
										</div>
									</div>
									<div> Attention, toute supression d'univers entraine la surpression des articles liés !</div>
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
<script>
$(".chercher").click(function(){
			var ref = $(".reference").val();
			console.log(ref);
			$.ajax({
				url: 'php/setArticle.php',
	    		data: 'refArticle=' + ref
			});
		})
</script>
</html>
