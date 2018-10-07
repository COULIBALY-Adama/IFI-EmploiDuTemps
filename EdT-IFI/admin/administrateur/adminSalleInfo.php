<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");

	$salleID = get_param("SalleID");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$error = "";
	$fldNomDeSalle;
	$fldDescriptionDeSalle;
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
<title>Rapport sur Professeur</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="POST" action="adminSalleInfo.php" name="form1">
  <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr bgcolor="#000066"> 
      <td height="32" colspan="3"> 
        <div align="center"><b><font color="#FFFFFF">Description De Salle</font></b></div>
      </td>
    </tr>
    <tr> 
      <td height="29">&nbsp;</td>
      <td height="29" width="64%">&nbsp;</td>
    </tr>

<?php  // Error when input
	if (strlen($error)) {
?>
    <tr> 
      <td height="29" colspan="3">
        <div align="center">
          <p><b><font size="2" color="#FF0000"><?php echo  $error?></font></b></p>
        </div>
      </td>
    </tr>
<?php } 
?>
    <tr> 
      <td height="29">&nbsp;</td>
      <td height="29" width="64%">&nbsp;</td>
    </tr>
    <tr> 
      <td height="30"> 
        <div align="right">Nom*: </div>
      </td>
      <td height="30" width="64%"> <font color="#FFFF00"><b>&nbsp; 
        <input type="text" name="nomDeSalle" size="50" maxlength="50"
					value="<?php echo  tohtml($fldNomDeSalle) ?>">
        </b></font></td>
    </tr>
    <tr> 
      <td height="27"> 
        <div align="right">Description: </div>
      </td>
      <td height="27" width="64%"> <font color="#FFFF00"> &nbsp; 
        <textarea name="descriptionDeSalle" cols="45" rows="5"
				><?php echo  $fldDescriptionDeSalle ?></textarea>
        </font></td>
    </tr>
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td height="45"> 
        <div align="center">
	  	  <input type="hidden" name="FormType" value="<?php echo  $formType?>"> 
		  <input type="hidden" name="FormAction" value="update"> 
		  <input type="hidden" name="FormName" value="form1">
		  <input type="hidden" name="SalleID" value="<?php echo  $salleID ?>">
<?php if (strtolower($formType) == "ajouter") { ?>
		  <input type="submit" value="Ajouter"
		  onclick="document.form1.FormAction.value = 'Ajouter';">
<?php } 
   else { ?>
		  <input type="submit" value="Enregistrer"
		  onclick="document.form1.FormAction.value = 'enregistrer';">
<?php } ?>
          <input type="submit" value="Annuler" 
		  onclick="document.form1.FormAction.value = 'annuler';">
        </div>
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
</table>
<p>&nbsp;</p></body>
</html>

<?php
function form1_Action($action) {
	global $db;
	global $salleID;
	global $fldNomDeSalle;
	global $fldDescriptionDeSalle;
	global $error;
	switch (strtolower($action)) {
		case "ajouter":
			test_error();
			if(strlen($error)) return;
			$sSQL = "INSERT INTO Salle (" .
						"nom_de_salle, " . 
						"description_de_salle) " . 
					"VALUES (" .
						tosql($fldNomDeSalle, "Text") . "," . 
						tosql($fldDescriptionDeSalle, "Text") . ")";
			$db->query($sSQL);
			header("Location: adminListeSalle.php");
			break;
		case "enregistrer":
			test_error();
			if(strlen($error)) return;
			$sWhere = "salle_id=" . tosql($salleID, "Number");
			$sSQL = "update Salle set " .
				  "nom_de_salle =" . tosql($fldNomDeSalle, "Text") .
				  ", description_de_salle=" . tosql($fldDescriptionDeSalle, "Text");
			$sSQL .= " WHERE " . $sWhere;
			$db->query($sSQL);
			header("Location: adminListeSalle.php");
			break;
		case "annuler":
			header("Location: adminListeSalle.php");
			return;
	}
}

function form1_get_info($action) {
	global $db;
	global $salleID;
	global $fldNomDeSalle;
	global $fldDescriptionDeSalle;

	if (strtolower($action) == "ajouter" || strtolower($action) == "enregistrer") {
		$fldNomDeSalle = strip(get_param("nomDeSalle"));
		$fldDescriptionDeSalle = strip(get_param("descriptionDeSalle"));
	}
	else {
		$sWhere .= "salle_id=" . tosql($salleID, "Number");
		$sSQL = "SELECT * FROM Salle WHERE " . $sWhere;
		$db->query($sSQL);
		$db->next_record();
		$fldNomDeSalle = $db->f("nom_de_salle");
		$fldDescriptionDeSalle = $db->f("description_de_salle");
	}
}

function test_error() {
	global $error;
	global $formAction;
	global $fldNomDeSalle;
	global $salleID;
	
	if ($formAction=="ajouter") {	
		$sSQL = "SELECT * FROM Salle WHERE salle_id=" . tosql($salleID,"Text");
		$db->query($sSQL);
		if ($db->next_record()) 
			$error = $error . "Salle [ID=".$salleID."] existe déjà, choisir un autre ID.<br>" ;
	}

	if (strtolower($formAction) != "annuler" && !strlen($fldNomDeSalle))
	{
		$error = $error . "Il faut donner un nom de la salle à la case 'Nom'.<br>" ;
	}
}
?>

