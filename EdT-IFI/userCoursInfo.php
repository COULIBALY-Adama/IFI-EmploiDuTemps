<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();

	$coursID = get_param("CoursID");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$retPage = get_param("RetPage");
	$emploiID = get_param("EmploiID");
	$error = "";
	$fldCoursID = $coursID;
	$fldNomDeCours;
	$fldNombreDHeures;
	$fldPlanDeCours;
	$fldDescriptionDeCours;
	
	form1_get_info($formAction);
	
	switch (strtolower($formName)) {
		case "form1":
			form1_Action($formAction);
			break;
	}
?>

<html>
<head>
<title>Description de Cours</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="POST" action="userCoursInfo.php" name="form1">
  <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr bgcolor="#000066"> 
      <td height="32" colspan="3"> 
        <div align="left"><b><font color="#FFFFFF">Description du Cours</font></b></div>
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
      <td height="29" width="29%">&nbsp;</td>
      <td height="29" width="71%">&nbsp;</td>
    </tr>
<?php } ?>
    <tr> 
      <td height="29" width="29%"> 
        <div align="right">ID: </div>
      </td>
      <td height="29" width="71%"><font color="#FF00FF"><b>&nbsp; 
        <?php echo  $fldCoursID?>
        </b></font> </td>
    </tr>
    <tr> 
      <td height="30" width="29%"> 
        <div align="right"><font color="#000000"><b>Nom: </b></font></div>
      </td>
      <td height="30" width="71%"> <font color="#FF00FF"><b>&nbsp; 
        <?php echo  $fldNomDeCours ?>
        </b></font></td>
    </tr>
    <tr> 
      <td height="27" width="29%"> 
        <div align="right"><b>Nombre d'heures: </b></div>
      </td>
      <td height="27" width="71%"> &nbsp;<font color="#FF00FF"><b> 
        <?php echo  $fldNombreDHeures ?>
        </b></font></td>
    </tr>
    <tr> 
      <td height="33" width="29%"> 
        <div align="right"><font color="#000000"><b>Plan du cours: </b></font></div>
      </td>
      <td height="33" width="71%"> <font color="#FF00FF">&nbsp;<b><a href="<?php echo $fldPlanDeCours?>">
        <?php echo $fldPlanDeCours?></a>
        </b></font></td>
    </tr>

  <tr bgcolor="#CCFFCC"> 
      <td colspan="2" height="36"><b>Professeurs:</b></td>
  </tr>
	<?php
		$sSQL = "SELECT * FROM Cours_professeurs " . 
				"WHERE cours_id=" . tosql($coursID, "Text");
		$db->query($sSQL);
		$i=0;
		while ($db->next_record()) {
			$fldPersonnelID = $db->f("personnel_id");
			$sSQL = "SELECT * FROM Personne " . 
					"WHERE PersonneID=" . tosql($fldPersonnelID, "Number");
			$trombi->query($sSQL);
			$trombi->next_record();
			$fldNomDePersonnel = $trombi->f("Nom") . " " . $trombi->f("Prenom");
			$i++;
	?>	
	  <tr> 
		
      <td width="29%" height="39">&nbsp;</td>
		
      <td width="71%" height="39"><?php echo $i?>. <?php echo  $fldNomDePersonnel?>
      </td>
	  </tr>
	 <?php
	 }	
	?>

  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="45" width="24%"> 
        <div align="left"> </div>
      </td>
      <td height="45" width="76%"> &nbsp; 
    	  <input type="hidden" name="FormType" value="<?php echo  $formType?>"> 
		  <input type="hidden" name="FormAction" value="update">
		  <input type="hidden" name="RetPage" value="<?php echo $retPage?>">
		  <input type="hidden" name="EmploiID" value="<?php echo $emploiID?>">
		  <input type="hidden" name="FormName" value="form1">
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
	global $fldCoursID;
	global $fldNomDeCours;
	global $fldNombreDHeures;
	global $fldPlanDeCours;
	global $fldDescriptionDeCours;

	$sWhere .= "cours_id=" . tosql($fldCoursID, "Text");
	$sSQL = "SELECT * FROM Cours WHERE " . $sWhere;
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeCours = $db->f("nom_de_cours");
	$fldNombreDHeures = $db->f("nombre_dheures");
	$fldPlanDeCours = $db->f("plan_du_cours");
	$fldDescriptionDeCours = $db->f("description_de_cours");
}

function form1_Action($action) {
	global $db;
	global $error;
	global $formType;
	global $fldCoursID;
	global $retPage;
	global $emploiID;

	switch (strtolower($action)) {
		case "retourner":
			header("Location: " . $retPage . "?EmploiID=" . $emploiID);
			return;
	}
}

?>
