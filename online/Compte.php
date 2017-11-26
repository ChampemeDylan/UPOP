<?php
session_start();

require "./php/verifConnexion.php";
header('Content-Type: text/html; charset=utf-8');

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
		<meta http-equiv= "Content-Type" content= "text/html; charset=utf-8"/>
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
                	<li><a href="compte.php"><img class="imgButton" src="images/compte.png"><span id="login"><?php echo ' '.$_SESSION['loginUser'] ?></span></a></li>
                	<?php
                        try
                            {
                                //on se connecte à la base de données
                                // en local
                                //$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

                                //en online
                                $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
                                $bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960','dbo708219960','dbo708219960', $pdo_options);
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
                            	// VERIFICATION DU STOCK DES ARTICLES DU PANIER
                                // Récupération des ref articles du panier en cours
                                $sql = "SELECT refArticle,commande.numeroCommande FROM commande,commande_article WHERE commande.numeroCommande=commande_article.numeroCommande AND loginUser=:loginUser AND etatCommande='En cours'";
                                $stmt = $bdd->prepare($sql);
                                $stmt->execute(array(
                                    'loginUser' => $_SESSION['loginUser']
                                ));

                                while($row = $stmt->fetch()){
                                    // Vérification du stock de l'article
                                    $sql2 = "SELECT stockArticle FROM stock_article WHERE refArticle=:refArticle";
                                    $stmt2 = $bdd->prepare($sql2);
                                    $stmt2->execute(array(
                                        'refArticle' => $row['refArticle']
                                    ));
                                    $row2=$stmt2->fetch();

                                    // Dans le cas ou l'article n'a plus de stock, on le supprime de la commande en cours
                                    if ($row2['stockArticle']<=0){
                                        $sql3 = "DELETE FROM commande_article WHERE refArticle=:refArticle AND numeroCommande=:numeroCommande";
                                        $stmt3 = $bdd->prepare($sql3);
                                        $stmt3->execute(array(
                                            'refArticle' => $row['refArticle'],
                                            'numeroCommande' => $row['numeroCommande']
                                        ));
                                    }
                                };

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
										<?php echo '<input type="text" minlength="2" name="nomUser" id="nomUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['nomUser']).'">'; ?><!-- htmlspecialchars pour pouvoir récupérer la donnée pouvant contenir des caractères spéciaux -->
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Prenom -->
										<?php echo '<input type="text" minlength="2" name="prenomUser" id="prenomUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['prenomUser']).'">'; ?>
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
									<?php echo '<input type="text" minlength="2" name="adresseUser" id="adresseUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['adresseUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group"><!-- Code Postal -->
										<input type="number" minlength="5" maxlength="5" name="cpUser" id="cpUser" class="form-control input-sm" value=<?php echo $_SESSION['cpUser']; ?>><!-- number limité à 5 caractères -->
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group"><!-- Ville -->
										<?php echo '<input type="text" name="villeUser" id="villeUser" class="form-control input-sm" value="'.htmlspecialchars($_SESSION['villeUser']).'">'; ?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Mail -->
										<input type="email" minlength="2" name="mailUser" id="mailUser" class="form-control input-sm" value=<?php echo $_SESSION['mailUser']; ?>><!-- format de type email -->
									</div>
								</div>
								<div class="panel-heading">
									<h3 class="panel-title panel-title2">Changement de mot de passe</h3>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Mot de passe -->
										<input type="password" minlength="8" name="passwordUser" id="passwordUser" class="form-control input-sm" placeholder="Mot de passe"><!-- format de type password -->
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group"><!-- Confirmation Mot de passe -->
										<input type="password" minlength="8" name="passwordUser2" id="passwordUser2" class="form-control input-sm" placeholder="Confirmation Mot de passe">
										<?php if(isset($_GET['erreurpassword'])){
											echo '<div style="text-align:center;color:red;">Les 2 mots de passe ne sont pas identiques</div>';
										} else {
											if(isset($_GET['validedit'])){
												echo '<div style="text-align:center;color:green;">Mise à jour effectuée</div>';
											} else {
												echo '<br>';
											}
										}
										?>
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
							<?php
								try
								{
									//on se connecte à la base de données
									// en local
									//$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

									//en online
									$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
									$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960','dbo708219960','dbo708219960', $pdo_options);
								}
								catch (Exception $e)
								{
								die('<br />Erreur : ' . $e->getMessage());
								}
								$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								// récupération des commandes de l'utilisateur connecté
								$sql = "SELECT * FROM commande WHERE loginUser=:loginUser ORDER BY dateCommande DESC";
								$stmt = $bdd->prepare($sql);
								$stmt->execute(array(
								    'loginUser' => $_SESSION['loginUser']
								));
								// On affiche chaque entrée une à une qu'on récupère dans le conteneur $reponse
								while ($donnees = $stmt->fetch())
								{
									// récupération de la liste des articles de la commande pour calcul du montant total
									$sql2 = "SELECT * FROM commande_article,fiche_article WHERE fiche_article.refArticle=commande_article.refArticle AND numeroCommande=:numeroCommande";
									$stmt2 = $bdd->prepare($sql2);
									$stmt2->execute(array(
										'numeroCommande' => $donnees['numeroCommande']
									));
									$montantTotal = '';
									while($donnees2 = $stmt2->fetch())
									{
										$montantTotal = $montantTotal + ($donnees2['prixArticle']*$donnees2['quantiteArticle']);
									}
									$stmt2->closeCursor();
							?>
							<tbody>
								<tr>
									<td><?php echo $donnees['numeroCommande'] ?></td>
									<td><?php echo $donnees['dateCommande'] ?></td>
									<td><?php echo $montantTotal ?> €</td>
									<td><?php echo htmlspecialchars($donnees['etatCommande']) ?></td>
								</tr>
							</tbody>
							<?php
								}
								$stmt->closeCursor(); // Termine le traitement de la requête
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
