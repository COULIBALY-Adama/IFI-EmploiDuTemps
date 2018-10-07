<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$emploiID = get_param("EmploiID");
	$etatselected = get_param("EtatSelected");

	// chercher nom de l'emploi du temps
	$sSQL = "SELECT nom_de_lemploi, etat FROM Emploi WHERE emploi_id=" . tosql($emploiID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploiDuTemps = $db->f("nom_de_lemploi");
	$fldEtat = $db->f("etat");

	switch (strtolower($formName)) {
		case "form1":
			form1_Action($formAction);
			break;
	}
?>
<html>
<head>
<title>Confirmation de suppression d'un Emploi du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#CCFFFF" text="#000000">
<form name="form1" method="post" action="adminEmploiSuppression.php">
  <p align="center">&nbsp;</p>
    <input type="hidden" name="FormType" value="<?php echo  $formType?>">
    <input type="hidden" name="FormName" value="form1">
    <input type="hidden" name="FormAction" value="non">
    <input type="hidden" name="EtatSelected" value="<?php echo $etatselected?>">
    <input type="hidden" name="EmploiID" value="<?php echo  $emploiID?>">
  <?php if ($fldEtat=="inactif") { ?>
  <p align="center"><b><font color="#FF0000" size="5">Est-ce que vous &ecirc;tes 
    sur de vouloir supprimer</font></b></p>
  <p align="center"><font color="#FF0000" size="5"><b> <font color="#000000">&quot;<?php echo $fldNomDeLEmploiDuTemps?>&quot;</font></b></font></p>
  <p align="center">&nbsp;</p>
  <p align="center"> 
    <input type="submit" name="submit" value="      Oui       " onclick="document.form1.FormAction.value = 'supprimer' ;">
    <input type="submit" name="submit" value="      Non      " onclick="document.form1.FormAction.value = 'annuler' ;">
  </p>
  <?php } else { ?>
  <p align="center">&nbsp;</p>
  <p align="center"><b><font color="#FF0000" size="5">D&eacute;sol&eacute;! Vous 
    NE pouvez supprimer QU'un emploi du temps INACTIF!</font></b></p>
  <p align="center">&nbsp;</p>
  <p align="center">
    <input type="submit" name="submit" value="  Retourner  " onclick="document.form1.FormAction.value = 'annuler' ;">
  </p>
  <?php } ?>
  </form>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp; </p>
</body>
</html>

<?php
function form1_Action($action) {
	global $db;
	global $emploiID;
	global $etatselected;
	global $fldEtat;

	switch (strtolower($action)) {
		case "supprimer":
			$sWhere = "emploi_id=" . tosql($emploiID, "Text");
			$sSQL = "DELETE FROM Emploi WHERE " . $sWhere;
			$db->query($sSQL);
			$sSQL = "DELETE FROM Emploi_cours WHERE " . $sWhere;
			$db->query($sSQL);
			$sSQL = "DELETE FROM Emploi_jour WHERE " . $sWhere;
			$db->query($sSQL);
			$sSQL = "DELETE FROM Emploi_horaire WHERE " . $sWhere;
			$db->query($sSQL);
			$sSQL = "DELETE FROM Emploi_cours_professeur WHERE " . $sWhere;
			$db->query($sSQL);
			header("Location: adminListeEmploi.php?EtatSelected=" . $etatselected);
			break;
		case "annuler":
			header("Location: adminListeEmploi.php?EtatSelected=" . $etatselected);
			return;
	}
}

?>
