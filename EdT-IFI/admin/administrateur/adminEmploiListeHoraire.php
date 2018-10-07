<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");
	$sFileName = "adminEmploiListeHoraire.php";
	$error = "";

	if ($submit) // do action
		switch ($submit) {
			case "Etape Precedente":
				header("Location: adminEmploiParametre.php?EmploiID=<?php echo  $emploiID ?>");
				break;
			case "Etape Suivante":
				header("Location: adminEmploiCours.php?EmploiID=<?php echo  $emploiID ?>");
				break;
			case "Ajouter a la liste":
				get_info();		
				test_error();
				if (strlen($error)) break;
				break;
			case "Supprimer":
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					//if ($id == get_session("UserID")) continue;
					$sWhere = "emploi_id=" . tosql($id, "Number");
					$sSQL = "DELETE FROM Emploi_horaire WHERE " . $sWhere;
					$db->query($sSQL);
					$sWhere = $sWhere . " and ";
					$sSQL = "DELETE FROM Emploi_jour WHERE " . $sWhere;
					$db->query($sSQL);
				}
				break;
		}
?>

<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<script language="JavaScript">
</script>
<body bgcolor="#CCFFFF">
<form method="post" action="">
  <table width="82%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FF3333" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" align="center">
    <tr bgcolor="#000066"> 
      <td colspan="4" height="36"> 
        <div align="center"><b><font size="5" color="#FFFFFF">Liste des Horaires 
          d'un Jour</font></b></div>
      </td>
    </tr>
    <tr bgcolor="#9999FF" bordercolor="#006699"> 
      <td colspan="4" height="46"> 
        <div align="center">Debut: 
          <select name="select2">
            <option>7h00</option>
            <option>7h30</option>
            <option>8h00</option>
            <option>8h30</option>
            <option>9h00</option>
            <option>9h30</option>
            <option>10h00</option>
            <option>10h30</option>
            <option>11h00</option>
            <option>11h30</option>
            <option>12h00</option>
            <option>12h30</option>
            <option>13h00</option>
            <option>13h30</option>
            <option>14h00</option>
            <option>14h30</option>
            <option>15h00</option>
            <option>15h30</option>
            <option>16h00</option>
            <option>16h30</option>
            <option>17h00</option>
            <option>17h30</option>
            <option>18h00</option>
            <option>18h30</option>
            <option>19h00</option>
            <option>19h30</option>
            <option>20h00</option>
            <option>20h30</option>
            <option>21h00</option>
            <option>21h30</option>
            <option>22h00</option>
            <option>22h30</option>
            <option>23h00</option>
          </select>
          &nbsp;&nbsp;Fin: 
          <select name="select3">
            <option>7h00</option>
            <option>7h30</option>
            <option>8h00</option>
            <option>8h30</option>
            <option>9h00</option>
            <option>9h30</option>
            <option>10h00</option>
            <option>10h30</option>
            <option>11h00</option>
            <option>11h30</option>
            <option>12h00</option>
            <option>12h30</option>
            <option>13h00</option>
            <option>13h30</option>
            <option>14h00</option>
            <option>14h30</option>
            <option>15h00</option>
            <option>15h30</option>
            <option>16h00</option>
            <option>16h30</option>
            <option>17h00</option>
            <option>17h30</option>
            <option>18h00</option>
            <option>18h30</option>
            <option>19h00</option>
            <option>19h30</option>
            <option>20h00</option>
            <option>20h30</option>
            <option>21h00</option>
            <option>21h30</option>
            <option>22h00</option>
            <option>22h30</option>
            <option>23h00</option>
          </select>
          &nbsp;Seance: 
          <select name="select">
            <option>1</option>
            <option>2</option>
            <option>3</option>
          </select>
          <input type="submit" name="Submit" value="Ajouter a la Liste">
        </div>
      </td>
    </tr>
    <tr bgcolor="#000099" bordercolor="#006699"> 
      <td width="15%" height="34"><b><font color="#FFFFFF"></font></b></td>
      <td width="25%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Debut</font></b></div>
      </td>
      <td width="25%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Fin</font></b></div>
      </td>
      <td width="35%" height="34"> 
        <div align="center"><b><font color="#FFFFFF">Seance</font></b></div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="29"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox" value="checkbox">
        </div>
      </td>
      <td width="25%" height="29"> 
        <div align="center"><a href="adminHoraireInfo.php">09h00</a></div>
      </td>
      <td width="25%" height="29"> 
        <div align="center"><a href="adminHoraireInfo.php">10h00</a></div>
      </td>
      <td width="35%" height="29"> 
        <div align="center">1</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="33"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox2" value="checkbox">
        </div>
      </td>
      <td width="25%" height="33"> 
        <div align="center"><a href="adminHoraireInfo.php">10h00</a></div>
      </td>
      <td width="25%" height="33"> 
        <div align="center"><a href="adminHoraireInfo.php">11h00</a></div>
      </td>
      <td width="35%" height="33"> 
        <div align="center">1</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="31"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox3" value="checkbox">
        </div>
      </td>
      <td width="25%" height="31"> 
        <div align="center"><a href="adminHoraireInfo.php">11h00</a></div>
      </td>
      <td width="25%" height="31"> 
        <div align="center"><a href="adminHoraireInfo.php">12h00</a></div>
      </td>
      <td width="35%" height="31"> 
        <div align="center">1</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="29"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox4" value="checkbox">
        </div>
      </td>
      <td width="25%" height="29"> 
        <div align="center"><a href="adminHoraireInfo.php">13h30</a></div>
      </td>
      <td width="25%" height="29"> 
        <div align="center"><a href="adminHoraireInfo.php">14h30</a></div>
      </td>
      <td width="35%" height="29"> 
        <div align="center">2</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="30"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox5" value="checkbox">
        </div>
      </td>
      <td width="25%" height="30"> 
        <div align="center"><a href="adminHoraireInfo.php">14h30</a></div>
      </td>
      <td width="25%" height="30"> 
        <div align="center"><a href="adminHoraireInfo.php">15h30</a></div>
      </td>
      <td width="35%" height="30"> 
        <div align="center">2</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="35"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox6" value="checkbox">
        </div>
      </td>
      <td width="25%" height="35"> 
        <div align="center"><a href="adminHoraireInfo.php">15h30</a></div>
      </td>
      <td width="25%" height="35"> 
        <div align="center"><a href="adminHoraireInfo.php">16h30</a></div>
      </td>
      <td width="35%" height="35"> 
        <div align="center">2</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="36"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox7" value="checkbox">
        </div>
      </td>
      <td width="25%" height="36"> 
        <div align="center"><a href="adminHoraireInfo.php">16h30</a></div>
      </td>
      <td width="25%" height="36"> 
        <div align="center"><a href="adminHoraireInfo.php">17h30</a></div>
      </td>
      <td width="35%" height="36"> 
        <div align="center">2</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="30"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox8" value="checkbox">
        </div>
      </td>
      <td width="25%" height="30"> 
        <div align="center"><a href="adminHoraireInfo.php">19h30</a></div>
      </td>
      <td width="25%" height="30"> 
        <div align="center"><a href="adminHoraireInfo.php">20h30</a></div>
      </td>
      <td width="35%" height="30"> 
        <div align="center">3</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="34"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox9" value="checkbox">
        </div>
      </td>
      <td width="25%" height="34"> 
        <div align="center"><a href="adminHoraireInfo.php">20h30</a></div>
      </td>
      <td width="25%" height="34"> 
        <div align="center"><a href="adminHoraireInfo.php">21h30</a></div>
      </td>
      <td width="35%" height="34"> 
        <div align="center">3</div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="15%" height="31"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox10" value="checkbox">
        </div>
      </td>
      <td width="25%" height="31"> 
        <div align="center"><a href="adminHoraireInfo.php">21h30</a></div>
      </td>
      <td width="25%" height="31"> 
        <div align="center"><a href="adminHoraireInfo.php">22h30</a></div>
      </td>
      <td width="35%" height="31"> 
        <div align="center">3</div>
      </td>
    </tr>
  </table>
  <table width="82%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td height="39"> &nbsp;&nbsp;&nbsp;&nbsp; 
        <input type="submit" name="Submit2" value="Supprimer">
        &nbsp;&nbsp; 
        <input type="submit" name="Submit3" value="Etape Precedente">
        <a href="adminEmploiParametre.php"> Etape Precedente</a> 
        <input type="submit" name="Submit4" value="Etape Suivante">
        <a href="adminEmploiCours.php">Etape Suivante</a></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p align="center"><b></b></p>
