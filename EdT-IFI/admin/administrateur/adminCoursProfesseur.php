<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	$sFileName = "adminCoursProfesseur.php";
	$coursID = strip(get_param("CoursID"));
	$personnelAjoute = strip(get_param("PersonnelAjoute"));

	$sSQL = "SELECT nom_de_cours FROM Cours WHERE cours_id = " . tosql($coursID,"Text");
	$db->query($sSQL);
	$db->next_record();
	$nomDeCours = $db->f("nom_de_cours");
	$submit = get_param("submit"); // Quang added
	if ($submit) // do action
		switch ($submit) {
			case	"Retourner":
					header("Location: adminCoursInfo.php?CoursID=" . $coursID);
					break;
			case	"Ajouter":
					if ($personnelAjoute==NULL || $coursID==NULL) break;
					$sSQL = "INSERT INTO Cours_professeurs (" .
								"cours_id, " . 
								"personnel_id) " . 
							"VALUES (" .
								tosql($coursID, "Text") . "," . 
								tosql($personnelAjoute, "Number") . ")";
					$db->query($sSQL);
					break;
			case	"Supprimer":
				if (!isset($skill_set)) return;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					//if ($id == get_session("UserID")) continue;
					$sWhere = "(cours_id=" . tosql($coursID,"Text") . 
						") and (personnel_id=" . tosql($id, "Number") . ")"; 
					$sSQL = "DELETE FROM Cours_professeurs WHERE " . $sWhere;
					$db->query($sSQL);
				}
				break;
		}
?>

<html>
<head>
<title>Rapport sur Professeur</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="post" action="adminCoursProfesseur.php" name="form1">
  <table width="71%" border="1" cellspacing="0" cellpadding="0" align="center" height="120">
    <tr bordercolor="#FFFFFF"> 
      <td colspan="3" bgcolor="#000099"> 
        <div align="center"><font color="#FFFFFF"><b>Selection des Professeurs 
          pour le Cours &quot;<?php echo  $nomDeCours ?>&quot;</b></font></div>
      </td>
    </tr>
    <tr bgcolor="#CCFFFF"> 
      <td colspan="2" height="34"> 
        <div align="center"> 
		  <input type="hidden" name="PersonnelAjoute" value="<?php echo  $personnelAjoute ?>">
		  <input type="hidden" name="CoursID" value="<?php echo  $coursID ?>">
          <select name="ListePersonnel" 
		  onChange=		  "document.form1.PersonnelAjoute.value=document.form1.ListePersonnel.value; ">
		  <OPTION value=NULL><CENTER>Cliquer pour choisir</CENTER></OPTION>
<?php
		$sSQL = "SELECT P.* " .
					"FROM Personnel as P LEFT JOIN Cours_professeurs as CP " . 
					"ON P.personnel_id=CP.personnel_id and CP.cours_id=" . tosql($coursID, "Text") . " " .
					"WHERE CP.personnel_id IS NULL";
			$db->query($sSQL);
			$nextRecord = $db->next_record();
			while ($nextRecord) {
				$fldPersonnelID = $db->f("personnel_id");
				$fldNomDeLogin = $db->f("nom_de_login");
				$nextRecord = $db->next_record();
				if ($fldNomDeLogin=="admin") continue;
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
        <input type="submit" name="submit" value="Ajouter"></div>
      </td>
    </tr>
    <tr bgcolor="#6666FF"> 
      <td width="20%">&nbsp;</td>
      <td width="80%"> 
        <div align="center"><b>Nom de Professeur</b></div>
      </td>
    </tr>
	<?php lister(); ?>
  </table>
  <table width="71%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="62" colspan="2"> 
        <div align="left"> 
          <input type="submit" name="submit" value="Supprimer">
          <input type="submit" name="submit" value="Retourner">
      </td>
    </tr>
  </table>	
  <p>&nbsp;</p>
</form>
</body>
</html>

<?php // lister les personnels
function lister() 
{
	global $db;
	global $trombi;
	global $sFileName;
	global $checklist;
	global $coursID;
	$iRecordsPerPage = 10;
	$iCounter = 0;
	$iPage = 0;
	$iNumPage;
	$bEof = false;
	$transit_params = "";
	$form_params = "";
	$sSQL = "SELECT m.cours_id as m_cours_id, " .
					"m.personnel_id as m_personnel_id " .
					"FROM Cours_professeurs m WHERE cours_id=" . tosql($coursID, "Text");
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
		$fldPersonnelID = $db->f("m_personnel_id");
		$nextRecord = $db->next_record();

		$sSQL = "SELECT Nom, Prenom " .
				"FROM Personne " . 
				"WHERE PersonneID=" . tosql($fldPersonnelID, "Number");
		$trombi->query($sSQL);
		// delete the current person in Cours_
		if (!$trombi->next_record()) {
			continue;
		}
		$fldNomDepersonnel = $trombi->f("Nom") . " " . $trombi->f("Prenom");
?>
    <tr> 
      <td width="20%" height="26" >
			<div align="center"> 
			  <?php echo "<input type =\"checkbox\" name=\"skill_set[$fldPersonnelID]\">"; ?>
			</div></td>
      <td width="80%" height="26">&nbsp;<?php echo  $fldNomDepersonnel ?></td>
	</tr>
<?php
		$iCounter++;
	}	// end of While loop 	?>
    <tr bordercolor="#CC9900" bgcolor="#CC9900"> 
      <td colspan="3" height="29"> 
        <div align="right"><b>
<?php
		$bEof = $nextRecord;
		if($bEof || $iPage != 1) {
			if ($iPage == 1) {	?>
				<font>Precedente</font>
<?php		} 
		    else { ?>
				<a href="adminListeSalle.php?PageNumber=<?php echo $iPage-1?>">Precedente</a> 
<?php		}
			echo "&nbsp;[&nbsp;page " . $iPage . "/". $iNumPage . "&nbsp;]&nbsp;";
			if (!$bEof) {	?>
				<font>Suivante</font>
<?php		}
			else { ?>
				<a href="adminListeSalle.php?PageNumber=<?php echo $iPage+1?>">Suivante</a>
<?php		}
		}	?>
		 &nbsp;</b></div>
      </td>
    </tr>
<?php
} // end of function
?>
