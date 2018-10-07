<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#00CC99">
<p><b><font size="3" color="#FFFFFF"><a href="adminAccueil.php" target="mainFrame"><font color="#0033CC">Page 
  d'Accueil</font></a></font></b></p>
<!-- <p><font size="3" color="#0033CC"><b><a href="adminListeProfesseur.php" target="mainFrame">Personnels</a></b></font></p> //Quang commented--> 
<p><font size="3" color="#0033CC"><b><a href="adminListeCours.php" target="mainFrame">Cours</a></b></font></p>
<p><font size="3" color="#0033CC"><b><a href="adminListeSalle.php" target="mainFrame">Locaux</a></b></font></p>
<p><font color="#0033CC"><b><font size="3"><a href="adminListeEmploi.php" target="mainFrame">Emploi 
  du Temps</a></font></b></font></p>
<p><font color="#0033CC"><b><font size="3"><a href="adminChangerMotDePasse.php" target="mainFrame">Changer 
  Mot de Passe</a></font></b></font></p>
</body>
</html>
