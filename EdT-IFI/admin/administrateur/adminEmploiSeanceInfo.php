<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");

	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$emploiID = get_param("EmploiID");
	$horaireID = get_param("HoraireID");
	$jourID = get_param("JourID");
	$semaineselected=get_param("SemaineSelected");
	$retPage=get_param("RetPage");

	// chercher nom de l'emploi du temps
	$sSQL = "SELECT nom_de_lemploi FROM Emploi WHERE emploi_id=" . tosql($emploiID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploiDuTemps = $db->f("nom_de_lemploi");

	$fldSalleID;
	$fldCoursID;
	$error = "";
	form1_get_info($formAction);
	switch (strtolower($formName)) {
		case "form1":
			form1_Action($formAction);
			break;
		case "form2":
			// réservé
			break;
	}
?>

<html>
<head>
<title>Infomation de Seance</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="POST" action="adminEmploiSeanceInfo.php" name="form1">
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
        <div align="right"><font color="#000000"><b>Cours: </b></font></div>
      </td>
      <td height="30" width="67%"> <font color="#FFFF00"><b>&nbsp; 
        <select name="ListeCours">
		<OPTION value="NULL">&nbsp;Cliquer pour choisir</OPTION>
<?php
			$sSQL = "SELECT EC.cours_id, C.nom_de_cours " .
					"FROM Emploi_cours as EC LEFT JOIN Cours as C " . 
					"ON C.cours_id=EC.cours_id WHERE EC.emploi_id=" . tosql($emploiID, "Text");
			$db->query($sSQL);
			$nextRecord = $db->next_record();
			while ($nextRecord) {
				$nomdecours = $db->f("nom_de_cours");
				$coursid = $db->f("cours_id");
				echo "<OPTION value=\"" . $coursid . "\"";
				if ($fldCoursID==$coursid) echo " SELECTED";
				echo ">" . $nomdecours .  "</OPTION> <br>";
				$nextRecord = $db->next_record();
			}
?>
        </select>
        </b></font></td>
    </tr>
    <tr> 
      <td height="27" width="33%"> 
        <div align="right"><b>Lieu: </b></div>
      </td>
      <td height="27" width="67%"> &nbsp;<font color="#FFFF00"><b> 
        <select name="ListeSalle">
		<OPTION value="NULL">&nbsp;Cliquer pour choisir</OPTION>
<?php
			$sSQL = "SELECT * FROM Salle";
			$db->query($sSQL);
			$nextRecord = $db->next_record();
			while ($nextRecord) {
				$Nom_De_Salle = $db->f("nom_de_salle");
				$Salle_ID = $db->f("salle_id");
				echo "<OPTION value=\"" . $Salle_ID . "\"";
				if ($fldSalleID==$Salle_ID) echo " SELECTED";
				echo ">" . $Nom_De_Salle .  "</OPTION> <br>";
				$nextRecord = $db->next_record();
			}
?>
        </select>
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
		<input type="hidden" name="RetPage" value="<?php echo  $retPage?>">
        <input type="hidden" name="EmploiID" value="<?php echo  $emploiID ?>">
		<input type="hidden" name="HoraireID" value="<?php echo  $horaireID ?>">
		<input type="hidden" name="JourID" value="<?php echo  $jourID ?>">
		<input type="hidden" name="SemaineSelected" value="<?php echo  $semaineselected ?>">
		<input type="hidden" name="FormAction" value="<?php echo  $formAction ?>">
		<input type="hidden" name="FormName" value="form1">
		<input type="hidden" name="FormType" value="<?php echo  $formType ?>">
        <input type="submit" value="Enregistrer"
		  onclick="document.form1.FormAction.value = 'enregistrer';">
        <input type="submit" value="Annuler" 
		  onclick="document.form1.FormAction.value = 'annuler';">
        <input type="submit" value="Vider" 
		  onclick="document.form1.FormAction.value = 'vider';">
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
	global $formType;
	global $emploiID;
	global $jourID;
	global $horaireID;

	if ((strtolower($action) == "ajouter") || 
		(strtolower($action) == "enregistrer")) {
		$fldSalleID = get_param("ListeSalle");
		$fldCoursID = get_param("ListeCours");
	}
	else {
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
	}
}

function test_error() {
	global $error;
	global $formAction;
	global $fldCoursID;
	global $fldSalleID;
	if ($fldCoursID=="NULL")
		$error = $error . "Il faut choisir un cours.<br>" ;
	if ($fldSalleID=="NULL")
		$error = $error . "Il faut choisir une salle.<br>" ;
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
	global $retPage;

	$sSQLadd = "INSERT INTO Emploi_jour (" .
			"emploi_id, " . 
			"cours_id, " . 
			"salle_id, " . 
			"horaire_id, " . 
			"jour_id) " . 
		"VALUES (" .
			tosql($emploiID, "Text") . "," . 
			tosql($fldCoursID, "Text") . "," . 
			tosql($fldSalleID, "Number") . "," . 
			tosql($horaireID, "Number") . "," . 
			tosql($jourID, "Number") .")";
	$sWhere = "emploi_id=" . tosql($emploiID, "Text");
	$sWhere .= " AND jour_id=" . tosql($jourID, "Number");
	$sWhere .= " AND horaire_id=" . tosql($horaireID, "Number");
	$sSQLupdate = "UPDATE Emploi_jour SET " .
		"cours_id=" . tosql($fldCoursID, "Text") . "," .
		"salle_id=" . tosql($fldSalleID, "Number");
	$sSQLupdate = $sSQLupdate .	" WHERE " . $sWhere;

	switch (strtolower($action)) {
		case "enregistrer":
			test_error();
			if(strlen($error)) return;
			if ($formType=="ajouter")
				$db->query($sSQLadd);
			else
				$db->query($sSQLupdate);
			header("Location: " . $retPage . "?EmploiID=" . $emploiID . "&SemaineSelected=" . $semaineselected);
			break;
		case "annuler":
			header("Location: " . $retPage . "?EmploiID=" . 
			$emploiID . "&SemaineSelected=" . $semaineselected);
			break;
		case "vider":
			$sWhere = "emploi_id=" . tosql($emploiID, "Text");
			$sWhere .= " AND jour_id=" . tosql($jourID, "Number");
			$sWhere .= " AND horaire_id=" . tosql($horaireID, "Number");
			$sSQLdelete = "DELETE FROM Emploi_jour WHERE " . $sWhere;
			$db->query($sSQLdelete);
			header("Location: " . $retPage . "?EmploiID=" . 
			$emploiID . "&SemaineSelected=" . $semaineselected);
			break;
	}
}

?>
