<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");
	$error = "";
	$emploiID = get_param("EmploiID");


	$EMPLOI_ID = $emploiID;


	$semaineselected = get_param("SemaineSelected");
	$coursselected = get_param("CoursSelected");
	if (!$semaineselected) $semaineselected=1;
	$semaineacopier= get_param("ListeSemaineACopier");

	// Database Initialize
	$db1 = new DB_Sql();
	$db1->Database = DATABASE_NAME;
	$db1->User     = DATABASE_USER;
	$db1->Password = DATABASE_PASSWORD;
	$db1->Host     = DATABASE_HOST;



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
	$skill_set = get_param("skill_set"); //Quang added
	if ($submit) // do action
		switch ($submit) {
			case "Vider Semaine":
				vider_semaine($emploiID, $semaineselected);
				header("Location: adminEmploiCreationRapide.php?EmploiID=" . 
					$emploiID . "&SemaineSelected=" . $semaineselected);
				break;
			case "Supprimer Semaine":
				supprimer_semaine($emploiID, $semaineselected);
				if ($semaineselected==$fldNombreDeSemaine) 
					$semaineselected--;
				header("Location: adminEmploiCreationRapide.php?EmploiID=" . 
					$emploiID . "&SemaineSelected=" . $semaineselected);
				break;
			case "Inserer Semaine":
				inserer_semaine($emploiID, $semaineselected);
				header("Location: adminEmploiCreationRapide.php?EmploiID=" . 
					$emploiID . "&SemaineSelected=" . $semaineselected);
				break;
			case "Copier":
				copier_semaine($emploiID, $semaineselected, $semaineacopier);

				header("Location: adminEmploiCreationRapide.php?EmploiID=" . $emploiID . "&SemaineSelected=" . $semaineacopier);
				break;
			case "Etape Precedente":
				header("Location: adminEmploiCours.php?EmploiID=" . $emploiID);
				break;
			case "V i d e r":
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 

				while (list($id, $checked)=each($skill_set)) {
					list($HORAIRE_ID,$JOUR_ID) = sscanf($id, "%d:%d:");
					$JOUR_ID += 0; $HORAIRE_ID+=0;
					$sSQL = "DELETE FROM Emploi_jour WHERE emploi_id=" . tosql($EMPLOI_ID, "Text") . " AND jour_id=" . tosql($JOUR_ID, "Number") . " AND horaire_id=" . tosql($HORAIRE_ID, "Number");
					$db->query($sSQL);
				}
				header("Location: adminEmploiCreationRapide.php?EmploiID=" . 
					$emploiID . "&SemaineSelected=" . $semaineselected);
				break;
			case "Attribuer Cours":
				if ($semaineselected==NULL) break;
				if (!isset($skill_set)) break;
				reset($skill_set); // Set the internal pointer of an array to its first element 
				while (list($id, $checked)=each($skill_set)) {
					list($HORAIRE_ID,$JOUR_ID) = sscanf($id, "%d:%d:");
					$JOUR_ID += 0; $HORAIRE_ID+=0;
					$sSQL = "SELECT emploi_id FROM Emploi_jour " .
						" WHERE emploi_id=" . tosql($EMPLOI_ID, "Text") . 
						" AND jour_id=" . tosql($JOUR_ID, "Number") . " AND horaire_id=" . tosql($HORAIRE_ID, "Number");
					$db->query($sSQL);
					if ($db->next_record()) {
						$sSQL = "UPDATE Emploi_jour SET cours_id=" .
							tosql($coursselected, "Text") . "," . "salle_id=" . tosql($fldSalleID,"Number") . 
						" WHERE emploi_id=" . tosql($EMPLOI_ID, "Text") . 
						" AND jour_id=" . tosql($JOUR_ID, "Number") . " AND horaire_id=" . tosql($HORAIRE_ID, "Number");
					} else {
						$sSQL = "INSERT INTO Emploi_jour (emploi_id, jour_id, horaire_id, cours_id,salle_id) " . 
						"VALUES (" . tosql($EMPLOI_ID, "Text") . "," . tosql($JOUR_ID, "Number") . "," . tosql($HORAIRE_ID, "Number") . "," . tosql($coursselected, "Text") . "," . tosql($fldSalleID,"Number") . ")";
					}
					$db->query($sSQL);
				}
				header("Location: adminEmploiCreationRapide.php?EmploiID=" . 
					$emploiID . "&SemaineSelected=" . $semaineselected);
				break;
			case "Saisie Normale":
				header("Location: adminEmploiCreation.php?EmploiID=" . $emploiID . "&SemaineSelected=" . $semaineselected);
				break;
		}
