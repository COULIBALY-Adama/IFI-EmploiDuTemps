<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	$sFileName = "adminListeProfesseur.php";
    $position = get_param("PositionSelected");
	$submit = get_param("submit"); // Quang added
	$skill_set = get_param("skill_set"); // Quang added
	if ($submit) // do action
		switch ($submit) {
			case	"Supprimer":
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					//if ($id == get_session("UserID")) continue;
					$sWhere = "personnel_id=" . tosql($id, "Number");
					$sSQL = "DELETE FROM Personnel WHERE " . $sWhere;
					$db->query($sSQL);
				}
				break;
		}
?>

<html>
<head>
<title>Liste des Professeurs</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#CCFFFF">
<form method="POST" action="adminListeProfesseur.php" name="form1">
  <table width="90%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" align="center">
    <tr bgcolor="#5599CC"> 
      <td colspan="5" height="36"><font color="#FFFFFF"><b> &nbsp;&nbsp;Filtrer</b></font><b><font color="#FFFFFF"> 
        sur Section:</font></b><font color="#FFFFFF"> 
		<input type="hidden" name="PositionSelected" value="<?php echo  $position ?>">
        <select name="ListePersonnel" onChange="window.location.href = 'adminListeProfesseur.php?' + 				'PositionSelected='+document.form1.ListePersonnel.value;">
		<OPTION value=NULL>&nbsp;Cliquer pour choisir</OPTION>
<?php
			$sSQL = "SELECT * FROM Position"; 
			$trombi->query($sSQL);
			$nextRecord = $trombi->next_record();
			while ($nextRecord) {
				$fldLibelle = $trombi->f("Libelle");
				$fldPositionCode = $trombi->f("PositionCode");
				echo "<OPTION value=\"" . $fldPositionCode . "\"";
				if ($position==$fldPositionCode) echo " SELECTED";
				echo ">" . $fldLibelle .  "</OPTION> <br>";
				$nextRecord = $trombi->next_record();
			}
?>
		</select>
        </font> </td>
    </tr>
    <tr bgcolor="#003366"> 
      <td colspan="5" height="36"> 
        <div align="center"><b><font size="4" color="#FFFFFF">Liste des Personnels</font></b></div>
      </td>
    </tr>
    <tr bgcolor="#000099" bordercolor="#006699"> 
      <td width="6%" height="34"><b><font color="#FFFFFF"></font></b></td>
      <td width="29%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Nom</font></b></div>
      </td>
      <td width="19%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Courrier electronique</font></b></div>
      </td>
      <td width="15%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Nom de Login</font></b></div>
      </td>
      <td width="31%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Description</font></b></div>
      </td>
    </tr>
	<?php lister(); ?>	
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="39" width="69%"> 
        <input type="submit" name="submit" value="Supprimer">
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
	global $position;
	global $trombi;
	global $sFileName;
	global $checklist;
	$iRecordsPerPage = 10;
	$iCounter = 0;
	$iPage = 0;
	$iNumPage;
	$bEof = false;
	$transit_params = "";
	$form_params = "";
	$sSQL = "SELECT Personne.PersonneID, " .
					"Personne.Nom, " .
					"Personne.Prenom, " .
					"Personne.Courriel, " .
					"Position.Libelle " .
					"FROM Personne LEFT JOIN Position USING (PositionCode) WHERE Position.PositionCode='" . tosql($position, "Number") . "'";
	$trombi->query($sSQL);
	$nextRecord = $trombi->next_record();
	$numRecord = $trombi->nf();
	$iNumPage = round(($numRecord-(($numRecord-1)%$iRecordsPerPage))/$iRecordsPerPage)+1;
	if (!$nextRecord) return;
	$iPage = get_param("PageNumber");
	if(!strlen($iPage)) $iPage = 1; 
	else $iPage = intval($iPage);
	if(($iPage - 1) * $iRecordsPerPage != 0) {
		do {
		  $iCounter++;
		} while ($iCounter < ($iPage - 1) * $iRecordsPerPage && $trombi->next_record());
		$nextRecord = $trombi->next_record();
	}
	$iCounter = 0;
	while ($nextRecord && $iCounter < $iRecordsPerPage) {
		$fldPersonneID = $trombi->f("PersonneID");
		$fldNom = $trombi->f("Nom") . " ";
		$fldNom .= $trombi->f("Prenom");
		$fldCourrier = $trombi->f("Courriel");
		$fldLibelle = $trombi->f("Libelle");
		$nextRecord = $trombi->next_record();

		$sSQL = "SELECT * FROM Personnel WHERE personnel_id=" . $fldPersonneID;
		$db->query($sSQL);
		$dbNextRecord = $db->next_record();
		$fldNomDeLogin = $db->f("nom_de_login");
?>
	<tr bordercolor="#CCCCFF" <?php if ($iCounter%2) echo "bgcolor=\"#CCFFEE\""; else echo "bgcolor=\"#CCFFCC\"";?>>
	  <td width="6%" height="29"> 
        <div align="center"> 
          <?php echo "<input type =\"checkbox\" name=\"skill_set[$fldPersonneID]\">"; ?>
        </div>
      </td>
	  <td width="29%" height="29"><a href="adminProfesseurInfo.php?PersonnelID=<?php echo  $fldPersonneID?>&PositionSelected=<?php echo  tohtml($position) ?>">&nbsp;<?php echo  $fldNom ?></a>
		</td>
	  <td width="19%" height="29"> 
        <div align="center">&nbsp;<?php echo  $fldCourrier ?></div>
      </td>
	  <td width="15%" height="29"> 
        <div align="center">&nbsp;<?php echo  $fldNomDeLogin ?></div>
      </td>
	  <td width="31%" height="29">&nbsp;<?php echo  $fldLibelle ?></td>
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
				<font>Pr&eacute;c&eacute;dente</font>
<?php		} 
		    else { ?>
				<a href="adminListeProfesseur.php?PageNumber=<?php echo $iPage-1?>&PositionSelected=<?php echo  $position ?>">Pr&eacute;c&eacute;dente</a> 
<?php		}
			echo "&nbsp;[&nbsp;page " . $iPage . "/". $iNumPage . "&nbsp;]&nbsp;";
			if (!$bEof) {	?>
				<font>Suivante</font>
<?php		}
			else { ?>
				<a href="adminListeProfesseur.php?PageNumber=<?php echo $iPage+1?>&PositionSelected=<?php echo  $position ?>">Suivante</a>
<?php		}
		}	?>
		 &nbsp;</b></div>
      </td>
    </tr>
<?php
} // end of function
?>
