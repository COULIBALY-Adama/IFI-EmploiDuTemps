<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$emploiID = get_param("EmploiID");
	$coursID = get_param("CoursID");

	// chercher nom de l'emploi du temps
	$sSQL = "SELECT nom_de_lemploi, etat FROM Emploi WHERE emploi_id=" . tosql($emploiID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploiDuTemps = $db->f("nom_de_lemploi");

	// chercher nom de cours 
	$sSQL = "SELECT nom_de_cours FROM Cours WHERE cours_id=" . tosql($coursID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeCours = $db->f("nom_de_cours");


	switch (strtolower($formName)) {
		case "form1":
			form1_Action($formAction);
			break;
	}
?>
<html>
<head>
<title>Confirmation de suppression d'un cours dans un Emploi du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#CCFFFF" text="#000000">
<form name="form1" method="post" action="adminEmploiCoursSuppression.php">
  <p align="center"> 
    <input type="hidden" name="FormType" value="<?php echo  $formType?>">
    <input type="hidden" name="FormName" value="form1">
    <input type="hidden" name="FormAction" value="non">
    <input type="hidden" name="CoursID" value="<?php echo $coursID?>">
    <input type="hidden" name="EmploiID" value="<?php echo  $emploiID?>">
  </p>
  <p align="center">&nbsp; </p>
  <p align="center"><b><font color="#FF0000" size="4">Si vous supprimez le cours 
    &quot;<font color="#000000"><?php echo $fldNomDeCours?></font>&quot; dans</font></b></p><p align="center"><font color="#FF0000" size="5"><b><font color="#000000">&quot;<?php echo $fldNomDeLEmploiDuTemps ?>&quot;</font></b></font></p>
  <p align="center"><b><font color="#FF0000" size="4">toutes les heures attribu&eacute;es 
    pour ce cours seront lib&eacute;r&eacute;es</font></b></p>
  <p align="center"><b><font size="6" color="#FF0000">Voulez-vous vraiment supprimer 
    ce cours?</font></b></p>
  <p align="center"> 
    <input type="submit" name="submit" value="      Oui       " onclick="document.form1.FormAction.value = 'supprimer' ;">
    <input type="submit" name="submit" value="      Non      " onclick="document.form1.FormAction.value = 'annuler' ;">
  </p>
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
	global $coursID;

	switch (strtolower($action)) {
		case "supprimer":
			$sWhere = "cours_id=" . tosql($coursID, "Text");
			$sWhere .= " AND emploi_id=" . tosql($emploiID,"Text"); 
			$sSQL = "DELETE FROM Emploi_cours WHERE " . $sWhere;
			$db->query($sSQL);
			$sSQL = "DELETE FROM Emploi_jour WHERE " . $sWhere;
			$db->query($sSQL);
			$sSQL = "DELETE FROM Emploi_cours_professeur WHERE " . $sWhere;
			$db->query($sSQL);
			header("Location: adminEmploiCours.php?EmploiID=" . $emploiID);
			break;
		case "annuler":
			header("Location: adminEmploiCours.php?EmploiID=" . $emploiID);
			return;
	}
}

?>