?>
<html>
<head>
<title>Operation sur l'Emploi du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF">
<form method="POST" action="adminEmploiCreationRapide.php" name="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="7" height="32" bgcolor="#000000"> 
        <div align="center"><b><font color="#00FF00"><?php echo $fldNomDeLEmploiDuTemps?></font></b></div>
      </td>
    </tr>
    <tr> 
      <td colspan="3" height="32" bgcolor="#00FFFF">Semaine: 
        <input type="hidden" name="EmploiID" value="<?php echo  $emploiID ?>">
		<input type="hidden" name="SemaineSelected" value="<?php echo  $semaineselected ?>">
        <select name="ListeSemaine" OnChange="window.location.href='adminEmploiCreationRapide.php?EmploiID=<?php echo  $emploiID ?>&SemaineSelected='+document.form1.ListeSemaine.value;">
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
	  <td colspan="4" height="32" bgcolor="#00FFFF" align="RIGHT">		
	  <input type="hidden" name="CoursSelected" value="<?php echo  $coursselected ?>">
        <select name="ListeCours" OnChange="document.form1.CoursSelected.value = document.form1.ListeCours.value;">
		<OPTION value="NULL">&nbsp;Cliquer pour choisir</OPTION>
<?php
			$sSQL = "SELECT * FROM Emploi_cours WHERE emploi_id=" . tosql($emploiID,"Text");
			$db->query($sSQL);
			$nextRecord = $db->next_record();
			while ($nextRecord) {
				$fldCoursID = $db->f("cours_id");
				$sSQL="SELECT * FROM Cours WHERE cours_id=" . tosql($fldCoursID, "Text");
				$db1->query($sSQL);
				$db1->next_record();
				$fldNomDeCours = $db1->f("nom_de_cours");
				echo "<OPTION value=\"" . $fldCoursID . "\"";
				if ($coursselected==$fldCoursID) echo " SELECTED";
				echo ">" . $fldNomDeCours .  "</OPTION> <br>";
				$nextRecord = $db->next_record();
			}
?>
		</select>
        <input type="submit" name="submit" value="Attribuer Cours">
		<input type="submit" name="submit" value="V i d e r">
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
			</a><?php echo "<input type =\"checkbox\" name=\"skill_set[".$horaireID  . ":" . $jourID . ":" . $emploiID . "]\">"; ?></center></div>
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
			</a><?php echo "<input type =\"checkbox\" name=\"skill_set[". $horaireID . ":" . $jourID . ":" . $emploiID . "]\">"; ?></center></div>
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
          <a href="adminEmploiCreationRapide.php?SemaineSelected=<?php echo  $semaineselected-1?>&EmploiID=<?php echo $emploiID?>"><b>Précédente</b></a>
          <?php } else echo "Precedente" ?>
          [<b>&nbsp;
          <?php echo $semaineselected?>
          &nbsp;</b>] 
          <?php if ($semaineselected<$fldNombreDeSemaine) { ?>
          <a href="adminEmploiCreationRapide.php?SemaineSelected=<?php echo  $semaineselected + 1 ?>&EmploiID=<?php echo $emploiID?>"><b>Suivante</b></a>
          <?php } else echo "Suivante"; ?>
        </div>
      </td>
    </tr>

    <tr> 
      <td colspan="5" height="39"> 
        <input type="submit" name="submit" value="Etape Precedente">
        <input type="submit" name="submit" value="Vider Semaine">
        <input type="submit" name="submit" value="Inserer Semaine">
		<input type="submit" name="submit" value="Supprimer Semaine">
		<input type="submit" name="submit" value="Copier">
		<select name="ListeSemaineACopier">
          <?php
		for ($i=1; $i<=$fldNombreDeSemaine; $i++) {
			echo "<option value=\"" . $i . "\"";
			if ($i==$semaineacopier) echo "SELECTED ";
			echo ">" . $i . "</option><br>";
		}
		?>
        </select>

      </td>
      <td colspan="2" height="39" align="RIGHT"> 
        <input type="submit" name="submit" value="Saisie Normale">
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

