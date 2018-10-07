<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	$error = "";
	$emploiID = get_param("EmploiID");
	$semaineselected = get_param("SemaineSelected");
	if (!$semaineselected) $semaineselected=1;
	
	// chercher nom de l'emploi du temps
	$sSQL = "SELECT nom_de_lemploi FROM Emploi WHERE emploi_id=" . tosql($emploiID, "Text");
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploiDuTemps = $db->f("nom_de_lemploi");

	// déclarer des variables globales
	$fldNombreDeSemaine;
	$fldNomDeLEmploi;
	$fldPremierJour;
	$fldPremierDate;
	$fldPremierMois;
	$fldPremierAn;
	$fldNombreSeance;
	$fldDuree;
	$fldDebutMatin;
	$fldNombreHeureMatin;
	$fldDebutMidi;
	$fldNombreHeureMidi;
	$fldEtat;
	$fldSalleID;

	get_info();
	$submit = get_param("submit");  //Quang added	
	if ($submit) // do action
		switch ($submit) {
			case "Etape Precedente":
				header("Location: adminEmploiCours.php?EmploiID=" . $emploiID);
				break;
 		    case "Saisie Rapide":
				header("Location: adminEmploiCreationRapide.php?EmploiID=" . $emploiID . "&SemaineSelected=" . $semaineselected);
				break;
			case "Supprimer":
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					//if ($id == get_session("UserID")) continue;
					$sWhere = "emploi_id=" . tosql($id, "Text");
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
<form method="POST" action="adminEmploiCreation.php" name="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="7" height="32" bgcolor="#000000"> 
        <div align="center"><b><font color="#00FF00"><?php echo $fldNomDeLEmploiDuTemps?></font></b></div>
      </td>
    </tr>
    <tr> 
      <td colspan="7" height="32" bgcolor="#00FFFF">Semaine: 
        <input type="hidden" name="EmploiID" value="<?php echo  $emploiID ?>">
		<input type="hidden" name="SemaineSelected" value="<?php echo  $semaineselected ?>">
        <select name="ListeSemaine" OnChange="window.location.href='adminEmploiCreation.php?EmploiID=<?php echo  $emploiID ?>&SemaineSelected='+document.form1.ListeSemaine.value;">
          <?php
		for ($i=1; $i<=$fldNombreDeSemaine; $i++) {
			echo "<option value=\"" . $i . "\"";
			if ($i==$semaineselected) echo "SELECTED ";
			echo ">" . $i . "</option><br>";
		}
		?>
        </select>
        <?php	echo " du ";
			$day = getFirstDayOfWeek($semaineselected); 
			echo date_fr($day);
			for ($i=1; $i<=5; $i++) $day=inc_date($day);
			echo " au " . date_fr($day);
	  ?>
      </td>
    </tr>
  </table>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#6666FF" height="192" align="center">
    <tr bordercolor="#FFCCCC" bgcolor="#CCCCFF"> 
      <td width="10%"> 
        <div align="center"><font color="#000033"><b>Periodes</b></font></div>
      </td>
<?php	  // print title
    $day = getFirstDayOfWeek($semaineselected);
	for ($i = 2; $i<=7	; $i++) { 
?>
      <td width="15%"> 
        <div align="center"><font color="#000033"><b>&nbsp;<?php echo dow($day)?><br><?php echo date_fr($day)?></b></font></div>
      </td>
	  <?php 
		$day = inc_date($day);
	} /* end for */ ?>
    </tr>
<?php
	for ($horaireID=1; $horaireID<=$fldNombreHeureMatin; $horaireID++) { 
		// pour une semaine
		$sSQL="SELECT * FROM Emploi_horaire " . 
			  "WHERE emploi_id=" . tosql($emploiID, "Text") .
			  " AND horaire_id=" . tosql($horaireID, "Number");
		$db->query($sSQL);
		$db->next_record();
		$debut = $db->f("debut");
		$fin = $db->f("fin");
?>
    <tr> 
      <td width="12%" height="32"> 
        <div align="center"><?php echo  substr($debut,0,5) ?>-<?php echo  substr($fin,0,5) ?></div>
      </td>
	  <?php 
		$day = getFirstDayOfWeek($semaineselected);
		$jourID = getFirstJourID($semaineselected);
		for ($j=2; $j<=7; $j++) { // pour une ligne
	  ?>
		  <td width="14%" height="32"> 
			<div align="left"><center><a href="adminEmploiSeanceInfo.php?EmploiID=<?php echo  $emploiID ?>&JourID=<?php echo  $jourID ?>&HoraireID=<?php echo  $horaireID ?>&SemaineSelected=<?php echo $semaineselected?>&RetPage=adminEmploiCreationRapide.php">
			<?php 
				$sSQL="SELECT * FROM Emploi_jour " . 
					  "WHERE emploi_id=" . tosql($emploiID, "Text") .
					 " AND jour_id=" . tosql($jourID, "Number") .
					 " AND horaire_id=" . tosql($horaireID, "Number");
				$db->query($sSQL);
				$db->next_record();
				$coursID = $db->f("cours_id");
				$sSQL="SELECT * FROM Cours WHERE cours_id=" . tosql($coursID, "Text");
				$db->query($sSQL);
				$db->next_record();
				$fldNomDeCours = $db->f("nom_de_cours");
				if (strlen($fldNomDeCours))
					echo $fldNomDeCours;
				else 
					echo "vide";
			?>
			</a></center></div>
		  </td>
	  <?php
			$day = inc_date($day);
			$jourID++;
		} // end une ligne
	  ?>
    </tr>
<?php } /* matin */?>
    <tr> 
      <td height="6" width="10%">&nbsp;</td>
      <td height="6" width="15%">&nbsp;</td>
      <td height="6" width="15%">&nbsp;</td>
      <td height="6" width="15%">&nbsp;</td>
      <td height="6" width="15%">&nbsp;</td>
      <td height="6" width="15%">&nbsp;</td>
      <td height="6" width="15%">&nbsp;</td>
    </tr>
<?php
	for ($horaireID=1+5; $horaireID<=$fldNombreHeureMidi+5; $horaireID++) { 
		// pour une semaine
		$sSQL="SELECT * FROM Emploi_horaire " . 
			  "WHERE emploi_id=" . tosql($emploiID, "Text") .
			  " AND horaire_id=" . tosql($horaireID, "Number");
		$db->query($sSQL);
		$db->next_record();
		$debut = $db->f("debut");
		$fin = $db->f("fin");
?>
    <tr> 
      <td width="12%" height="32"> 
        <div align="center"><?php echo  substr($debut,0,5) ?>-<?php echo  substr($fin,0,5) ?></div>
      </td>
	  <?php 
		$day = getFirstDayOfWeek($semaineselected);
		$jourID = getFirstJourID($semaineselected);
		for ($j=2; $j<=7; $j++) { // pour une ligne
	  ?>
		  <td width="14%" height="32"> 
			<div align="left"><center><a href="adminEmploiSeanceInfo.php?EmploiID=<?php echo $emploiID?>&JourID=<?php echo  $jourID ?>&HoraireID=<?php echo  $horaireID ?>&SemaineSelected=<?php echo $semaineselected?>&RetPage=adminEmploiCreationRapide.php">
			<?php 
				$sSQL="SELECT * FROM Emploi_jour " . 
					  "WHERE emploi_id=" . tosql($emploiID, "Text") .
					 " AND jour_id=" . tosql($jourID, "Number") .
					 " AND horaire_id=" . tosql($horaireID, "Number");
				$db->query($sSQL);
				$db->next_record();
				$coursID = $db->f("cours_id");
				$sSQL="SELECT * FROM Cours WHERE cours_id=" . tosql($coursID, "Text");
				$db->query($sSQL);
				$db->next_record();
				$fldNomDeCours = $db->f("nom_de_cours");
				if (strlen($fldNomDeCours))
					echo $fldNomDeCours;
				else 
					echo "vide";
			?>
			</a></center></div>
		  </td>
	  <?php
			$day = inc_date($day);
			$jourID++;
		} // end une ligne
	  ?>
    </tr>
<?php } /* midi */?>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

    <tr bgcolor="#CCFFCC"> 
      <td colspan="7" height="26" bgcolor="#00FFAA"> 
        <div align="right">
          <?php if ($semaineselected>1) { ?>
          <a href="adminEmploiCreation.php?SemaineSelected=<?php echo  $semaineselected-1?>&EmploiID=<?php echo $emploiID?>"><b>Precedente</b></a>
          <?php } else echo "Precedente" ?>
          [<b>&nbsp;
          <?php echo $semaineselected?>
          &nbsp;</b>] 
          <?php if ($semaineselected<$fldNombreDeSemaine) { ?>
          <a href="adminEmploiCreation.php?SemaineSelected=<?php echo  $semaineselected + 1 ?>&EmploiID=<?php echo $emploiID?>"><b>Suivante</b></a>
          <?php } else echo "Suivante"; ?>
        </div>
      </td>
    </tr>

    <tr> 
      <td colspan="4" height="50"> 
        <input type="submit" name="submit" value="Etape Precedente">
      </td>
      <td colspan="3" height="50" align="RIGHT"> 
		<input type="submit" name="submit" value="Saisie Rapide">
      </td>
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
	global $fldNombreSeance;
	global $fldDuree;
	global $fldDebutMatin;
	global $fldNombreHeureMatin;
	global $fldDebutMidi;
	global $fldNombreHeureMidi;
	global $fldEtat;
	global $fldSalleID;

	$sWhere .= "emploi_id=" . tosql($emploiID, "Text");
	$sSQL = "SELECT * FROM Emploi WHERE " . $sWhere;
	$db->query($sSQL);
	$db->next_record();
	$fldNomDeLEmploi = $db->f("nom_de_lemploi");
	$fldNombreDeSemaine = $db->f("nombre_de_semaine");
	$fldPremierJour  = $db->f("premier_jour");
	list($fldPremierAn, $fldPremierMois, $fldPremierDate) = sscanf($fldPremierJour,"%d-%d-%d");
	$fldNombreSeance = $db->f("nombre_seance");
	$fldDuree = $db->f("duree");
	$fldDebutMatin = $db->f("debut_matin");
	$fldNombreHeureMatin = $db->f("nombre_heure_matin");
	$fldDebutMidi = $db->f("debut_midi");
	$fldNombreHeureMidi = $db->f("nombre_heure_midi");
	$fldEtat = $db->f("etat");
	$fldSalleID = $db->f("salle_id");
}

