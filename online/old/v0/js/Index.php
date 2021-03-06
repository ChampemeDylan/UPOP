<!DOCTYPE html>
<html>
<!-- Header -->
<head>
	<meta charset='utf-8'>
	<link rel="icon" type="image/png" href="Images\iconeupop.png"/>
	<!-- feuilles de style -->
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
	<link rel="stylesheet" href="./css/main.css"/>
	<link rel="stylesheet" href="./css/index.css"/>
	<!-- fichiers javascript -->
	<script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
	<script type="application/javascript" src="./js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bienvenue sur U'POP</title>
</head>

<!-- corps de texte -->
	<body>
		<div class="container">
<!-- page de connexion -->
			<div id="connexion" class="row centered-form">
				<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
					<form class="form-login" method="post" action="php/connexion.php"><!-- appel du php de connexion -->
						<img src="images/iconeupop.png" width="400px" class="img-responsive center-block"/>
						<h4>Bienvenue sur U'POP</h4>
						<input type="text" id="loginUser" name="loginUser" class="form-control input-sm chat-input" placeholder="Pseudo" />
						</br>
						<input type="password" id="passwordUser" name="passwordUser" class="form-control input-sm chat-input" placeholder="Mot de passe" />
						<?php if(isset($_GET['erreurconnexion'])){
							echo '<div style="text-align:center;color:red;">Erreur lors de la connexion</div>';
						} else if(isset($_GET['erreurlogin'])){
							echo '<div style="text-align:center;color:red;">Aucun login</div>';
						} else if(isset($_GET['erreurpass'])){
							echo '<div style="text-align:center;color:red;">Aucun mot de passe</div>';
						} else if(isset($_GET['erreurbdd'])){
							echo '<div style="text-align:center;color:red;">Erreur de connexion à la base</div>';
						} else {
							echo '<br>';
						}
						?>
						</br>
						<div class="wrapper">
							<span class="group-btn">
								<br>
								<button href="#" class="btn" type="submit" name="connexion">Se connecter</button>
								<button class="btn" type="button" onclick="boutonClick(event)">Inscription</button><!-- appel fonction de bascule sur div inscription -->
							</span>
						</div>
					</form>
				</div>
			</div>

<!-- page d'inscription -->
			<div id="inscription" class="row centered-form">
				<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
					<div class="row panel panel-default centered-form">
						<div class="panel-heading">
							<h3 class="panel-title">Formulaire d'inscription</h3>
						</div>
						<div class="panel-body">
							<form role="form" method="post" action="/php/inscription.php"><!-- appel du php d'inscription -->
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="loginUser" id="loginUser" class="form-control input-sm" placeholder="Login">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="password" name="passwordUser" id="passwordUser" class="form-control input-sm" placeholder="Mot de passe">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="password" name="passwordUser2" id="passwordUser2" class="form-control input-sm" placeholder="Confirmer Mot de passe">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="nomUser" id="nomUser" class="form-control input-sm" placeholder="Nom">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="prenomUser" id="prenomUser" class="form-control input-sm" placeholder="Prénom">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<select name="genreUser" id="genreUser" class="form-control input-sm">
											<option value="M">Masculin</option>
											<option value="F">Féminin</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="date" name="dateNaissanceUser" id="dateNaissanceUser" class="form-control input-sm" placeholder="Date de naissance">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="adresseUser" id="adresseUser" class="form-control input-sm" placeholder="Adresse Postale">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="number" maxlength="5" name="cpUser" id="cpUser" class="form-control input-sm" placeholder="Code Postal">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="villeUser" id="villeUser" class="form-control input-sm" placeholder="Ville">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="email" name="mailUser" id="mailUser" class="form-control input-sm" placeholder="E-mail">
									</div>
								</div>
								<button class="btn" type="submit">Valider</button>
								<button class="btn" onclick="boutonClick2(event)" type="button">Connexion</button><!-- appel fonction de bascule sur div connexion -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script>
	//cache par défaut la div d'inscription
	$(document).ready(function()
    {
        $("#inscription").hide();
    });

	//bascule de connexion à inscription
	function boutonClick(event)
    {
        $("#connexion").hide(400);
        $("#inscription").show(400);
    }

	//bascule d'inscription à connexion
	function boutonClick2(event)
    {
        $("#inscription").hide(400);
        $("#connexion").show(400);
    }

	</script>
</html>
