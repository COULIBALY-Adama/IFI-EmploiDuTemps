<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");

	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$error = "";
	$emploiID = get_param("EmploiID");
	$fldEmploiID = $emploiID;

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
<title>Changer Etat de l'Emploi du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="65">
    <tr bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td colspan="2" height="37"> 
        <div align="center"><font color="#FFFFFF"><b>Changer l'Etat de l'Emploi du Temps</b></font></div>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="14">&nbsp;</td>
      <td width="52%" height="14">&nbsp;</td>
    </tr>
    <tr> 
      <td width="48%" height="2"> 
        <div align="right">
          <p>Emploi du Temps: </p>
          </div>
      </td>
      <td width="52%" height="2"> &nbsp; 
        <select name="select">
          <option>TKB-P6-S3</option>
          <option>TKB-P7-S3</option>
        </select>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="14"> 
        <div align="right">Etat: </div>
      </td>
      <td width="52%" height="14">&nbsp; 
          <select name="ListeEtat">
            <option value="tous" <?php if ($etatselected=="tous") echo " SELECTED " ?>>de tous les etats</option>
            <option value="inactif" <?php if ($etatselected=="inactif") echo " SELECTED " ?>>inactif</option>
            <option value="creer" <?php if ($etatselected=="creer") echo " SELECTED " ?>>en cours de creation</option>
            <option value="actif" <?php if ($etatselected=="actif") echo " SELECTED " ?>>actif</option>
            <option value="a corriger" <?php if ($etatselected=="a corriger") echo " SELECTED " ?>>a corriger</option>
            <option value="modifier" <?php if ($etatselected=="modifier") echo " SELECTED " ?>>en cours de modification</option>
          </select>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="14">&nbsp;</td>
      <td width="52%" height="14">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" height="14"> 
        <div align="center">
          <input type="submit" name="Submit" value="Effectuer le changement">
        </div>
      </td>
    </tr>
  </table>
  <p> <br>
    &nbsp;</p>
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
		$fldNombreDeSemaine = strip(get_param("nombreDeSemaine"));
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
		$sWhere .= "emploi_id=" . tosql($fldEmploiID, "Text");
		$sSQL = "SELECT * FROM Emploi WHERE " . $sWhere;
		$db->query($sSQL);
		$db->next_record();
		$fldNomDeLEmploi = $db->f("nom_de_lemploi");
		$fldNombreDeSemaine = $db->f("nombre_de_semaine");
		$fldPremierJour  = $db->f("premier_jour");
		list($fldPremierAn,$fldPremierMois, $fldPremierDate) = sscanf($fldPremierJour,"%d-%d-%d");
		$fldDernierJour = $db->f("dernier_jour");
		list($fldDernierAn, $fldDernierMois, $fldDernierDate) = sscanf($fldDernierJour,"%d-%d-%d");
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

	$durreH = floor($fldDuree/60);
	$durreM = $fldDuree%60;

	$preSQL = "INSERT INTO Emploi_horaire (horaire_id, emploi_id, debut, fin, seance) VALUES (" ;
	if ($fldNombreHeureMidi != NULL) {
		$fldDebut = $fldDebutMatin;
		$fldSeance = 1;
		for ($fldHoraireID = 1; $fldHoraireID <= $fldNombreHeureMatin; $fldHoraireID++) {
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
		for ($fldHoraireID = 1; $fldHoraireID <= $fldNombreHeureMidi; $fldHoraireID++) {
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

function form1_Action($action) {
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
						"dernier_jour, " . 
						"nombre_seance, " . 
						"duree, " . 
						"debut_matin, " . 
						"nombre_heure_matin, " . 
						"debut_midi, " . 
						"nombre_heure_midi, " . 
						"etat, " . 
						"salle_id) " . 
					"VALUES (" .
						tosql($fldEmploiID, "Text") . "," . 
						tosql($fldNomDeLEmploi, "Text") . "," . 
						tosql($fldNombreDeSemaine, "Number") . "," . 
						tosql($fldPremierJour, "Date") . "," . 
						tosql($fldDernierJour, "Date") . "," . 
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
				  ", dernier_jour=" . tosql($fldDernierJour, "Date") . 
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
			if ($formType=="ajouter") {
				genererListeDHoraires();
			}
			// go next
			header("Location: adminEmploiCours.php?EmploiID=" . $emploiID);
			return;
		case "annuler":
			header("Location: adminListeEmploi.php");
			return;
	}
}
	
?>

