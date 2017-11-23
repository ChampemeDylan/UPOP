<?php
session_start();

require "./php/verifConnexion.php";

// test bouton validCompte appuyé
if(isset($_POST['validCompte']))
{
	// inclu editCompte.php à la page courante
	include('php/editCompte.php');
}

?>

<!DOCTYPE html>
<html>
<!-- Header -->
	<head>
		<meta charset='utf-8'>
		<link rel="icon" type="image/png" href="Images\iconeupop.png"/>
		<!-- feuilles de style -->
		<link rel="stylesheet" href="./css/bootstrap.min.css"/>
		<link rel="stylesheet" href="./css/main.css"/>
		<link rel="stylesheet" href="./css/compte.css"/>
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
                	<li><a href="panier.php"><img class="imgButton" src="images/panier.png"><span class="countArticle">45</span></a></li>
                    <li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>

<!-- contenu de la page -->
		<div class="container center marginTopPage">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-6">

<!-- Formulaire infos personnelles -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Compte de <?php echo $_SESSION['loginUser']; ?></h3><!-- insert de code php pour afficher la variable de session -->
						</div>
						<div class="panel-body">
							<form role="form" method="post" action="Compte.php">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Nom -->
										<?php echo '<input type="text" name="nomUser" id="nomUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['nomUser']).'">'; ?><!-- htmlspecialchars pour pouvoir récupérer la donnée pouvant contenir des caractères spéciaux -->
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Prenom -->
										<?php echo '<input type="text" name="prenomUser" id="prenomUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['prenomUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group"><!-- Genre -->
										<select name="genreUser" id="genreUser" class="form-control input-sm" value=<?php echo $_SESSION['genreUser']; ?>><!-- selection de choix -->
											<option value="M">Masculin</option>
											<option value="F">Féminin</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group"><!-- Date de naissance -->
										<input type="date" name="dateNaissanceUser" id="dateNaissanceUser" class="form-control input-sm" value=<?php echo $_SESSION['dateNaissanceUser']; ?>><!-- format de type date -->
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Adresse -->
									<?php echo '<input type="text" name="adresseUser" id="adresseUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['adresseUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group"><!-- Code Postal -->
										<input type="number" maxlength="5" name="cpUser" id="cpUser" class="form-control input-sm" value=<?php echo $_SESSION['cpUser']; ?>><!-- number limité à 5 caractères -->
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group"><!-- Ville -->
										<?php echo '<input type="text" name="villeUser" id="villeUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['villeUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Mail -->
										<input type="email" name="mailUser" id="mailUser" class="form-control input-sm" value=<?php echo $_SESSION['mailUser']; ?>><!-- format de type email -->
									</div>
								</div>
								<div class="panel-heading">
									<h3 class="panel-title panel-title2">Changement de mot de passe</h3>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Mot de passe -->
										<input type="password" name="passwordUser" id="passwordUser" class="form-control input-sm" placeholder="Mot de passe"><!-- format de type password -->
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Confirmation Mot de passe -->
										<input type="password" name="passwordUser2" id="passwordUser2" class="form-control input-sm" placeholder="Confirmation Mot de passe">
									</div>
								</div>
								<button class="btn" name="validCompte" type="submit">Valider</button>
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
