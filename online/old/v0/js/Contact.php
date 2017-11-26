<?php
session_start()
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3c.org/TR/xhtml1/DTD/xtmlhtml1-strict.dtd">
<html>
	<head>

		<meta charset='utf-8'>
		<link rel="icon" type="image/png" href="Images\iconeupop.png"/>
		<!-- feuilles de style -->
		<link rel="stylesheet" href="./css/bootstrap.min.css"/>
		<link rel="stylesheet" href="./css/main.css"/>
		<link rel="stylesheet" href="./css/contact.css">
		<!-- fichiers javascript -->
		<script type="application/javascript" src="./js/jquery-2.1.1.min.js"></script>
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
                	<li><a href="compte.php"><img class="imgButton" src="images/compte.png"><?php echo ' '.$_SESSION['loginUser'] ?></a></li>
                	<li><a href="panier.php"><img class="imgButton" src="images/panier.png"></a></li>
                    <li><a href="php/deco.php"><img class="imgButton" src="images/deco.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>

 <!-- fin barre de navigation -->
		<!-- contenu de la page -->	
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="well well-sm panel panel-default test">
						<form>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Prénom :</label>
										<input type="text" class="form-control" id="name" placeholder="Prénom" required="required" />
									</div>
									<div class="form-group">
										<label for="email">Adresse e-mail :</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
											<input type="email" class="form-control" id="email" placeholder="E-mail" required="required" />
										</div>
									</div>
									<div class="form-group">
										<label for="subject">Sujet</label>
										<select id="subject" name="subject" class="form-control" required="required">
											<option value="na" selected="">Objet :</option>
											<option value="service">Problème de commande</option>
											<option value="suggestions">Suggestion évolution du site</option>
											<option value="product">Autres</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Message :</label>
										<textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"placeholder="Message"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<button type="submit" class="btn pull-right" id="btnContactUs">Envoyer</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="well well-sm panel panel-default test col-md-4">
					<address>
						<strong>U'POP</strong>
						<br>
						107 rue de l'UDEV
						<br>
						63000 CLERMONT-FERRAND
						<br>
						Tél :
						<abbr title="Phone">
						(+33) 9 00 10 12 13
						</abbr>
					</address>
					<address>
						<strong>Mail-contact</strong>
						<br>
						<a href="mailto:#">upop.contact@gmail.com</a>
					</address>
				</div>
			</div>
		</div>
	
<!-- fin articles de la page -->
<!-- fin contenu de la page -->
	</body>
</html>