function getFirstDayOfWeek($week) {
	global $fldNombreDeSemaine;
	global $fldPremierJour;
	global $fldPremierDate;
	global $fldPremierMois;
	global $fldPremierAn;
	global $fldNombreSeance;
	global $fldDuree;
	global $fldDebutMatin;
	global $fldNombreHeureMatin;
	global $fldDebutMidi;
	global $fldNombreHeureMidi;

	$i = $fldPremierJour;
	$nombreJour = $week * 7 - 7;
	while ($nombreJour!=0) {
		$nombreJour--;
		$i = inc_date($i);
	}
	return $i;
}

function getFirstJourID($week) {
	$nombreJour = $week * 7 - 7;
	return $nombreJour;
}

function inc_date($day) {
	list($y, $m, $d) = sscanf($day, "%d-%d-%d");
	$days = days_of_month($m, $y);
	if ($d == ($days+0)) {
		$d = 1;
		if ($m == 12) {
			$m = 1;
			$y++;
		}
		else $m++;
	}
	else
		$d++;
	return $y . "-" . $m . "-" . $d;
}

function date_fr($ymd) {
	list($y, $m, $d) = sscanf($ymd, "%d-%d-%d");
	return $d . "-" . $m . "-" . $y;
}

function dow($ymd)
{
	$nomDeJour[0]="Dimanche";
	$nomDeJour[1]="Lundi";
	$nomDeJour[2]="Mardi";
	$nomDeJour[3]="Mercredi";
	$nomDeJour[4]="Jeudi";
	$nomDeJour[5]="Vendredi";
	$nomDeJour[6]="Samedi";
	list($y,$m,$d) = sscanf($ymd, "%d-%d-%d");
	$dayID = date("w", mktime(0,0,0,$m, $d, $y));
	return $nomDeJour[$dayID];
}

function days_of_month($m, $y)
{
	$ds[12];
	if (($y%400)==0 || (($y%4)==0 && ($y%100)!=0)) 
		$nombreDay = "31:29:31:30:31:30:31:31:30:31:30:31";
	else
		$nombreDay = "31:28:31:30:31:30:31:31:30:31:30:31";
	list($ds[0],$ds[1],$ds[2],$ds[3],$ds[4],$ds[5],$ds[6],$ds[7],$ds[8],$ds[9],$ds[10],$ds[11]) = sscanf($nombreDay,"%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d");
	return $ds[$m-1];	
}

function test_error() {
	global $error;
	global $formAction;
	global $formType;
	global $emploiID;
	global $fldNomDeLEmploi;
	global $fldNombreDeSemaine;
	global $fldPremierJour;
	global $fldPremierDate;
	global $fldPremierMois;
	global $fldPremierAn;
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
?>
