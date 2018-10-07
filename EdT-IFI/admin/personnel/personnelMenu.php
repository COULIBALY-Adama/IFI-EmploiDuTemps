<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(1, "../index.php");
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#99CCFF">
<p><b><font size="4"><a href="personnelAccueil.php" target="mainFrame">Page d'Accueil 
  </a></font></b></p>
<p><font size="4"><b><a href="personnelChangeMotDePasse.php" target="mainFrame">Change 
  Mot de Passe</a></b></font></p>
<p><b><font size="4"><a href="personnelReunion.php" target="mainFrame">Reunion</a></font></b></p>
<p><b><font size="4"><a href="personnelAgendaJour.php" target="mainFrame">Agenda 
  personnel</a></font></b></p>
<p><b><font size="4"><a href="personnelEmploi1.php" target="mainFrame">Emploi 
  du Temps</a></font></b></p>
</body>
</html>
