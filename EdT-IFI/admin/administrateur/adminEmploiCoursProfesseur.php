<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");
	$emploiID = get_param("EmploiID");
	$coursID = get_param("CoursID");
	$professeurselected = get_param("ListeProfesseur");

	// get Nom du cours
	$sSQL = "SELECT Cours.nom_de_cours FROM Cours WHERE cours_id = " . tosql($coursID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$nomDeCours = $db->f("nom_de_cours");

	if ($submit) // do action
		switch ($submit) {
			case "Ajouter":
				if ($professeurselected=="NULL")break;
				$sSQL = "INSERT INTO Emploi_cours_professeur (emploi_id, cours_id, personnel_id) VALUES (" . tosql($emploiID, "Text") . ", " . tosql($coursID,"Text") . ", " . tosql($professeurselected,"") . ")";
				$db->query($sSQL);
				break;
			case "Retourner":
				header("Location: adminEmploiCours.php?EmploiID=" . $emploiID . "&CoursID=" . $coursID);
				break;
			case "Supprimer":
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					//if ($id == get_session("UserID")) continue;
					$sWhere = "cours_id=" . tosql($coursID, "Text");
					$sWhere .= " AND emploi_id=" . tosql($emploiID,"Text"); 
					$sWhere .= " AND personnel_id=" . tosql($id,"Text"); 
					$sSQL = "DELETE FROM Emploi_cours_professeur WHERE " . $sWhere;
					$db->query($sSQL);
				}
				break;
		}
?>

<html>
<head>
<title>Selection des Professeurs Pour Un Cours</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#CCFFFF">
<form method="POST" action="adminEmploiCoursProfesseur.php" name="form1">
  <table width="90%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" align="center">
    <tr bgcolor="#000066"> 
      <td colspan="5" height="36"><font color="#FFFFFF">&nbsp;&nbsp;Liste des Profs.:</font></b><font color="#FFFFFF"> 
		<input type="hidden" name="EmploiID" value="<?php echo  $emploiID ?>">
		<input type="hidden" name="CoursID" value="<?php echo  $coursID ?>">
		<input type="hidden" name="ProfesseurSelected" value="<?php echo  $professeurselected ?>">
        <select name="ListeProfesseur">
		<OPTION value="NULL">&nbsp;Cliquer pour choisir</OPTION>
<?php
//		$sSQL = "SELECT * FROM Cours_professeurs WHERE cours_id=" . tosql($coursID, "Text");
		$sSQL = "SELECT CP.* " .
					"FROM Cours_professeurs as CP LEFT JOIN Emploi_cours_professeur as ECP" . 
					" ON ECP.emploi_id=" . tosql($emploiID, "Text") .
					" AND ECP.cours_id=" . tosql($coursID, "Text") .
					" AND CP.personnel_id=ECP.personnel_ID " .
					"WHERE ECP.personnel_id IS NULL" .
					" AND CP.cours_id=" . tosql($coursID, "Text");

		$db->query($sSQL);
		$nextRecord = $db->next_record();
		while ($nextRecord) {
			$fldPersonnelID = $db->f("personnel_id");
			$nextRecord = $db->next_record();
			// get name from  trombi
			$sSQL = "SELECT Nom, Prenom " .
					"FROM Personne " . 
					"WHERE PersonneID=" . tosql($fldPersonnelID, "Number");
			$trombi->query($sSQL);
			$next = $trombi->next_record();
			$fldNomDePersonnel = $trombi->f("Nom") . " " . $trombi->f("Prenom");
			echo "<OPTION value=\"" . $fldPersonnelID . "\"";
			echo ">" . $fldNomDePersonnel .  "</OPTION> <br>";
		}
