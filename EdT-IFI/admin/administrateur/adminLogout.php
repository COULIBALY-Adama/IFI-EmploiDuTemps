<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	unset($_SESSION["UserID"]);
	unset($_SESSION["UserRights"]);
	header("Location: ../index.php", "target=_parent");
?>
