<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3); //, "../index.php");

	$emploiID = get_param("EmploiID");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
//printf ("Debug :EmploiID = %s, FormName = %s, FormAction = %s, FormType =%s\n", $emploiID, $formName, $formAction, $formType); // Quang added
	$error = "";
	$fldEmploiID = $emploiID;
	$fldNomDeLEmploi;
	$fldNombreDeSemaine;
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

	form1_get_info($formAction);
	switch (strtolower($formName)) {
		case "form1":
			form1_Action($formAction);
			break;
		case "form2":
			// réservé
			break;
	}
?>

<html>
<head>
<title>Parametre de l'Emploi du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="POST" action="adminEmploiParametre.php" name="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="267">
    <tr bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td colspan="2"> 
        <div align="center"><font color="#FFFFFF"><b>Parametres Generales de l'Emploi 
          du Temps</b></font></div>
      </td>
    </tr>
<?php if (strlen($error)) { ?>
    <tr> 
      <td width="33%">&nbsp;</td>
      <td width="67%">&nbsp;</td>
    </tr>
    <tr bgcolor="#33FFFF" bordercolor="#006699"> 
      <td colspan="3" height="30"> 
        <div align="center"><b><font color="#FF0000"><?php echo  $error?></font></b></div>
      </td>
    </tr>
<?php } ?>
    <tr> 
      <td width="33%">&nbsp;</td>
      <td width="67%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="33%" height="39"> 
        <div align="right">Emploi ID: </div>
      </td>
<?php if ($formType!="ajouter") { ?>
      <td width="67%" height="39">&nbsp;&nbsp; 
        <B><?php echo $fldEmploiID ?></B>
		<input type="hidden" name="EmploiID" value="<?php echo $fldEmploiID ?>" 
      </td>
<?php } else { ?>
      <td width="80%" height="39">&nbsp;&nbsp; 
        <input type="text" name="EmploiID" value="<?php echo  $fldEmploiID ?>" size="10" maxlength="10">
      </td>
<?php } ?>
    </tr>
    <tr> 
      <td width="33%" height="39"> 
        <div align="right">Nom de l'emploi du temps: </div>
      </td>
      <td width="80%" height="39">&nbsp;&nbsp; 
        <input type="text" name="nomDeLEmploi" value="<?php echo  $fldNomDeLEmploi ?>" size="50" maxlength="50">
      </td>
    </tr>
    <tr> 
      <td width="33%" height="39"> 
        <div align="right">Nombre de semaines: </div>
      </td>
      <td width="67%" height="39">&nbsp;&nbsp; 
        <input type="text" name="nombreDeSemaine" value="<?php echo  $fldNombreDeSemaine ?>">
      </td>
    </tr>
    <tr> 
      <td width="33%" height="38"> 
        <div align="right">Nombre de Seances par Jour: </div>
      </td>
      <td width="67%" height="38">&nbsp;&nbsp; 
        <select name="nombreSeance">
		<?php 
		for ($i=1; $i<4; $i++) {
			echo "<option value=\"" . $i . "\"";
			if ($i==$fldNombreSeance) echo " SELECTED ";
			echo ">" . $i . "</option><br>";
		}
		?>
        </select>
      </td>
    </tr>
    
	<tr> 
      <td width="33%" height="37"> 
        <div align="right">Premier jour: </div>
      </td>
      <td width="67%" height="37"> &nbsp;&nbsp; 
        <input type="text" name="premierDate" maxlength="2" value="<?php echo  tohtml($fldPremierDate) ?>" size="6">
      <select name="premierMois">
		<?php 
		for ($i=1; $i<13; $i++) {
			echo "<option value=\"" . $i . "\"";
			if ($i==$fldPremierMois) echo " SELECTED ";
			echo ">" . $i . "</option><br>";
		}
		?>
      </select>

		<input type="text" name="premierAn" maxlength="4" value="<?php echo  tohtml($fldPremierAn) ?>" size="10" >
        &nbsp; &nbsp;(dd-mm-yyyy, Lundi de la premiere semaine) 
    </tr>
    <tr> 
      <td width="33%" height="39"> 
        <div align="right">Local: </div>
      </td>
      <td width="67%" height="39">&nbsp;&nbsp; 
        <select name="salleID">
	  <OPTION value=NULL><CENTER>Cliquer pour choisir</CENTER></OPTION>
