<?php
session_start(); // sert à maintenir la session

// fonction de hashage du password
function hashPassword($password) {
    $hash = 'sha512'; // type de hash
    $salt = 'Upop Rules'; // grain de sel pour le cryptage
    return hash_hmac($hash, $password, $salt); // retourne le password hashé
}

try
{
    if(isset($_POST['connexion'])) { // si le bouton "connexion" est appuyé
        // on vérifie que le champ "loginUser" n'est pas vide
        // empty vérifie à la fois si le champ est vide et si le champ existe
        if(empty($_POST['loginUser'])) {
            header("Location: ../index.php?erreurlogin=bad_login");
        }
        else {
            // on vérifie maintenant si le champ "passwordUser" n'est pas vide
            if(empty($_POST['passwordUser'])) {
                header("Location: ../index.php?erreurpass=bad_password");
            }
            else {
                // les champs sont bien postés et pas vides, on sécurise les données entrées par le membre:
                $loginUser = htmlentities($_POST['loginUser'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
                $passwordUser = htmlentities($_POST['passwordUser'], ENT_QUOTES, "ISO-8859-1");

                $passwordUserCrypted = hashPassword($passwordUser); // mot de passe hashé



                //on se connecte à la base de données:
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
                    header("Location: ../index.php?erreurbdd=error_bdd");
                }
                else {
                    // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent
                    $sql = "SELECT * FROM fiche_user WHERE loginUser=:loginUser AND passwordUser=:passwordUser";
                    $stmt = $bdd->prepare($sql);

                    $stmt->execute(array(
                        'loginUser' => $loginUser,
                        'passwordUser' => $passwordUserCrypted
                    ));
                    $row=$stmt->fetch();

                    // si rowCount() retourne 0 c'est qu'il a trouvé aucun résultat
                    if($stmt->rowCount() == 0) {
                        header("Location: ../index.php?erreurconnexion=error");
                    }
                    else {
                        // on ouvre la session et on remplit les variables $_SESSION
                        $_SESSION['loginUser'] = $loginUser;
                        $_SESSION['passwordUser'] = $passwordUserCrypted;
                        $_SESSION['nomUser'] = $row['nomUser'];
                        $_SESSION['prenomUser'] = $row['prenomUser'];
                        $_SESSION['genreUser'] = $row['genreUser'];
                        $_SESSION['dateNaissanceUser'] = $row['dateNaissanceUser'];
                        $_SESSION['adresseUser'] = $row['adresseUser'];
                        $_SESSION['cpUser'] = $row['cpUser'];
                        $_SESSION['villeUser'] = $row['villeUser'];
                        $_SESSION['mailUser'] = $row['mailUser'];
                        $_SESSION['typeUser'] = $row['typeUser'];
                        $_SESSION['refArticle'] = "010101";
                        header("Location: ../Accueil.php"); // Redirection du navigateur
                        exit;
                    }
                }
            }
        }
    }
}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}

$bdd = null;
?>
