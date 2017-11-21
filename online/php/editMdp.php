<?php
//session_start();

$loginUser = $_SESSION['loginUser'];
$passwordUser = htmlentities($_POST['passwordUser'], ENT_QUOTES, "ISO-8859-1");
$passwordUser2 = htmlentities($_POST['passwordUser2'], ENT_QUOTES, "ISO-8859-1");

try
{
	// connexion à MySQL avec l'adresse du serveur, l'identifiant et le mot de passe
	$bdd = new PDO('mysql:host=localhost;dbname=uPop;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
    // update des données dans notre table
    if ($passwordUser2===$passwordUser)
	{
        $sql = "UPDATE fiche_user SET passwordUser= :passwordUser WHERE loginUser= :loginUser";

        $stmt = $bdd->prepare($sql);

        $stmt->execute(array(
            'passwordUser' => $passwordUser,
            'loginUser' => $loginUser
        ));

        //mise à jour des variables de session
        $_SESSION['passwordUser'] = $passwordUser;
    }
    else
    {
        echo '<body onLoad="alert(\'Désolé les mots de passe ne sont pas identiques\')">';//"Le loginUser ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
        echo '<meta http-equiv="refresh" content="0;URL=../Compte.php">';
    }
}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}

$bdd = null;
?>