<p>&nbsp; </p>
</body>
</html>

<?php 

function get_info() {
	global $db;
	global $formType;
	global $emploiID;
	global $fldNomDeLEmploi;
	global $fldPremierJour;
	global $fldPremierDate;
	global $fldPremierMois;
	global $fldPremierAn;
	global $fldDernierJour;
	global $fldDernierDate;
	global $fldDernierMois;
	global $fldDernierAn;
	global $fldNombreSeance;
	global $fldDuree;
	global $fldDebutMatin;
	global $fldNombreHeureMatin;
	global $fldDebutMidi;
	global $fldNombreHeureMidi;
	global $fldEtat;
	global $fldSalleID;

	if (strtolower($action) == "suivant") {
		$fldNomDeLEmploi = strip(get_param("nomDeLEmploi"));
	
		$fldPremierDate=strip(get_param("premierDate"));
		$fldPremierMois=strip(get_param("premierMois"));
		$fldPremierAn=strip(get_param("premierAn"));
		$fldPremierJour = $fldPremierAn . "-" . $fldPremierMois . "-" . $fldPremierDate;


		$fldDernierDate=strip(get_param("dernierDate"));
		$fldDernierMois=strip(get_param("dernierMois"));
		$fldDernierAn=strip(get_param("dernierAn"));
		$fldDernierJour = $fldDernierAn . "-" . $fldDernierMois . "-" . $fldDernierDate;

		$fldNombreSeance = strip(get_param("nombreSeance"));
		$fldDuree = strip(get_param("duree"));
		$fldDebutMatin = strip(get_param("debutMatin"));
		$fldNombreHeureMatin = strip(get_param("nombreHeureMatin"));
		$fldDebutMidi = strip(get_param("debutMidi"));
		$fldNombreHeureMidi = strip(get_param("nombreHeureMidi"));
		$fldEtat = strip(get_param("etat"));
		$fldSalleID = strip(get_param("salleID"));
	}
	else {
		$sWhere .= "emploi_id=" . tosql($emploiID, "Number");
		$sSQL = "SELECT * FROM Emploi WHERE " . $sWhere;
		$db->query($sSQL);
		$db->next_record();
		$fldNomDeLEmploi = $db->f("nom_de_lemploi");
		$fldPremierJour  = $db->f("premier_jour");
		list($fldPremierDate, $fldPremierMois, $fldPremierAn) = sscanf($fldPremierJour,"%d-%d-%d");
		$fldDernierJour = $db->f("dernier_jour");
		list($fldDernierDate, $fldDernierMois, $fldDernierAn) = sscanf($fldDernierJour,"%d-%d-%d");
		$fldNombreSeance = $db->f("nombre_seance");
		$fldDuree = $db->f("duree");
		$fldDebutMatin = $db->f("debut_matin");
		$fldNombreHeureMatin = $db->f("nombre_heure_matin");
		$fldDebutMidi = $db->f("debut_midi");
		$fldNombreHeureMidi = $db->f("nombre_heure_midi");
		$fldEtat = $db->f("etat");
		$fldSalleID = $db->f("salle_id");
	}
}

