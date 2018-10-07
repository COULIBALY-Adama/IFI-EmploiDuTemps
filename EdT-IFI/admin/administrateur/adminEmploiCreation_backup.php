<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");
	$error = "";
	$emploiID = get_param("EmploiID");
	$fldNomDeLEmploi;
	$fldPremierJour;
	$fldPremierDate;
	$fldPremierMois;
	$fldPremierAn;
	$fldDernierJour;
	$fldDernierDate;
	$fldDernierMois;
	$fldDernierAn;
	$fldNombreSeance;
	$fldDuree;
	$fldDebutMatin;
	$fldNombreHeureMatin;
	$fldDebutMidi;
	$fldNombreHeureMidi;
	$fldEtat;
	$fldSalleID;

	get_info();
	
	if ($submit) // do action
		switch ($submit) {
			case "Etape Precedent":
				header("Location: adminEmploiCours.php?EmploiID=" . $emploiID);
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
<title>Operation sur l'Emploi du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="7" height="32">Semaine: 
	  <input type="hidden" name="EmploiID" value="<?php echo  $emploiID ?>">
      <select name="ListeSemaine">
		<?php
		for ($i=1; $i<=$fldNombreDeSemaine; $i++) {
			echo "<option value=\"" . $i . "\"";
			if ($i==$semainselected) echo "SELECTED ";
			echo ">" . $i . "</option><br>";
		}
		?>
      </select>
      </td>
    </tr>
  </table>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#6666FF" height="192" align="center">
    <tr bordercolor="#FFCCCC" bgcolor="#CCCCFF"> 
      <td width="17%"> 
        <div align="center"><font color="#000033"><b>Periodes</b></font></div>
      </td>
      <td width="14%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>Lundi</b></font></a></div>
      </td>
      <td width="12%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>Mardi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>Mercredi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>Jeudi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>Vendredi</b></font></a></div>
      </td>
      <td width="18%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>Samedi</b></font></a></div>
      </td>
    </tr>
    <tr bordercolor="#FFCCCC" bgcolor="#CCCCFF"> 
      <td width="17%"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFCCCC"><font color="#FFFFFF"><font color="#000033">&nbsp;</font></font></font></b></font></div>
      </td>
      <td width="14%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>1/10/2002</b></font></a></div>
      </td>
      <td width="12%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>2/10/2002</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>3/10/2002</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>4/10/2002</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>5/10/2002</b></font></a></div>
      </td>
      <td width="18%"> 
        <div align="center"><a href="adminEmploiCreationJour.php"><font color="#000033"><b>6/10/2002</b></font></a></div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="32"> 
        <div align="center">09h00-10h00</div>
      </td>
      <td width="14%" height="32"> 
        <div align="left"> &nbsp; CORBA</div>
      </td>
      <td width="12%" height="32"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="32"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="32"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="32"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="18%" height="32"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="30"> 
        <div align="center">10h00-11h00</div>
      </td>
      <td width="14%" height="30"> 
        <div align="left"> &nbsp;&nbsp;CORBA&nbsp;</div>
      </td>
      <td width="12%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="18%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="31"> 
        <div align="center">10h00-12h00</div>
      </td>
      <td width="14%" height="31"> 
        <div align="left">&nbsp; CORBA</div>
      </td>
      <td width="12%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="18%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td height="26" width="17%">&nbsp;</td>
      <td height="26" width="14%">&nbsp;</td>
      <td height="26" width="12%">&nbsp;</td>
      <td height="26" width="13%">&nbsp;</td>
      <td height="26" width="13%">&nbsp;</td>
      <td height="26" width="13%">&nbsp;</td>
      <td height="26" width="18%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="17%" height="28"> 
        <div align="center">14h30-15h30</div>
      </td>
      <td width="14%" height="28"> &nbsp;&nbsp;Synthese d'Image</td>
      <td width="12%" height="28">&nbsp;</td>
      <td width="13%" height="28">&nbsp;</td>
      <td width="13%" height="28">&nbsp;</td>
      <td width="13%" height="28">&nbsp;</td>
      <td width="18%" height="28">&nbsp;</td>
    </tr>
    <tr> 
      <td width="17%" height="27"> 
        <div align="center">15h30-16h30</div>
      </td>
      <td width="14%" height="27">&nbsp;&nbsp;Synthese d'Image</td>
      <td width="12%" height="27">&nbsp;</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="18%" height="27">&nbsp;</td>
    </tr>
    <tr> 
      <td width="17%" height="32"> 
        <div align="center">16h30-17h30</div>
      </td>
      <td width="14%" height="32">&nbsp;&nbsp;Synthese d'Image</td>
      <td width="12%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="18%" height="32">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="7" height="44"> 
        <div align="left"></div>
        <input type="submit" name="submit" value="Inserer une nouvelle semaine &agrave; numero">
        <input type="text" name="textfield" value="1000" size="15">
        &nbsp;&nbsp;&nbsp; 
        <input type="checkbox" name="checkbox" value="checkbox" checked>
        Avec des donnees de la semaine courrante. </td>
    </tr>
    <tr> 
      <td colspan="7" height="39"> 
        <input type="submit" name="submit" value="Supprimer la Semaine courrante">
      </td>
    </tr>
    <tr>
      <td colspan="7" height="39">
        <input type="submit" name="submit" value="Etape Precedent">
        <a href="adminEmploiCours.php"> Etape Precedent</a></td>
    </tr>
  </table>
  <p>&nbsp;</p></form>
</body>
</html>


<?php 

function get_info() {
	global $db;
	global $emploiID;
	global $fldNomDeLEmploi;
	global $fldNombreDeSemaine;
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

	$sWhere .= "emploi_id=" . tosql($emploiID, "Number");
	$sSQL = "SELECT * FROM Emploi WHERE " . $sWhere;
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploi = $db->f("nom_de_lemploi");
	$fldNombreDeSemaine = $db->f("nombre_de_semaine");
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

function dow($ymd)
{
	list($y,$m,$d) = sscanf($ymd, "%d-%d-%d");
	return date("l", mktime(0,0,0,$m, $d, $y));
}

function days_of_month($m, $y)
{
	$ds[12];
	if (($y%400)==0 || (($y%4)==0 && ($y%100)!=0)) 
		$nombreDay = "31:29:31:30:31:30:31:31:30:31:30:31";
	else
		$nombreDay = "31:28:31:30:31:30:31:31:30:31:30:31";
	list($ds[0],$ds[1],$ds[3],$ds[4],$ds[5],$ds[6],$ds[7],$ds[8],$ds[9],$ds[10],$ds[11],$ds[12]) = sscanf($nombreDay,"%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d");
	return $ds[$m-1];	
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
				<font>Precedent</font>
<?php		} 
		    else { ?>
				<a href="adminListeEmploi.php?PageNumber=<?php echo $iPage-1?>">Pr&eacute;c&eacute;dent</a> 
<?php		}
			echo "&nbsp;[&nbsp;page " . $iPage . "/". $iNumPage . "&nbsp;]&nbsp;";
			if (!$bEof) {	?>
				<font>Suivant</font>
<?php		}
			else { ?>
				<a href="adminListeEmploi.php?PageNumber=<?php echo $iPage+1?>">Suivant</a>
<?php		}
		}	?>
		 &nbsp;</b></div>
      </td>
    </tr>
<?php
} // end of function
?>