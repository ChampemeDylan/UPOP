<?php
session_start();

if(isset($_POST['validCompte']))
{
	include('php/editCompte.php');
}

if(isset($_POST['validMdp']))
{	
	include('php/editMdp.php');
}
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3c.org/TR/xhtml1/DTD/xtmlhtml1-strict.dtd">
<html>
<!-- Header -->
	<head>
		<meta charset='utf-8'>
		<link rel="icon" type="image/png" href="Images\iconeupop.png"/>
		<!-- feuilles de style -->
		<link rel="stylesheet" href="./css/bootstrap.min.css"/>
		<link rel="stylesheet" href="./css/main.css"/>
		<!-- fichiers javascript -->
		<script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<script type="application/javascript" src="./js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>U'POP - Compte</title>
	</head>

<!-- Body -->
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
						<li><a href="compte.php"><img class="imgButton" src="images/compte.png"></a></li>
						<li><a href="panier.html"><img class="imgButton" src="images/panier.png"></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
					</ul>
				</div>
			</div>
		</nav>

<!-- contenu de la page -->
		<div class="container center">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-6">

<!-- Formulaire infos personnelles -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Compte de <?php echo $_SESSION['loginUser']; ?></h3>
						</div>
						<div class="panel-body">
							<form role="form" method="post" action="Compte.php">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<?php echo '<input type="text" name="nomUser" id="nomUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['nomUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<?php echo '<input type="text" name="prenomUser" id="prenomUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['prenomUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<select name="genreUser" id="genreUser" class="form-control input-sm" value=<?php echo $_SESSION['genreUser']; ?>>
											<option value="M">Masculin</option>
											<option value="F">Féminin</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="date" name="dateNaissanceUser" id="dateNaissanceUser" class="form-control input-sm" value=<?php echo $_SESSION['dateNaissanceUser']; ?>>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
									<?php echo '<input type="text" name="adresseUser" id="adresseUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['adresseUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="number" maxlength="5" name="cpUser" id="cpUser" class="form-control input-sm" value=<?php echo $_SESSION['cpUser']; ?>>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<?php echo '<input type="text" name="villeUser" id="villeUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['villeUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="email" name="mailUser" id="mailUser" class="form-control input-sm" value=<?php echo $_SESSION['mailUser']; ?>>
									</div>
								</div>
								<button class="btn" name="validCompte" type="submit">Valider</button>				
							</form>
						</div>
					</div>

<!-- Formulaire changement mot de passe -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Changement de mot de passe</h3>
						</div>
						<div class="panel-body">
							<form role="form" method="post" action="/php/editMdp.php">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="password" name="passwordUser" id="passwordUser" class="form-control input-sm" value=<?php echo $_SESSION['passwordUser']; ?>>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="password" name="passwordUser2" id="passwordUser2" class="form-control input-sm" value=<?php echo $_SESSION['passwordUser']; ?>>
									</div>
								</div>
								<button class="btn" name="validMdp" type="submit">Valider</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">

<!-- Suivi des commandes -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Suivi des commandes</h3>
						</div>
						<table class="table"> 
							<thead> 
								<tr> 
									<th>Ref Commande</th> 
									<th>Date</th> 
									<th>Montant</th>
									<th>État</th>
								</tr> 
							</thead> 
							<tbody> 
								<tr> 
									<td>A</td> 
									<td>B</td>
									<td>C</td> 
									<td>D</td>  
								</tr> 
							</tbody> 
						</table>						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
