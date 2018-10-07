<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	$emploiID = get_param("EmploiID");
	$coursselected = get_param("ListeCours");

	// chercher nom de l'emploi du temps
	$sSQL = "SELECT nom_de_lemploi FROM Emploi WHERE emploi_id=" . tosql($emploiID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploiDuTemps = $db->f("nom_de_lemploi");
	$submit = get_param("submit");  //Quang added
	if ($submit) // do action
		switch ($submit) {
			case "Ajouter":
				if ($coursselected=="NULL") break;
				$sSQL = "INSERT INTO Emploi_cours (emploi_id, cours_id) VALUES (" . tosql($emploiID, "Text") . ", " . tosql($coursselected,"Text") . ")";
				$db->query($sSQL);
				break;
			case "Etape Precedente":
				header("Location: adminEmploiParametre.php?EmploiID=" . $emploiID);
				break;
			case "Etape Suivante":
				header("Location: adminEmploiCreation.php?EmploiID=" . $emploiID);
				break;
		}
?>

<html>
<head>
<title>Liste des Professeurs</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#CCFFFF">
<form method="POST" action="adminEmploiCours.php" name="form1">
  <table width="90%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" align="center">
    <tr>
      <td colspan="7" height="32" bgcolor="#000000"> 
        <div align="center"><b><font color="#00FF00"><?php echo $fldNomDeLEmploiDuTemps?></font></b></div>
      </td>
    </tr>
	<tr bgcolor="#000066"> 
      <td colspan="5" height="36"><font color="#FFFFFF">Liste des Cours:</font></b><font color="#FFFFFF"> 
		<input type="hidden" name="EmploiID" value="<?php echo  $emploiID ?>">
		<input type="hidden" name="CoursSelected" value="<?php echo  $coursselected ?>">
        <select name="ListeCours">
		<OPTION value="NULL">&nbsp;Cliquer pour choisir</OPTION>
<?php
			$sSQL = "SELECT C.* " .
					"FROM Cours as C LEFT JOIN Emploi_cours as EC " . 
					"ON C.cours_id=EC.cours_id and EC.emploi_id=" . tosql($emploiID, "Text") . " " .
					"WHERE EC.cours_id IS NULL order by nom_de_cours";
			$db->query($sSQL);
			$nextRecord = $db->next_record();
			while ($nextRecord) {
				$fldNomDeCours = $db->f("nom_de_cours");
				$fldCoursID = $db->f("cours_id");
				echo "<OPTION value=\"" . $fldCoursID . "\"";
				if ($coursselected==$fldCoursID) echo " SELECTED";
				echo ">" . $fldNomDeCours .  "</OPTION> <br>";
				$nextRecord = $db->next_record();
			}
?>
		</select>
        <input type="submit" name="submit" value="Ajouter">
        </font> </td>
    </tr>
    <tr bgcolor="#003366"> 
      <td colspan="5" height="36"> 
        <div align="center"><b><font size="4" color="#FFFFFF">Liste des Cours selectionnes</font></b></div>
      </td>
    </tr>
    <tr bgcolor="#000099" bordercolor="#006699"> 
      <td width="6%" height="34"><b><font color="#FFFFFF"></font></b></td>
      <td width="54%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Nom de Cours</font></b></div>
      </td>
      <td width="40%" height="34" colspan="2"> 
        <div align="center"><b><font color="#FFFFFF">Action</font></b></div>
      </td>
    </tr>
	<?php lister(); ?>	
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="39" width="69%"> 
        <input type="submit" name="submit" value="Etape Precedente">
        <input type="submit" name="submit" value="Etape Suivante">
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
	global $coursselected;
	global $checklist;
	global $emploiID;
	$iRecordsPerPage = 10;
	$iCounter = 0;
	$iPage = 0;
	$iNumPage;
	$bEof = false;
	$transit_params = "";
	$form_params = "";
	$sSQL = "SELECT EC.cours_id, C.nom_de_cours " . 
			"FROM Emploi_cours as EC LEFT JOIN Cours as C USING (cours_id) " .
			"WHERE EC.emploi_id=" . tosql($emploiID,"Text");
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
		$fldCoursID = $db->f("cours_id");
		$fldNomDeCours = $db->f("nom_de_cours");
		$nextRecord = $db->next_record();
?>
	<tr bordercolor="#CCCCFF" <?php if ($iCounter%2) echo "bgcolor=\"#CCFFEE\""; else echo "bgcolor=\"#CCFFCC\"";?>>
	  <td width="6%" height="29"> 
        <div align="center"> 
		  <?php echo  ($iCounter+($iPage-1)*$iRecordsPerPage)+1?>	  
        </div>
      </td>
	  <td width="54%" height="29">&nbsp;<?php echo  $fldNomDeCours ?></td>
	  <td width="30%" height="29"> 
        <div align="center"><a href="adminEmploiCoursProfesseur.php?CoursID=<?php echo  $fldCoursID?>&EmploiID=<?php echo  $emploiID?>">Modifier Liste des Professeurs</a></div>
      </td>
	  <td width="10%" height="29"> 
        <div align="center"><a href="adminEmploiCoursSuppression.php?CoursID=<?php echo  $fldCoursID?>&EmploiID=<?php echo  $emploiID?>">Supprimer</a></div>
      </td>
    </tr>
<?php
		$iCounter++;
	}	// end of While loop 	?>
    <tr bordercolor="#CC9900" bgcolor="#CC9900"> 
      <td colspan="6" height="29"> 
        <div align="right"><b>
<?php
		$bEof = $nextRecord;
		if($bEof || $iPage != 1) {
			if ($iPage == 1) {	?>
				<font>Pr&eacute;c&eacute;dente</font>
<?php		} 
		    else { ?>
				<a href="adminEmploiCours.php?PageNumber=<?php echo $iPage-1?>&CoursSelected=<?php echo  $coursselected ?>&EmploiID=<?php echo $emploiID?>">Pr&eacute;c&eacute;dent</a> 
<?php		}
			echo "&nbsp;[&nbsp;page " . $iPage . "/". $iNumPage . "&nbsp;]&nbsp;";
			if (!$bEof) {	?>
				<font>Suivante</font>
<?php		}
			else { ?>
				<a href="adminEmploiCours.php?PageNumber=<?php echo $iPage+1?>&CoursSelected=<?php echo  $coursselected ?>&EmploiID=<?php echo $emploiID?>">Suivante</a>
<?php		}
		}	?>
		 &nbsp;</b></div>
      </td>
    </tr>
<?php
} // end of function
?>
