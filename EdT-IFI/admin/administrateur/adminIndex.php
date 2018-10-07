<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
?>
<html>
<head>
<title>Emploi du Temps & Agenda en ligne</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<frameset rows="80,*" frameborder="NO" border="0" framespacing="0"> 
  <frame name="topFrame" scrolling="NO" noresize src="adminHeader.php" >
  <frameset cols="138,854*" frameborder="NO" border="0" framespacing="0" rows="*"> 
    <frame name="leftFrame" scrolling="NO" noresize src="adminMenu.php">
    <frame name="mainFrame" src="adminAccueil.php">
  </frameset>
</frameset>
<noframes><body bgcolor="#FFFFFF">

This browser does not support frame.

</body></noframes>
</html>
