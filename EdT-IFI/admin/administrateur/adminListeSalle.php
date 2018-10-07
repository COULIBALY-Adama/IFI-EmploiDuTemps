<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");
	$sFileName = "adminListeSalle.php";
	if ($submit) // do action
		switch ($submit) {
			case	"Ajouter":
					header("Location: adminSalleInfo.php?FormType=ajouter");
					break;
			case	"Supprimer":
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					//if ($id == get_session("UserID")) continue;
					$sSQL = "select * from Emploi where salle_id=" . tosql($id, "Number");
					$db->query($sSQL);
					if ($db->next_record()) { 
						$error .= "Salle [ID=" . $id . "] utilisé <br>";
						continue; 
					}
					$sSQL = "select * from Emploi_jour where salle_id=" . tosql($id, "Number");
					$db->query($sSQL);
					if ($db->next_record()) { 
						$error .= "Salle [ID=" . $id . "] est utilisé<br>";
						continue; 
					}
					$sWhere = "salle_id=" . tosql($id, "Number");
					$sSQL = "delete from Salle where " . $sWhere;
					$db->query($sSQL);
				}
				break;
		}
?>

<html>
<head>
<title>Liste des Salles</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="post" action="adminListeSalle.php" name="chklst">
  <table width="90%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" align="center">
    <tr bgcolor="#5599CC"> 
      <td colspan="3" height="36"> 
        <div align="center"><b><font size="5" color="#FFFFFF">Liste des Salles</font></b></div>
      </td>
    </tr>
	<?php if (strlen($error)) { ?>
    <tr bgcolor="#00FFDD" bordercolor="#006699"> 
      <td colspan="3" height="30"> 
        <div align="center"><b><font size="2" color="#FF0000"><?php echo  $error ?></font></b></div>
      </td>
    </tr>
	<?php } ?>
    <tr bgcolor="#000099" bordercolor="#006699"> 
      <td width="7%" height="29"><b><font color="#FFFFFF"></font></b></td>
      <td width="38%" height="29"> 
        <div align="center"><b><font color="#FFFFFF">Nom</font></b></div>
      </td>
      <td width="55%" height="29"> 
        <div align="center"><b><font color="#FFFFFF">Description</font></b></div>
      </td>
    </tr>
	
	<?php 
		lister(); 
	?>	

  </table>

  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="50"> 
        <input type="submit" name="submit" value="Ajouter">
        <input type="submit" name="submit" value="Supprimer">
      </td>
    </tr>
  </table>
  <p align="center"><b></b></p>
</form>
<p align="center">&nbsp; </p>
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
	$sSQL = "SELECT m.salle_id as m_salle_id, " .
					"m.nom_de_salle as m_nom_de_salle, " .
					"m.description_de_salle as m_description_de_salle " .
					"FROM Salle m ";
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
		$fldSalleID = $db->f("m_salle_id");
		$fldSalleNom = $db->f("m_nom_de_salle");
		$fldSalleDescription = $db->f("m_description_de_salle");
		$nextRecord = $db->next_record();
?>
		<tr bordercolor="#CCCCFF" <?php if ($iCounter%2) echo "bgcolor=\"#CCFFEE\""; else echo "bgcolor=\"#CCFFCC\"";?>> 
		  <td width="7%" height="29"> 
			<div align="center"> 
			  <?php echo "<input type =\"checkbox\" name=\"skill_set[$fldSalleID]\">"; ?>
			</div>
		  </td>

		  <td width="38%" height="29"><a href="adminSalleInfo.php?SalleID=<?php echo $fldSalleID?>"><?php echo $fldSalleNom?></a></td>
		  <td width="55%" height="29"><?php echo $fldSalleDescription?>&nbsp;</td>
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
				<font>Précédente</font>
<?php		} 
		    else { ?>
				<a href="adminListeSalle.php?PageNumber=<?php echo $iPage-1?>">Pécédente</a> 
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