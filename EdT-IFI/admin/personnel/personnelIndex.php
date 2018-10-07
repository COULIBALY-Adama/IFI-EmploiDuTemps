<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(2, "../index.php");
?>
<html>
<head>
<title>Emploi du Temps & Agenda en ligne</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<frameset rows="80,*" frameborder="NO" border="0" framespacing="0"> 
  <frame name="topFrame" scrolling="NO" noresize src="personnelHeader.php" >
  <frameset cols="138,854*" frameborder="NO" border="0" framespacing="0" rows="*"> 
    <frame name="leftFrame" scrolling="NO" noresize src="personnelMenu.php">
    <frame name="mainFrame" src="personnelAccueil.php">
  </frameset>
</frameset>
<noframes><body bgcolor="#FFFFFF">
Trình duyệt này Không hỗ trợ FRAME.
</body></noframes>
</html>
