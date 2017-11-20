<?php
session_start(); // sert à maintenir la $_SESSION
if(isset($_POST['connexion'])) { // si le bouton "Connexion" est appuyé
    // on vérifie que le champ "loginUser" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe
    if(empty($_POST['loginUser'])) {
        header("Location: ../index.php?erreurlogin=bad_login");
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide
        if(empty($_POST['passwordUser'])) {
            header("Location: ../index.php?erreurpass=bad_password");
        } else {
            // les champs sont bien posté et pas vide, on sécurise les données entrées par le membre:
            $loginUser = htmlentities($_POST['loginUser'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $passwordUser = htmlentities($_POST['passwordUser'], ENT_QUOTES, "ISO-8859-1");
            //on se connecte à la base de données:
            $mysqli = mysqli_connect("localhost", "root", "root", "uPop");
            //on vérifie que la connexion s'effectue correctement:
            if(!$mysqli){
                header("Location: ../index.php?erreurbdd=error_bdd");
            } else {
                // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
                $Requete = mysqli_query($mysqli,"SELECT * FROM FICHE_USER WHERE loginUser = '".$loginUser."' AND passwordUser = '".$passwordUser."'");
                // si il y a un résultat, mysqli_num_rows() nous donnera alors 1
                // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                if(mysqli_num_rows($Requete) == 0) {
                    header("Location: ../index.php?erreurconnexion=error"); // Redirection du navigateur
                } else {
                    // on ouvre la session avec $_SESSION:
                    $_SESSION['loginUser'] = $loginUser; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le loginUser
                    //echo "Vous êtes à présent connecté !";
                    $_SESSION['passwordUser'] = $passwordUser;
                    $Row = mysqli_fetch_row($Requete);
                    $_SESSION['nomUser'] = $Row[1];
                    $_SESSION['prenomUser'] = $Row[2];
                    $_SESSION['genreUser'] = $Row[3];
                    $_SESSION['dateNaissanceUser'] = $Row[4];
                    $_SESSION['adresseUser'] = $Row[6];
                    $_SESSION['cpUser'] = $Row[7];
                    $_SESSION['villeUser'] = $Row[8];
                    $_SESSION['mailUser'] = $Row[9];
                    
                    header("Location: ../Accueil.php"); // Redirection du navigateur
                    exit;
                }
            }
        }
    }
}
?>