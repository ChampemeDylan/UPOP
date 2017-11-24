<?php
session_start();

require "./php/verifConnexion.php";
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
<!-- fin barre de navigation -->

<!-- contenu de la page -->

		<div class="container marginTopPage">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Panier</h3>
						</div>

							<div class="panel-body">

								<div class="col-xs-12 col-sm-12 col-md-12">

									<div class="row fond">

										<div class="col-xs-6 col-sm-4 col-md-1">
											<img id="ImgPerso" src="./images/got1.jpg" alt="" />
										</div>



											<div class="col-xs-6 col-sm-4 col-md-3">
												<p id="personnage">Khalissi</p>
												<p id="refArticle">Ref</p>
											</div>


												<div class="col-xs-4 col-sm-4 col-md-4">
															<p>Prix<b id="prixArticle"></b></p>
															<p>Quantité<select name="" id="">Qauntité
																			<option value="valeur récuperée à l'ajout">1</option>
																			<option value="">2</option>
																			<option value="">3</option>
																			<option value="">4</option>
																			<option value="">5</option>
																			<option value="">6</option>
																			<option value="">7</option>
																			<option value="">8</option>
																			<option value="">9</option>
																			<option value="">10</option>
																		</select>
															</p>


												</div>
									</div><br />

									<div class="col-xs-12 col-sm-12 col-md-12 text-right">
										<input type="button" value="Commander" class="btn" />
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