function copier_semaine($emploiID, $semaine1, $semaine2) {
	global $db1;
	global $db;

	$jourID1 = getFirstJourID($semaine1);
	$jourID2 = getFirstJourID($semaine2);

echo $semaine1;

	$sed = "SELECT * FROM Emploi_jour WHERE " . 
			"emploi_id=" . tosql($emploiID, "Text") . " AND " .
			"jour_id >= " . tosql($jourID1, "Number") . " AND " .
			"jour_id <= " . tosql($jourID1+6, "Number");
	$db1->query($sed);
	while ($db1->next_record()) {
		$fldJourID = $db1->f("jour_id");
		$fldHoraireID = $db1->f("horaire_id");
		$fldSalleID = $db1->f("salle_id");
		$fldCoursID = $db1->f("cours_id");
		$jourid2 = $fldJourID - $jourID1 + $jourID2; 
		$sSQL = "SELECT * FROM Emploi_jour WHERE " . 
				"emploi_id=" . tosql($emploiID, "Text") . " AND " .
				"jour_id = " . tosql($jourid2, "Number") . " AND " .
				"horaire_id = " . tosql($fldHoraireID, "Number");
		$db->query($sSQL);
		if ($db->next_record()) {
			$sWhere = "emploi_id=" . tosql($emploiID, "Text");
			$sWhere .= " AND jour_id=" . tosql($jourid2, "Number");
			$sWhere .= " AND horaire_id=" . tosql($fldHoraireID, "Number");
			$sSQLupdate = "UPDATE Emploi_jour SET " .
				"cours_id=" . tosql($fldCoursID, "Text") . "," .
				"salle_id=" . tosql($fldSalleID, "Number");
			$sSQLupdate = $sSQLupdate .	" WHERE " . $sWhere;
			$db->query($sSQLupdate);
		}
		else {
			$sSQLadd = "INSERT INTO Emploi_jour (" .
					"emploi_id, " . 
					"cours_id, " . 
					"salle_id, " . 
					"horaire_id, " . 
					"jour_id) " . 
				"VALUES (" .
					tosql($emploiID, "Text") . "," . 
					tosql($fldCoursID, "Text") . "," . 
					tosql($fldSalleID, "Number") . "," . 
					tosql($fldHoraireID, "Number") . "," . 
					tosql($jourid2, "Number") .")";
			$db->query($sSQLadd);
		}
	}
}

function vider_semaine($emploiID, $semaine) {
	global $db;
	$jourID = getFirstJourID($semaine);
	$sSQL	=	"DELETE FROM Emploi_jour WHERE " .
				" emploi_id = " . tosql($emploiID, "Text") . " AND ";
	for ($i=0; $i<=6; $i++) {
		$sSQLs = $sSQL . " jour_id = " . tosql($jourID, "Number");
		$db->query($sSQLs);
		$jourID++;
	}
}

function inserer_semaine($emploiID,$semaine) {
	global $db;
	$jourID = getFirstJourID($semaine);
	// augmenter jour_id 10000 pour éviter la rédondance
	$sSQL	=	"UPDATE Emploi_jour SET jour_id=jour_id+1000 WHERE " 		  ." emploi_id = " . tosql($emploiID, "Text") . " AND " .
				" jour_id >=" . tosql($jourID,"Number");
	$db->query($sSQL);
	// diminuer jour_id
	$sSQL	=	"UPDATE Emploi_jour SET jour_id=jour_id-993 WHERE " 		  ." emploi_id = " . tosql($emploiID, "Text") . " AND " .
				" jour_id >=" . tosql($jourID,"Number");
	$db->query($sSQL);
	// augmenter le nombre de semaines
	$sSQL	=	"UPDATE Emploi SET nombre_de_semaine=nombre_de_semaine+1 WHERE " .
				" emploi_id=" . tosql($emploiID, "Text");
	$db->query($sSQL);
}

function supprimer_semaine($emploiID,$semaine) {
	global $db;
	vider_semaine($emploiID, $semaine);
	$jourID = getFirstJourID($semaine+1);
	// diminuer jour_id
	$sSQL	=	"UPDATE Emploi_jour SET jour_id=jour_id-7 WHERE " .
				" emploi_id = " . tosql($emploiID, "Text") . " AND " .
				" jour_id >= " . tosql($jourID,"Number");
	$db->query($sSQL);
	// faire descendre le nombre de semaines
	$sSQL	=	"UPDATE Emploi SET nombre_de_semaine=nombre_de_semaine-1 WHERE " .
				" emploi_id = " . tosql($emploiID, "Text");
	$db->query($sSQL);
}


?>
