<?php

// Ouverture de session

session_start();

require "./php/verifConnexion.php";

//	Configuration

// destinataire (si plusieur destinataire séparer avec des virgules)
$destinataire = 'upop.contact@gmail.com';

// copie envoyée à l'éxpediteur
$copie = 'oui';

$form_action = '';

// Messages de confirmation ou échec du mail
$message_envoye = "Votre messagea été bien envoyé !";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

// Message d'erreur du formulaire
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis.";

/*
 * cette fonction sert à nettoyer et enregistrer un texte
 */
function Rec($text)
{
	$text = htmlspecialchars(trim($text), ENT_QUOTES);
	if (1 === get_magic_quotes_gpc())
	{
		$text = stripslashes($text);
	}

	$text = nl2br($text);
	return $text;
};

/*
 * Cette fonction sert à vérifier la syntaxe d'un email
 */
function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}

// formulaire envoyé, on récupère tous les champs.
$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

// On  vérifie les variables et l'email ...
$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
$err_formulaire = false; // sert à remplir le formulaire en cas d'erreur si besoin

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3c.org/TR/xhtml1/DTD/xtmlhtml1-strict.dtd">
<html>
<head>


	<link rel="icon" type="image/png" href="Images\iconeupop.png"/>
	<!-- feuilles de style -->
	<link rel="stylesheet" href="./css/bootstrap.min.css"/>
	<link rel="stylesheet" href="./css/main.css"/>
	<link rel="stylesheet" href="./css/contact.css">
	<!-- fichiers javascript -->
	<script type="application/javascript" src="./js/jquery-3.2.1.min.js"></script>
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
					<li><a href="compte.php"><img class="imgButton" src="images/compte.png"><?php echo ' '.$_SESSION['loginUser']?></a></li>
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

<!-- Formulaire à envoyer -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Formulaire de contact</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo ' '.$form_action?>">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <!-- Nom -->
                                    <?php echo '<input type="text" id="nom" name="nom" value="'.htmlspecialchars($_SESSION['nomUser']).'" tabindex="1" />' ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <!-- Mail -->
                                    <input type="email" id="email" placeholder="E-mail" name="email" value="<?php echo ' '.stripslashes($email)?>" tabindex="2" />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="objet">Objet :</label><!-- Objet -->
                                    <input type="text" id="objet" name="objet" value="<?php echo ' '.stripslashes($objet)?>" tabindex="3" />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <legend>Votre message :</legend><!-- Message -->
                                    <textarea class="form-control" rows="12" id="message" name="message" ><?php echo ' '.stripslashes($message)?></textarea>
                                </div>
                            </div>
                            <span class="erreurEnvoie">
                            <?php
                                if (isset($_POST['envoi'])){
                                    if (($nom != '') && ($email != '') && ($objet != '') && ($message != '')){
                                        // Les 4 variables sont remplies, on génère puis l'envoie le mail
                                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                                        $headers .= 'From:'.$_POST["nom"].' <'.$email.'>' . "\r\n" .
                                                    'Reply-To:'.$email. "\r\n" .
                                                    'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
                                                    'Content-Disposition: inline'. "\r\n" .
                                                    'Content-Transfer-Encoding: 7bit'." \r\n" .
                                                    'X-Mailer:PHP/'.phpversion();
                                        // L'envoie d'une copie à l'éxpediteur
                                            if ($copie == 'oui')
                                            {
                                                $cible = $destinataire.';'.$email;
                                            }
                                            else
                                            {
                                                $cible = $destinataire;
                                            };
                                        // Remplacement de certains caractères spéciaux
                                        $message = str_replace("&#039;","'",$message);
                                        $message = str_replace("&#8217;","'",$message);
                                        $message = str_replace("&quot;",'"',$message);
                                        $message = str_replace('<br>','',$message);
                                        $message = str_replace('<br />','',$message);
                                        $message = str_replace("&lt;","<",$message);
                                        $message = str_replace("&gt;",">",$message);
                                        $message = str_replace("&amp;","&",$message);
                                        // Envoi du mail
                                        $num_emails = 0;
                                        $tmp = explode(';', $cible);
                                        foreach($tmp as $email_destinataire)
                                        {
                                            if (mail($email_destinataire, $objet, $message, $headers))
                                                $num_emails++;
                                        }

                                        if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1))){
                                            echo '<p>'.$message_envoye.'</p>';
                                        }else{
                                            echo '<p>'.$message_non_envoye.'</p>';
                                        };

                                    }else{
                                    // Si une des 3 variables est vide --> Erreur
                                    echo '<p>'.$message_formulaire_invalide.'</p>';
                                    $err_formulaire
                                    = true;
                                    };
                                };
                            ?>
                            </span>
                            <input type="submit" name="envoi" value="Envoyer" class="btn pull-right" id="btnContactUs">
                        </form>
                    </div>
                </div>
            </div>
<!-- Infos de contact -->
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Infos de contact</h3>
                    </div>
                    <div class="panel-body">
                        <address>
                            <strong>UPOP</strong>
                            <br>
                            107 rue de lUDEV
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
        </div>
    </div>
</body>
</html>
 