?>
		</select>
        <input type="submit" name="submit" value="Ajouter">
        </font> </td>
    </tr>
    <tr bgcolor="#003366"> 
      <td colspan="5" height="36"> 
        <div align="center"><b><font size="4" color="#FFFFFF">Liste des Profs Selectionnes pour le Cours "<?php echo  $nomDeCours?>"</font></b></div>
      </td>
    </tr>
    <tr bgcolor="#000099" bordercolor="#006699"> 
      <td width="6%" height="34"><b><font color="#FFFFFF"></font></b></td>
      <td width="94%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Nom de Professeur</font></b></div>
      </td>
    </tr>
	<?php lister(); ?>	
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="39" width="69%"> 
        <input type="submit" name="submit" value="Supprimer">
        <input type="submit" name="submit" value="Retourner">
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p align="center"><b></b></p>
<p>&nbsp; </p>
</body>
</html>


<?php 
function lister() 
{
	global $db;
	global $trombi;
	global $professeurselected;
	global $emploiID;
	global $coursID;
	$iRecordsPerPage = 10;
	$iCounter = 0;
	$iPage = 0;
	$iNumPage;
	$bEof = false;
	$sSQL = "SELECT * FROM Emploi_cours_professeur WHERE emploi_id=" . tosql($emploiID,"Text") . " AND cours_id=" . tosql($coursID,"Text");
	$db->query($sSQL);
	$nextRecord = $db->next_record();
	$numRecord = $db->nf();
	$iNumPage = round(($numRecord-(($numRecord-1)%$iRecordsPerPage))/$iRecordsPerPage)+1;
	if (!$nextRecord) return;
	$iPage = get_param("PageNumber");
	if(!strlen($iPage)) $iPage = 1; 
	else $iPage = intval($iPage);
	if(($iPage - 1) * $iRecordsPerPage != 0) {
		do {
		  $iCounter++;
		} while ($iCounter < ($iPage - 1) * $iRecordsPerPage && $db->next_record());
		$nextRecord = $db->next_record();
	}
	$iCounter = 0;
	while ($nextRecord && $iCounter < $iRecordsPerPage) {
		$fldPersonnelID = $db->f("personnel_id");
		$sSQL = "SELECT Nom, Prenom " .
					"FROM Personne " . 
					"WHERE PersonneID=" . tosql($fldPersonnelID, "Number");
		$trombi->query($sSQL);
		$next = $trombi->next_record();
		$fldNomDePersonnel = $trombi->f("Nom") . " " . $trombi->f("Prenom");
		$nextRecord = $db->next_record();
?>
	<tr bordercolor="#CCCCFF">
	  <td width="6%" height="29"> 
        <div align="center"> 
          <?php echo "<input type =\"checkbox\" name=\"skill_set[$fldPersonnelID]\">"; ?>
        </div>
      </td>
	  <td width="94%" height="29">&nbsp;<?php echo  $fldNomDePersonnel ?></td>
    </tr>
<?php
		$iCounter++;
	}	// end of While loop 	?>
    <tr bordercolor="#CC9900" bgcolor="#CC9900"> 
      <td colspan="5" height="29"> 
        <div align="right"><b>
<?php
		$bEof = $nextRecord;
		if($bEof || $iPage != 1) {
			if ($iPage == 1) {	?>
				<font>Précédente</font>
<?php		} 
		    else { ?>
				<a href="adminEmploiCoursProfesseur.php?PageNumber=<?php echo $iPage-1?>&ProfesseurSelected=<?php echo  $professeurselected ?>">Précédente</a> 
<?php		}
			echo "&nbsp;[&nbsp;page " . $iPage . "/". $iNumPage . "&nbsp;]&nbsp;";
			if (!$bEof) {	?>
				<font>Suivante</font>
<?php		}
			else { ?>
				<a href="adminEmploiCoursProfesseur.php?PageNumber=<?php echo $iPage+1?>&ProfesseurSelected=<?php echo  $professeurselected ?>">Suivante</a>
<?php		}
		}	?>
		 &nbsp;</b></div>
      </td>
    </tr>
<?php
} // end of function
?>