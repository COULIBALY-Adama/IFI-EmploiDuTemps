<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	$sFileName = "adminListeCours.php";
	$submit = get_param("submit"); // Quang added
	$skill_set = get_param("skill_set"); // Quang added
	if ($submit) // do action
		switch ($submit) {
			case	"Ajouter":
					header("Location: adminCoursInfo.php?FormType=ajouter");
					break;
			case	"Supprimer":
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					// check existance
					$sSQL = "select * from Emploi_cours where cours_id=" . tosql($id, "Text");
					$db->query($sSQL);
					if ($db->next_record()) { 
						$error .= "Cours [ID=" . $id . "] est en cours d'utilisation <br>";
						continue; 
					}
					$sWhere = "cours_id=" . tosql($id, "Text");
					$sSQL = "DELETE FROM Cours_professeurs WHERE " . $sWhere;
					$db->query($sSQL);
					$sSQL = "DELETE FROM Cours WHERE " . $sWhere;
					$db->query($sSQL);
				}
				break;
	}
?>

<html>
<head>
<title>Liste de cours</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="POST" action="adminListeCours.php" name="form1">
  <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
    <tr bgcolor="#5599CC"> 
      <td colspan="5" height="36"> 
        <div align="center"><b><font size="5" color="#FFFFFF">Liste des Cours</font></b></div>
      </td>
    </tr>
	<?php if (strlen($error)) { ?>
    <tr bgcolor="#00FFAA" bordercolor="#006699"> 
      <td colspan="5" height="30"> 
        <div align="center"><b><font size="2" color="#FF0000"><?php echo  $error ?></font></b></div>
      </td>
    </tr>
	<?php } ?>
	<tr bgcolor="#330099"> 
      <td width="4%" height="34">&nbsp;</td>
      <td width="9%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">ID</font></b></div>
      </td>
      <td width="46%" height="34"> 
        <div align="center"><font color="#FFFFFF"><b>Nom</b></font></div>
      </td>
      <td width="10%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Heures</font></b></div>
      </td>
      <td width="31%" height="34"> 
        <div align="center"><font color="#FFFFFF"><b>Plan du Cours</b></font></div>
      </td>
    </tr>

<?php 	lister(); ?>	

  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="43"> 
        <input type="submit" name="submit" value="Ajouter" >
        <input type="submit" name="submit" value="Supprimer" onClick="supprimerClick()">
      </td>
    </tr>
  </table>
  <p align="center"></p>
</form>
</body>
</html>

<?php // lister les personnels
function lister() 
{
	global $db;
	global $sFileName;
	global $checklist;
	$iRecordsPerPage = 10;
	$iCounter = 0;
	$iPage = 0;
	$iNumPage;
	$bEof = false;
	$transit_params = "";
	$form_params = "";
	$sSQL = "SELECT  m.cours_id as m_cours_id, " .
					"m.nom_de_cours as m_nom_de_cours, " .
					"m.nombre_dheures as m_nombre_dheures, " .
					"m.plan_du_cours as  m_plan_du_cours, " .
					"m.description_de_cours as m_description_de_cours " .
					"FROM Cours m ORDER BY m.nom_de_cours";
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
		$fldCoursID = $db->f("m_cours_id");
		$fldNomDeCours = $db->f("m_nom_de_cours");
		$fldNombreDHeures = $db->f("m_nombre_dheures");
		$fldPlanDeCours = $db->f("m_plan_du_cours");
		$nextRecord = $db->next_record();
?>
	<tr <?php if ($iCounter%2) echo "bgcolor=\"#CCFFEE\""; else echo "bgcolor=\"#CCFFCC\"";?>>
      <td width="4%" height="34"> 
        <div align="center"> 
          <?php echo "<input type =\"checkbox\" name=\"skill_set[$fldCoursID]\">"; ?>
        </div>
      </td>

	  <td width="9%" height="34"> 
        <div align="center"><?php echo  $fldCoursID?></div>
      </td>

	  <td width="46%" height="34"><a href="adminCoursInfo.php?CoursID=<?php echo  $fldCoursID ?>"><?php echo  $fldNomDeCours?></a>
	  </td>
      <td width="10%" height="34"> 
        <div align="center">&nbsp;<?php echo  $fldNombreDHeures?></div>
      </td>
      <td width="31%" height="34"><a href="<?php echo  $fldPlanDeCours ?>">&nbsp;<?php echo  $fldPlanDeCours ?></a></td>
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
<?php			} 
		    else { ?>
				<a href="adminListeCours.php?PageNumber=<?php echo $iPage-1?>">Pr&eacute;c&eacute;dente</a> 
<?php			}
			echo "&nbsp;[&nbsp;page " . $iPage . "/". $iNumPage . "&nbsp;]&nbsp;";
			if (!$bEof) {	?>
				<font>Suivante</font>
<?php			}
			else { ?>
				<a href="adminListeCours.php?PageNumber=<?php echo $iPage+1?>">Suivante</a>
<?php			}
		}	?>
		 &nbsp;</b></div>
      </td>
    </tr>
<?php
} // end of function
?>
