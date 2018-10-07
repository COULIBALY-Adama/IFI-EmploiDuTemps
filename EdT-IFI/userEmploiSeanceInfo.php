<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();

	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$emploiID = get_param("EmploiID");
	$horaireID = get_param("HoraireID");
	$jourID = get_param("JourID");
	$semaineselected=get_param("SemaineSelected");

	// chercher nom de l'emploi du temps
	$sSQL = "SELECT nom_de_lemploi FROM Emploi WHERE emploi_id=" . tosql($emploiID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploiDuTemps = $db->f("nom_de_lemploi");

	$fldNomDeSalle;
	$fldNomDeCours;
	$fldSalleID;
	$fldCoursID;
	$error = "";

	form1_get_info($formAction);
	switch (strtolower($formName)) {
		case "form1":
			form1_Action($formAction);
			break;
	}
?>

<html>
<head>
<title>Infomation de Seance</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="POST" action="userEmploiSeanceInfo.php" name="form1">
  <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">

    <tr>
      <td colspan="7" height="32" bgcolor="#000000"> 
        <div align="center"><b><font color="#00FF00"><?php echo $fldNomDeLEmploiDuTemps?></font></b></div>
      </td>
    </tr>

    <tr bgcolor="#000066"> 
      <td height="32" colspan="3"> 
        <div align="center"><b><font color="#FFFFFF">Description de Seance</font></b></div>
      </td>
    </tr>
    <?php if (strlen($error)) { ?>
    <tr> 
      <td height="29" colspan="3"> 
        <div align="center"><b><font size="2" color="#FF0000"> 
          <?php echo  $error ?>
          </font></b></div>
      </td>
    </tr>
    <?php } else { ?>
    <tr> 
      <td height="29" width="33%">&nbsp;</td>
      <td height="29" width="67%">&nbsp;</td>
    </tr>
    <?php } ?>
    <tr> 
      <td height="30" width="33%"> 
        <div align="right"><font color="#000000"><b>Cours:</b></font></div>
      </td>
      <td height="30" width="67%"> <font color="#000000"><b>&nbsp;&nbsp;<?php echo  $fldNomDeCours ?> 
        </b></font></td>
    </tr>
    <tr> 
      <td height="27" width="33%"> 
        <div align="right"><b>Lieu:</b></div>
      </td>
      <td height="27" width="67%"> &nbsp;<font color="#000000"><b>&nbsp;<?php echo  $fldNomDeSalle ?> 
        </b></font></td>
    </tr>
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="29" width="33%">&nbsp;</td>
      <td height="29" width="67%">&nbsp;</td>
    </tr>
    <tr> 
      <td height="45" width="33%"> 
        <div align="left"> </div>
      </td>
      <td height="45" width="67%"> 
        <input type="hidden" name="EmploiID" value="<?php echo  $emploiID ?>">
		<input type="hidden" name="HoraireID" value="<?php echo  $horaireID ?>">
		<input type="hidden" name="JourID" value="<?php echo  $jourID ?>">
		<input type="hidden" name="SemaineSelected" value="<?php echo  $semaineselected ?>">
		<input type="hidden" name="FormAction" value="<?php echo  $formAction ?>">
		<input type="hidden" name="FormName" value="form1">
		<input type="hidden" name="FormType" value="<?php echo  $formType ?>">
        <input type="submit" value="Retourner" 
		  onclick="document.form1.FormAction.value = 'retourner';">
      </td>
    </tr>
  </table>
  <div align="left"></div>
  <p>&nbsp;</p>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
</table>
<p>&nbsp;</p></body>
</html>

<?php
function form1_get_info($action) {
	global $db;
	global $fldSalleID;
	global $fldCoursID;
	global $fldNomDeSalle;
	global $fldNomDeCours;
	global $formType;
	global $emploiID;
	global $jourID;
	global $horaireID;

	$sSQL = "SELECT * FROM Emploi_jour WHERE " .
			" emploi_id=" . tosql($emploiID, "Text") .
			" AND jour_id=" . tosql($jourID, "Number") .
			" AND horaire_id=" . tosql($horaireID, "Number");
	$db->query($sSQL);
	if (!$db->next_record()) {
		$formType="ajouter";
		// get salle par defaut
		$sSQL = "SELECT * FROM Emploi WHERE " .
				" emploi_id=" . tosql($emploiID, "Text");
		$db->query($sSQL);
		$db->next_record();
		$fldSalleID = $db->f("salle_id");
		$fldCoursID = "";
	}
	else {
		$fldSalleID = $db->f("salle_id");
		$fldCoursID = $db->f("cours_id");
	}
	$sSQL = "SELECT * FROM Cours WHERE cours_id=" . tosql($fldCoursID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeCours = $db->f("nom_de_cours");

	$sSQL = "SELECT * FROM Salle WHERE salle_id=" . tosql($fldSalleID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeSalle = $db->f("nom_de_salle");
}

function form1_Action($action) {
	global $db;
	global $error;
	global $formType;
	global $fldCoursID;
	global $fldSalleID;
	global $emploiID;
	global $horaireID;
	global $jourID;
	global $semaineselected;

	switch (strtolower($action)) {
		case "retourner":
			header("Location: userEmploi2.php?EmploiID=" . 
			$emploiID . "&SemaineSelected=" . $semaineselected);
			break;
	}
}

?>