<?php
		$sSQL = "SELECT * FROM Salle";
		$db->query($sSQL);
		$nextRecord = $db->next_record();
		while ($nextRecord) {
			$fld_Salle_ID = $db->f("salle_id");
			$fld_Nom_De_Salle = $db->f("nom_de_salle");
			$nextRecord = $db->next_record();
			echo "<OPTION value=\"" . $fld_Salle_ID . "\"";
			if ($fld_Salle_ID==$fldSalleID) echo(" SELECTED ");
			echo ">" . $fld_Nom_De_Salle .  "</OPTION> <br>";
		}
?>
		</select>
	  </td>
    </tr>
    <tr> 
      <td width="33%" height="41"> 
        <div align="right">Durre d'une heure:</div>
      </td>
      <td width="67%" height="41"> &nbsp;&nbsp; 
        <select name="duree">
          <option value="30" <?php if ($fldDuree=="30") echo "SELECTED "; ?>>30</option>
          <option value="45" <?php if ($fldDuree=="45") echo "SELECTED "; ?>>45</option>
          <option value="60" <?php if ($fldDuree=="60") echo "SELECTED "; ?>>60</option>
          <option value="90" <?php if ($fldDuree=="90") echo "SELECTED "; ?>>90</option>
          <option value="120" <?php if ($fldDuree=="120") echo "SELECTED "; ?>>120</option>
          <option value="150" <?php if ($fldDuree=="150") echo "SELECTED "; ?>>150</option>
          <option value="180" <?php if ($fldDuree=="180") echo "SELECTED "; ?>>180</option>
        </select>
      </td>
    </tr>
    <tr> 
      <td width="33%" height="39"> 
        <div align="right"><b>Matin (Seance 1):</b></div>
      </td>
      <td width="67%" height="39"> &nbsp;&nbsp;&nbsp;Debut: 
        <select name="debutMatin">
          <option> </option>
          <option value="07:00:00"  <?php if ($fldDebutMatin=="07:00:00") echo "SELECTED "; ?>>07h00</option>
          <option value="07:30:00"  <?php if ($fldDebutMatin=="07:30:00") echo "SELECTED "; ?>>07h30</option>
          <option value="08:00:00" <?php if ($fldDebutMatin=="08:00:00") echo "SELECTED "; ?>>08h00</option>
          <option value="08:30:00" <?php if ($fldDebutMatin=="08:30:00") echo "SELECTED "; ?>>08h30</option>
          <option value="09:00:00" <?php if ($fldDebutMatin=="09:00:00") echo "SELECTED "; ?>>09h00</option>
          <option value="09:30:00" <?php if ($fldDebutMatin=="09:30:00") echo "SELECTED "; ?>>09h30</option>
          <option value="10:00:00" <?php if ($fldDebutMatin==strtotime("10:00:00")) echo "SELECTED "; ?>>10h00</option>
        </select>
        Nombre d'heures: 
        <select name="nombreHeureMatin">
          <option value=NULL> </option>
			<?php 
			for ($i=1; $i<6; $i++) {
				echo "<option value=\"" . $i . "\"";
				if ($i==$fldNombreHeureMatin) echo "SELECTED ";
				echo ">" . $i . "</option><br>";
			}
			?>
        </select>
      </td>
    </tr>
    <tr> 
      <td width="33%" height="49"> 
        <div align="right"><b>Apres-midi(Seance 2):</b></div>
      </td>
      <td width="67%" height="49"> &nbsp;&nbsp;&nbsp;Debut: 
        <select name="debutMidi">
          <option> </option>
          <option value="12:00:00"  <?php if ($fldDebutMidi=="12:00:00") echo "SELECTED "; ?>>12h00</option>
          <option value="12:30:00"  <?php if ($fldDebutMidi=="12:30:00") echo "SELECTED "; ?>>12h30</option>
          <option value="13:00:00"  <?php if ($fldDebutMidi=="13:00:00") echo "SELECTED "; ?>>13h00</option>
          <option value="13:30:00"  <?php if ($fldDebutMidi=="13:30:00") echo "SELECTED "; ?>>13h30</option>
          <option value="14:00:00"  <?php if ($fldDebutMidi=="14:00:00") echo "SELECTED "; ?>>14h00</option>
          <option value="14:30:00"  <?php if ($fldDebutMidi=="14:30:00") echo "SELECTED "; ?>>14h30</option>
          <option value="15:00:00"  <?php if ($fldDebutMidi=="15:00:00") echo "SELECTED "; ?>>15h00</option>
        </select>
        Nombre d'heures: 
        <select name="nombreHeureMidi">
          <option value=NULL> </option>
			<?php 
			for ($i=1; $i<6; $i++) {
				echo "<option value=\"" . $i . "\"";
				if ($i==$fldNombreHeureMidi) echo "SELECTED ";
				echo ">" . $i . "</option><br>";
			}
			?>
        </select>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="39"> 
        <div align="center"> 
		  <input type="hidden" name="FormName" value="form1">
		  <input type="hidden" name="FormAction" value="Suivant">
		  <input type="hidden" name="FormType" value="<?php echo  $formType?>">
          <input type="submit" name="submit" value="Etape Precedente" onclick="document.form1.FormAction.value='annuler'; ">
          <input type="submit" name="submit" value="Etape Suivante" onclick="document.form1.FormAction.value='suivant'; ">
          </div>
      </td>
    </tr>
  </table>