function test_error() {
	global $error;
	global $formAction;
	global $formType;
	global $emploiID;
	global $fldNomDeLEmploi;
	global $fldPremierJour;
	global $fldPremierDate;
	global $fldPremierMois;
	global $fldPremierAn;
	global $fldDernierJour;
	global $fldDernierDate;
	global $fldDernierMois;
	global $fldDernierAn;
	global $fldNombreSeance;
	global $fldDuree;
	global $fldDebutMatin;
	global $fldNombreHeureMatin;
	global $fldDebutMidi;
	global $fldNombreHeureMidi;
	global $fldEtat;
	global $fldSalleID;

	if (strtolower($formAction) != "annuler" && !strlen($fldNomDeLEmploi))
	{
		$error = $error . "Il faut donner un nom pour l'emploi du temps.<br>" ;
	}
	if ($fldSalleID==NULL)
	{
		$error = $error . "Il faut choisir une salle pour ce cours.<br>" ;
	}
	
}

function lister() 
{
	global $db;
	global $sFileName;
	$iRecordsPerPage = 10;
	$iCounter = 0;
	$iPage = 0;
	$iNumPage;
	$bEof = false;

	$sSQL = "SELECT * FROM Emploi";
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
		$fldEmploiID = $db->f("emploi_id");
		$fldNomDeLEmploi = $db->f("nom_de_lemploi");
		$fldPremierJour = $db->f("premier_jour");
		$fldDernierJour = $db->f("dernier_jour");
		$fldNombreSeance = $db->f("nombre_seance");
		$fldDuree = $db->f("duree");
		$fldDebutMatin = $db->f("debut_matin");
		$fldNombreHeureMatin = $db->f("nombre_heure_matin");
		$fldDebutMidi = $db->f("debut_midi");
		$fldNombreHeureMidi = $db->f("nombre_heure_midi");
		$fldEtat = $db->f("etat");
		$fldSalleID = $db->f("salle_id");
		$nextRecord = $db->next_record();
?>
    <tr> 
      <td width="6%" height="21"> 
        <div align="center"> 
          <?php echo "<input type =\"checkbox\" name=\"skill_set[$fldEmploiID]\">"; ?>
        </div>
      </td>
      <td width="25%" height="21"> 
        <div align="center"><a href="adminEmploiCreation.php?EmploiID=<?php echo  $fldEmploiID ?>">&nbsp;<?php echo  $fldNomDeLEmploi ?></a></div>
      </td>
      <td width="30%" height="21"> 
        <div align="center">&nbsp;<?php echo  $fldEtat ?></div>
      </td>
      <td width="24%" height="21"> 
        <div align="center"><?php echo  $fldDuree ?>&nbsp;minutes</div>
      </td>
      <td width="20%" height="21"> 
        <div align="center"><a href="adminEmploiChangerEtat.php?EmploiID=<?php echo  $emploiID ?>">Changer Etat	</a></div>
      </td>
      <td width="10%" height="21"> 
        <div align="center"><a href="adminEmploiCopier.php?EmploiID= <?php echo  $$fldEmploiID ?>">&nbsp;Copier</div>
      </td>
      <td width="10%" height="21"> 
        <div align="center"><a href="adminEmploiParametre.php?EmploiID= <?php echo  $fldEmploiID ?>">&nbsp;Modifier</div>
      </td>
    </tr>
<?php
		$iCounter++;
	}	// end of While loop 	?>
    <tr bordercolor="#CC9900" bgcolor="#CC9900"> 
      <td colspan="7" height="29"> 
        <div align="right"><b>
<?php
		$bEof = $nextRecord;
		if($bEof || $iPage != 1) {
			if ($iPage == 1) {	?>
				<font>Precedente</font>
<?php		} 
		    else { ?>
				<a href="adminListeEmploi.php?PageNumber=<?php echo $iPage-1?>">Pr&eacute;c&eacute;dent</a> 
<?php		}
			echo "&nbsp;[&nbsp;page " . $iPage . "/". $iNumPage . "&nbsp;]&nbsp;";
			if (!$bEof) {	?>
				<font>Suivante</font>
<?php		}
			else { ?>
				<a href="adminListeEmploi.php?PageNumber=<?php echo $iPage+1?>">Suivante</a>
<?php		}
		}	?>
		 &nbsp;</b></div>
      </td>
    </tr>
<?php
} // end of function
?>