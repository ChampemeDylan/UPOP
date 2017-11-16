<?php include("graphic.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!--PARTIE CALENDAR-->
<!--PARTIE CALENDAR-->

<title>Bright Side of Life</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>
<body>


   <?php
   //affichage de l'image en détail
$val=$_GET["kpi"];
$user="root";
$password="";
$database="base_mme";


function extraction_db($nom_kpi, $jdebut, $jfin, $tdebut, $tfin) {/*la fonction qui permet d'extraire des données de la base de donnée*/
	$mysqli = new mysqli('localhost', 'root', '', 'base_mme') or die( "Unable to select database");// connecté a la base 

	$donnees = ARRAY();
	
	$query="select Time, DATE, $nom_kpi from mme_table where (Time between \"$tdebut\" and \"$tfin\") and (DATE between \"$jdebut\" and \"$jfin\")";
	$result=mysqli_query($mysqli, $query) or die (mysqli_error($mysqli));
	 $res = mysqli_fetch_all($result,MYSQLI_ASSOC);
	//var_dump ($res);
	
	// Free result set
	mysqli_free_result($result);
	mysqli_close($mysqli);// fermer la base 
	return $res;
}; 

function extraction_db1($nom_kpi) {/*la fonction qui indique que ya pas de données dans la base*/
  
  $mysqli = new mysqli('localhost', 'root', '', 'base_mme') or die( "Unable to select database");// connecté a la base 

  $donnees = ARRAY();
  
  $query="select time, $nom_kpi from mme_table";
  
  $result=mysqli_query($mysqli, $query) or die (mysqli_error($mysqli));
  
   $res = mysqli_fetch_all($result,MYSQLI_ASSOC);

  //var_dump ($res);
  // Free result set
  mysqli_free_result($result);
  mysqli_close($mysqli);// fermer la base 
  return $res;
};

//extraction_db("KPI1_MME_AttachFailureRatio");

$tableau_time=ARRAY();
$tableau_kpe=ARRAY();

if(!empty($_POST['choix']))
{
  echo 'Les valeurs des cases cochées sont :<br />';

 var_dump ($_POST['choix']);
  
  foreach($_POST['choix'] as $val)
  {
  $tableau_time=ARRAY();
  $tableau_kpe=ARRAY();
    echo "*********************************";

  echo "traitement kpi:" .$val.'<br />';
	if ((isset ($_GET['jdebut'])) && (isset($_GET['jfin'])) && (isset ($_GET['tdebut'])) && (isset($_GET['tfin'])) )
    $donnees= extraction_db($val, $_GET['jdebut'], $_GET['$jfin'],$_GET['tdebut'], $_GET['$tfin']);
	else $donnees= extraction_db1($val);

    foreach ($donnees as $ligne) {
      array_push($tableau_time, $ligne["time"]);
      array_push($tableau_kpe, $ligne["$val"]);
    } 
   //var_dump ($tableau_time);
    //var_dump ($tableau_kpe);
    
    dessiner($val,$tableau_time, $tableau_kpe);
  
  //echo '<img src="img/'.$val.'.png" />'; 

  echo '<a href img src="img/'.$val.'.png" />'; 
///////<a href="afficher3.php"><img src="img/'.$val.'.png"></a> ;

//echo'<input type="image" name="imgbtn" src="img/'.$val.'.png"  alt="Tool Tip">';

echo'<a href="afficher3_test.php?kpi='. $val.'"> <img src="img/'.$val.'.png" border = "0"> </a>';
echo'<img src="img/'.$val.'.png" border = "0">';/*l'image qui s'affiche sur la page afficher3.php*/

  }
  
  echo '<br />';
}


   //fin image

//if (isset($jfin)) {
//extraction

//}

echo'<img src="img/'.$val.'.png" border = "0">';/*l'image qui s'affiche sur la page afficher3.php*/

echo '<FORM action="afficher3_test.php?kpi='.$val.'method="GET">';
echo '<INPUT type="hidden" name="kpi" value='.$val.'>';
?>

<!-- temps:<br> De <INPUT type="text" name="tdebut"> à
<INPUT type="text" name="tfin"><br>
<br> -->
<!-- jours:<br> De <INPUT type="text" class="calendrier" name="jdebut"> à
<INPUT type="text" name="jfin" class="calendrier"> -->


      temps:<br> De <INPUT type="text" name="tdebut"> à
<INPUT type="text" name="tfin"><br>

<br>
<br>
<input type="date" name="jdebut" value="" /> et <input type="date" name="jfin" value="" />  
<INPUT type="submit" value="envoyer"><br>

</FORM>
</BLOCKQUOTE>
    <div id="rightbar">
      <!-- <h1>LES KPI<span class="gray"></span> </h1>
 -->
   
      <h1></h1>
    </div>
  </div>
  <div id="footer">
    <div class="footer-left">
      <p class="align-left"> &copy; 2016 <strong>Algerie Télécom</strong> | Design by <a href="http://www.styleshout.com/">Etudiantes</a>  </p>
    </div>
    <div class="footer-right">
      <p class="align-right"> <a href="#">Home</a>&nbsp;|&nbsp; <a href="https://www.algerietelecom.dz/siteweb.php">SiteMap</a>&nbsp; </p>
    </div>
  </div>
</div>
</body>
</html>
