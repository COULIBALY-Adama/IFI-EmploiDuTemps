<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");

	$coursID = get_param("CoursID");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$error = "";
	$fldCoursID = $coursID;
	$fldNomDeCours;
	$fldNombreDHeures;
	$fldPlanDeCours;
	$fldDescriptionDeCours;
	form1_get_info($formAction);
//printf("Debug: adminCoursInfo, formeType: %s, formeAction:%s\n", $formType, $formAction);  // Quang added
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
<form method="POST" action="adminCoursInfo.php" name="form1">
  <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr bgcolor="#000066"> 
      <td height="32" colspan="3"> 
        <div align="center"><b><font color="#FFFFFF">Description du Cours</font></b></div>
      </td>
    </tr>
<?php if (strlen($error)) { ?>
    <tr> 
      <td height="29" colspan="3">
        <div align="center"><b><font size="2" color="#FF0000"><?php echo  $error ?></font></b></div>
      </td>
    </tr>
<?php } else { ?>
    <tr> 
      <td height="29">&nbsp;</td>
      <td height="29">&nbsp;</td>
    </tr>
<?php } ?>
    <tr> 
      <td height="29"> 
        <div align="right">ID: </div>
      </td>
      <td height="29"><font color="#FFFF00"><b> &nbsp; 
<?php if ($formType=="ajouter") { ?>
        <input type="text" name="coursIDinput" size="10" maxlength="10" value="<?php echo  $fldCoursID?>">
<?php } else { ?>
	<font color="#000000"> <?php echo  $fldCoursID?> </font>
        <input type="hidden" name="coursIDinput" size="10" maxlength="10" value="<?php echo  $fldCoursID?>">
<?php } ?>
        </b></font> </td>
    </tr>
    <tr> 
      <td height="30"> 
        <div align="right"><font color="#000000"><b>Nom abrege: </b></font></div>
      </td>
      <td height="30"> <font color="#FFFF00"><b>&nbsp; 
        <input type="text" name="nomDeCours" size="50" maxlength="50" value="<?php echo  $fldNomDeCours ?>">
        </b></font></td>
    </tr>
    <tr> 
      <td height="30"> 
        <div align="right"><font color="#000000"><b>Nom complet: </b></font></div>
      </td>
      <td height="30"> <font color="#FFFF00"><b>&nbsp; 
        <input type="text" name="descriptionDeCours" size="50" maxlength="80" value="<?php echo  $fldDescriptionDeCours ?>">
        </b></font></td>
    </tr>
    <tr> 
      <td height="27"> 
        <div align="right"><b>Nombre d'heures: </b></div>
      </td>
      <td height="27"> &nbsp;<font color="#FFFF00"><b> 
        <input type="text" name="nombreDHeures" size="12" maxlength="12" value="<?php echo  $fldNombreDHeures ?>">
        </b></font></td>
    </tr>
    <tr> 
      <td height="33"> 
        <div align="right"><font color="#000000"><b>Plan du cours: </b></font></div>
      </td>
      <td height="33"> <font color="#FFFF00"> &nbsp; <b> 
        <input type="text" name="planDeCours" size="50" maxlength="50" value="<?php echo  $fldPlanDeCours ?>">
        </b></font></td>
    </tr>
    <tr> 
<!--      <td height="80" valign="top"> 
        <div align="right"><b>Professeurs</b>: </div>
      </td>
-->
	<td height="80" valign="top">&nbsp; 
    		<input type="hidden" name="FormType" value="<?php echo $formType?>"> 
		<input type="hidden" name="CoursID" value="<?php echo $fldCoursID?>"> 
		<input type="hidden" name="FormAction" value="update">
 <!--       <input type="submit" name="submit" value="Modifier la liste des Professeurs" onclick="document.form1.FormAction.value = 'modifier_profs' ;">
 // Quang commented -->
         </td>
    </tr>

  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="45" width="24%"> 
        <div align="left"> </div>
      </td>
      <td height="45" width="76%"> &nbsp; 
		  <input type="hidden" name="FormName" value="form1">
		  <input type="hidden" name="FormType" value="<?php echo  $formType?>">
		  <input type="hidden" name="CoursID" value="<?php echo  $fldCoursID ?>">
<?php if (strtolower($formType) == "ajouter") { ?>
		  <input type="submit" value="Ajouter"
		  onclick="document.form1.FormAction.value = 'ajouter';">
<?php } 
   else { ?>
		  <input type="submit" value="Enregistrer"
		  onclick="document.form1.FormAction.value = 'enregistrer';">
<?php } ?>
          <input type="submit" value="Annuler" 
		  onclick="document.form1.FormAction.value = 'annuler';">
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
	global $fldCoursID;
	global $fldNomDeCours;
	global $fldNombreDHeures;
	global $fldPlanDeCours;
	global $fldDescriptionDeCours;

	if ((strtolower($action) == "ajouter") || 
		(strtolower($action) == "enregistrer") || 
		(strtolower($action) == "modifier_profs")) {
		$fldCoursID = strip(get_param("coursIDinput"));
		$fldNomDeCours = strip(get_param("nomDeCours"));
		$fldNombreDHeures = strip(get_param("nombreDHeures"));
		$fldPlanDeCours = strip(get_param("planDeCours"));
		$fldDescriptionDeCours = strip(get_param("descriptionDeCours"));
	}
	else {
		$sWhere .= "cours_id=" . tosql($fldCoursID, "Text");
		$sSQL = "SELECT * FROM Cours WHERE " . $sWhere;
		$db->query($sSQL);
		$db->next_record();
		$fldNomDeCours = $db->f("nom_de_cours");
		$fldNombreDHeures = $db->f("nombre_dheures");
		$fldPlanDeCours = $db->f("plan_du_cours");
		$fldDescriptionDeCours = $db->f("description_de_cours");
	}
}