<p>&nbsp;</p>
</form>
<p>&nbsp;</p></body>
</html>

<?php
function form1_get_info($action) {
	global $db;
	global $formType;
	global $fldEmploiID;
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
//printf ("Debug form1_get_info :EmploiID = %s, FormName = %s, FormAction = %s, FormType =%s\n", $emploiID, $formName, $formAction, $formType); // Quang added
	if (strtolower($action) == "suivant") {
		$fldNomDeLEmploi = strip(get_param("nomDeLEmploi"));
		$fldNombreDeSemaine = strip(get_param("nombreDeSemaine"));
		$fldPremierDate=strip(get_param("premierDate"));
		$fldPremierMois=strip(get_param("premierMois"));
		$fldPremierAn=strip(get_param("premierAn"));
		$fldPremierJour = $fldPremierAn . "-" . $fldPremierMois . "-" . $fldPremierDate;

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
		$sWhere .= "emploi_id=" . tosql($fldEmploiID, "Text");
		$sSQL = "SELECT * FROM Emploi WHERE " . $sWhere;
		$db->query($sSQL);
		$db->next_record();
		$fldNomDeLEmploi = $db->f("nom_de_lemploi");
		$fldNombreDeSemaine = $db->f("nombre_de_semaine");
		$fldPremierJour  = $db->f("premier_jour");
		list($fldPremierAn,$fldPremierMois, $fldPremierDate) = sscanf($fldPremierJour,"%d-%d-%d");
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
	global $db;
	global $error;
	global $formAction;
	global $formType;
	global $emploiID;
	global $fldEmploiID;
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

	if (strtolower($formAction) != "annuler" && !strlen($fldEmploiID))
	{
		$error = $error . "Il faut donner un ID pour l'emploi du temps.<br>" ;
	}
	else 
		if ($formAction=="ajouter")
		{
			$sSQL = "SELECT * FROM Emploi WHERE emploi_id=" . tosql($fldEmploiID, "Text");
			$db->query($sSQL);
			if ($db->next_record())
				$error = $error . "ID existe dans la base de donnees, Choisir un autre ID, SVP.<br>" ;
		}

	if (strtolower($formAction) != "annuler" && !strlen($fldNomDeLEmploi))
	{
		$error = $error . "Il faut donner un nom pour l'emploi du temps.<br>" ;
	}
	if ($fldSalleID==NULL)
	{
		$error = $error . "Il faut choisir une salle pour ce cours.<br>" ;
	}
	if ($fldNombreDeSemaine<=0)
	{
		$error = $error . "Il faut entrer nombre de semaine.<br>" ;
	}
	// check si le premier jour est lundi?

	if (dow_to_num($fldPremierJour)!=1)
	{
		$error = $error . "Le premier jour n'est pas lundi.<br>";
	}
}

function dow_to_num($ymd) 
{
	list($y,$m,$d) = sscanf($ymd, "%d-%d-%d");
	return date("w", mktime(0,0,0,$m, $d, $y));
}

function supprimerListeDHoraires()
{
	global $db;
	global $fldEmploiID;

	$sSQL = "DELETE FROM Emploi_horaire WHERE emploi_id=" . tosql($fldEmploiID, "Text");
	$db->query($sSQL);
}

function genererListeDHoraires()
{
	global $db;
	global $fldEmploiID;
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

	$durreH = floor($fldDuree/60);
	$durreM = $fldDuree%60;

	$preSQL = "INSERT INTO Emploi_horaire (horaire_id, emploi_id, debut, fin, seance) VALUES (" ;
	if ($fldNombreHeureMidi != NULL) {
		$fldDebut = $fldDebutMatin;
		$fldSeance = 1;
		for ($fldHoraireID = 1; $fldHoraireID <= 5; $fldHoraireID++) {
			list($h, $m, $s) = sscanf($fldDebut,"%d:%d:%d");
			$h += $durreH;
			$m += $durreM;
			$fldFin = $h . ":" . $m . ":" . $s;
  			$sSQL = $preSQL . tosql($fldHoraireID, "Number") . "," . tosql($fldEmploiID, "Text") . "," . 
				tosql($fldDebut, "Time") . "," . tosql($fldFin, "Time") . "," . tosql($fldSeance, "Time") . ")";
			$db->query($sSQL);
			$fldDebut = $fldFin;
		}
	}
	if ($fldNombreHeureMidi != NULL) {
		$fldDebut = $fldDebutMidi;
		$fldSeance = 2;
		for ($fldHoraireID = 1; $fldHoraireID <= 5; $fldHoraireID++) {
			list($h, $m, $s) = sscanf($fldDebut,"%d:%d:%d");
			$h += $durreH;
			$m += $durreM;
			$fldFin = $h . ":" . $m . ":" . $s;
			$sSQL = $preSQL . tosql($fldHoraireID+5	, "Number") . "," . tosql($fldEmploiID, "Text") . "," . 
				tosql($fldDebut, "Time") . "," . tosql($fldFin, "Time") . "," . tosql($fldSeance, "Time") . ")";
			$db->query($sSQL);
			$fldDebut = $fldFin;
		}
	}
}

function form1_Action ($action) {
	global $db;
	global $error;
	global $formType;
	global $emploiID;
	global $fldEmploiID;
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
//printf ("Debug form1_Action: EmploiID = %s, FormName = %s, FormAction = %s, FormType =%s\n", $emploiID, $formName, $formAction, $formType); // Quang added	
	switch (strtolower($action)) {
		case "suivant":
			test_error();
			if(strlen($error)) return;
			if ($formType=="ajouter") {
				$sSQL = "INSERT INTO Emploi (" .
						"emploi_id, " . 
						"nom_de_lemploi, " . 
						"nombre_de_semaine, " . 
						"premier_jour, " . 
						"nombre_seance, " . 
						"duree, " . 
						"debut_matin, " . 
						"nombre_heure_matin, " . 
						"debut_midi, " . 
						"nombre_heure_midi, " . 
						"etat, " . 
						"salle_id) " . 
					"VALUES (" .
						trim(tosql($fldEmploiID, "Text")) . "," . 
						tosql($fldNomDeLEmploi, "Text") . "," . 
						tosql($fldNombreDeSemaine, "Number") . "," . 
						tosql($fldPremierJour, "Date") . "," . 
						tosql($fldNombreSeance, "Number") . "," . 
						tosql($fldDuree, "Number") . "," . 
						tosql($fldDebutMatin, "Time") . "," . 
						tosql($fldNombreHeureMatin, "Number") . "," . 
						tosql($fldDebutMidi, "Time") . "," . 
						tosql($fldNombreHeureMidi, "Number") . "," . 
						tosql("creer", "Text") . "," . 
						tosql($fldSalleID, "Number") . 
						")";
			}
			else {
				//if ($fldEmploiID!=$emploiID) {
					// test modify EmploiID 
				//}	
				$sWhere = "emploi_id=" . tosql($emploiID, "Text");
				$sSQL = "update Emploi set " .
				  "nom_de_lemploi =" . tosql($fldNomDeLEmploi, "Text") .
				  ",nombre_de_semaine =" . tosql($fldNombreDeSemaine, "Number") .
				  ", premier_jour=" . tosql($fldPremierJour, "Date") . 
				  ", nombre_seance=" . tosql($fldNombreSeance, "Number") . 
				  ", duree=" . tosql($fldDuree, "Date") . 
				  ", debut_matin=" . tosql($fldDebutMatin, "Time") . 
				  ", nombre_heure_matin=" . tosql($fldNombreHeureMatin, "Number") . 
					", debut_midi=" . tosql($fldDebutMidi, "Time") . 
					", nombre_heure_midi=" . tosql($fldNombreHeureMidi, "Number") . 
//					", etat=" . tosql($fldEtat, "Text") . 
					", salle_id=" . tosql($fldSalleID, "Number") 
					;
				$sSQL .= " WHERE " . $sWhere;
			}
			$db->query($sSQL);
			// ceer liste d'horaire
			//if ($formType=="ajouter") {
			supprimerListeDHoraires();
			genererListeDHoraires();
			//}
			// go next
			header("Location: adminEmploiCours.php?EmploiID=" . $emploiID);
			return;
		case "annuler":
			header("Location: adminListeEmploi.php");
			return;
	}
}
	
?>

