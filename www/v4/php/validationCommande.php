<?php
session_start();

//Récupération des vriables du formulaire :
                $mailUser  = $_SESSION['mailUser'];
                $loginUser = $_SESSION['loginUser'];
                $numCommande = $_SESSION['numCommande'];

                 
// Mail :
                $objet =    'Confirmation de votre commande UPop';
                $contenu =  '<html>
                                <head>
                                    <div>
                                        <span>
                                            <img src="http://upop.champemedylan.fr/images/iconeupop.png" style="width: 140px;"></img>
                                        </span>
                                    </div>
                                    
                                    <hr>
                                </head>
                                    <body>
                                        <p style="font-size: 22px;">    Bonjour '.$loginUser.',
                                            Votre commande N°'.$numCommande.' a bien été prise en compte.
                                            Merci de votre confiance et à bientôt sur Upop.
                                        </p><br>
                                        <p style="font-size: 22px;">
                                            Cordialement l\'équipe U\'pop
                                        </p>
                                            <hr>
                                        <p style="font-size: 12px;">
                                            © 2017 Copyright: U\'Pop -- Ce site est un projet étudiant et non un site de vente
                                        </p>

                                    </body>
                            </html>';

//Configuration :
                            
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'From:'.$loginUser.' <'.$mailUser.'>' . "\r\n" .
                            'Reply-To:'.$mailUser. "\r\n" .
                            'Content-Type: text/html; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
                            'Content-Disposition: inline'. "\r\n" .
                            'Content-Transfer-Encoding: 8bit'." \r\n" .
                            'X-Mailer:PHP/'.phpversion();

	 //on se connecte à la base de données:
try
{
    //on se connecte à la base de données
    // en local
    $bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');

    //en online
    //$bdd = new PDO('mysql:host=db708219960.db.1and1.com;dbname=db708219960', 'dbo708219960', 'dbo708219960');
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
    $sql = "UPDATE commande SET etatCommande='Validée' WHERE numeroCommande=:numeroCommande";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(
        'numeroCommande' => $_SESSION['numCommande']
      ));

    mail($mailUser, $objet, $contenu, $headers);

}
?>
