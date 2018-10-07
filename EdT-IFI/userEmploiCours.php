<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	// Database Initialize
	$db1 = new DB_Sql();
	$db1->Database = DATABASE_NAME;
	$db1->User     = DATABASE_USER;
	$db1->Password = DATABASE_PASSWORD;
	$db1->Host     = DATABASE_HOST;

	$emploiselected = get_param("EmploiID");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$error = "";

	// chercher nom de l'emploi du temps
	$sSQL = "SELECT nom_de_lemploi FROM Emploi WHERE emploi_id=" . tosql($emploiselected, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploiDuTemps = $db->f("nom_de_lemploi");
?>

<html>
<head>
<title>Liste des Cours</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#CCFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="7" height="32" bgcolor="#000000"> 
        <div align="center"><b><font color="#00FF00"><?php echo $fldNomDeLEmploiDuTemps?></font></b></div>
      </td>
    </tr>
  <tr> 
    <td height="30" colspan="2"> 
      <div align="center"><b><font size="4">Liste des Cours</font></b></div>
    </td>
  </tr>
<?php
	$sSQL = "SELECT EC.cours_id, C.* FROM Emploi_cours as EC LEFT JOIN Cours as C USING (cours_id) WHERE EC.emploi_id=" . tosql($emploiselected, "Text");
	$db->query($sSQL);
	$i=0;
	while ($db->next_record()) {
		$fldCoursID = $db->f("cours_id");
		$fldNomDeCours = $db->f("nom_de_cours");
		$fldNombreDHeures = $db->f("nombre_dheures");
		$i++;
?>
  <tr bgcolor="#CCFFCC"> 
    <td colspan="2" height="36"><b><a href="userCoursInfo.php?CoursID=<?php echo $fldCoursID?>&RetPage=userEmploiCours.php&EmploiID=<?php echo $emploiselected?>"><?php echo $i?>. <?php echo $fldNomDeCours?>&nbsp;(<?php echo $fldNombreDHeures?> heures)</a></b></td>
  </tr>
	<?php
		$sSQL = "SELECT * FROM Emploi_cours_professeur " . 
				"WHERE emploi_id=" . tosql($emploiselected, "Text") . 
				" AND cours_id=" . tosql($fldCoursID, "Text");
		$db1->query($sSQL);
		while ($db1->next_record()) {
			$fldPersonnelID = $db1->f("personnel_id");
			$sSQL = "SELECT * FROM Personne " . 
					"WHERE PersonneID=" . tosql($fldPersonnelID, "Number");
			$trombi->query($sSQL);
			$trombi->next_record();
			$fldNomDePersonnel = $trombi->f("Nom") . " " . $trombi->f("Prenom");
	?>	
	  <tr> 
		<td width="6%" height="39">&nbsp;</td>
		<td width="94%" height="39">prof. <?php echo  $fldNomDePersonnel?></td>
	  </tr>
	 <?php
	 }	
	?>
<?php
}	
?>
</table>
<p>&nbsp;</p>
</body>
</html>