function test_error() {
	global $error;
	global $db;
	global $formAction;
	global $fldCoursID;
	global $fldNomDeCours;
	global $fldNombreDHeures;
	global $fldPlanDeCours;
	global $fldDescriptionDeCours;
	global $formType;
//printf("Debug: test_error_adminCoursInfo, formeType: %s, formeAction:%s\n", $formType, $formAction);  // Quang added
	if ($formAction=="ajouter") {
		$sSQL = "SELECT * FROM Cours WHERE cours_id=" . tosql($fldCoursID,"Text");
		$db->query($sSQL);
		if ($db->next_record()) 
			$error = $error . "Cours [ID=".$fldCoursID."] existe deja, choisir un autre ID.<br>" ;
		$sSQL = "SELECT * FROM Cours WHERE nom_de_cours=" . tosql($fldNomDeCours,"Text");
		$db->query($sSQL);
		if ($db->next_record()) 
			$error = $error . "Cours [Nom=".$fldNomDeCours."] existe deja, choisir un autre nom.<br>" ;
	}
	if (!strlen($fldCoursID))
		$error = $error . "Il faut donner un ID du cours.<br>" ;
	if (!strlen($fldNomDeCours))
		$error = $error . "Il faut donner un nom du cours.<br>" ;
	if ($fldNombreDHeures <= 0 )
		$error = $error . "Il faut donner une valeur positif au nombre d'heures.<br>" ;
}

function form1_Action($action) {
	global $db;
	global $error;
	global $formType;
	global $fldCoursID;
	global $coursID;
	global $fldNomDeCours;
	global $fldNombreDHeures;
	global $fldPlanDeCours;
	global $fldDescriptionDeCours;

	$sSQLadd = "INSERT INTO Cours (" .
			"cours_id, " . 
			"nom_de_cours, " . 
			"nombre_dheures, " . 
			"plan_du_cours, " . 
			"description_de_cours) " . 
		"VALUES (" .
			tosql($fldCoursID, "Text") . "," . 
			tosql($fldNomDeCours, "Text") . "," . 
			tosql($fldNombreDHeures, "Number") . "," . 
			tosql($fldPlanDeCours, "Text") . "," . 
			tosql($fldDescriptionDeCours, "Text") . ")";
	$sWhere = "cours_id=" . tosql($coursID, "Text");
	$sSQLupdate = "update Cours set " .
		"cours_id=" . tosql($fldCoursID, "Text") . "," .
		"nom_de_cours=" . tosql($fldNomDeCours, "Text") . "," .
		"nombre_dheures=" . tosql($fldNombreDHeures, "Number") . "," .
		"plan_du_cours=" . tosql($fldPlanDeCours, "Text") . ", " . "description_de_cours=" . tosql($fldDescriptionDeCours, "Text");
	$sSQLupdate = $sSQLupdate .	" WHERE " . $sWhere;

	switch (strtolower($action)) {
		case "ajouter":
			test_error();
			if(strlen($error)) return;
			$db->query($sSQLadd);
			header("Location: adminListeCours.php"); //Quang modified
/*			header("Location: adminCoursProfesseur.php?CoursID=" . $fldCoursID); */
			break;
		case "enregistrer":
			test_error();
			if(strlen($error)) return;
			$db->query($sSQLupdate);
/*			$sSQL = "update Cours_professeurs set cours_id=" . 						tosql($fldCoursID, "Text") . " WHERE cours_id=" . 				tosql($coursID,"Text");
			$db->query($sSQL);
			$sSQL = "SELECT * FROM Cours_professeurs WHERE cours_id=" . 				tosql($fldCoursID,"Text");
			$db->query($sSQL);
			if (!$db->next_record())
				header("Location: adminCoursProfesseur.php?CoursID=" . $fldCoursID);
			else
				header("Location: adminListeCours.php");*/ // Quang commented
			header("Location: adminListeCours.php");
			break;
		case "annuler":
			header("Location: adminListeCours.php");
			return;
/*		case "modifier_profs":
			test_error();
			if(strlen($error)) return;
			if ($formType=="ajouter")
				$db->query($sSQLadd);
			else	
				$db->query($sSQLupdate);
			header("Location: adminCoursProfesseur.php?CoursID=" . $fldCoursID);
			break; */ // Quang commented
	}
}

?>
