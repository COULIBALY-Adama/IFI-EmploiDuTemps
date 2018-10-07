<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");
	$sFileName = "adminListeEmploi.php";
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$iPage = get_param("PageNumber");
	$etatselected = get_param("EtatSelected");
	$emploiID = get_param("EmploiID");
	if (!strlen($etatselected)) $etatselected="tous";
	$error = "";
	
	if ($formAction=="ChangerEtat") {
		$etatChanged = get_param("EtatChanged");
		if ($etatChanged!="tous") {
			$sWhere = "emploi_id=" . tosql($emploiID, "Text");
			$sSQL = "UPDATE Emploi SET etat=" . tosql($etatChanged, "Text");
			$sSQL .= " WHERE " . $sWhere;
//			$db->query($sSQL);
			if ($etatselected != "tous") $etatselected = $etatChanged;
		}
	}
	if ($submit) // do action
		switch ($submit) {
			case "Creer un Nouveau Emploi du Temps":
				header("Location: adminEmploiParametre.php?FormType=ajouter");
				break;
		}
?>

<html>
<head>
<title>Liste des Emplois du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="POST" action="adminListeEmploi.php" name="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="65">
    <tr bordercolor="#FFFFFF" bgcolor="#005599"> 
      <td colspan="2" height="37"> 
        <div align="center"><font color="#FFFFFF" size="4"><b>Liste des Emploi du Temps</b></font></div>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="36"> 
        <div align="center">Afficher les emplois du temps: 
          <select name="ListeEtat" OnChange="window.location.href='adminListeEmploi.php?EtatSelected=' + document.form1.ListeEtat.value;">
            <option value="tous" <?php if ($etatselected=="tous") echo " SELECTED " ?>>de tous les etats</option>
            <option value="inactif" <?php if ($etatselected=="inactif") echo " SELECTED " ?>>inactif</option>
            <option value="creer" <?php if ($etatselected=="creer") echo " SELECTED " ?>>en cours de creation</option>
            <option value="actif" <?php if ($etatselected=="actif") echo " SELECTED " ?>>actif</option>
            <option value="a corriger" <?php if ($etatselected=="a corriger") echo " SELECTED " ?>>a corriger</option>
            <option value="modifier" <?php if ($etatselected=="modifier") echo " SELECTED " ?>>en cours de modification</option>
          </select>
        </div>
      </td>
    </tr>
  </table>
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#008899"> 
      <td width="6%">&nbsp;</td>
      <td width="30%"> 
        <div align="center"><b><font color="#FFFFFF">Nom</font></b></div>
      </td>
      <td width="20%"> 
        <div align="center"><b><font color="#FFFFFF">Etat</font></b></div>
      </td>
      <td width="14%"> 
        <div align="center"><b><font color="#FFFFFF">Duree</font></b></div>
      </td>
      <td width="30%" colspan="3"> 
        <div align="center"><b><font color="#FFFFFF">Action</font></b></div>
      </td>
    </tr>
	<?php lister(); ?>
  </table>
  <p> 
    <input type="submit" name="submit" value="Creer un Nouveau Emploi du Temps">
  </p>
</form>
<p>&nbsp;</p></body>
</html>

<?php 
function lister() 
{
	global $db;
	global $etatselected;
	$iRecordsPerPage = 10;
	$iCounter = 0;
	$iPage = 0;
	$iNumPage;
	$bEof = false;

	if ($etatselected=="tous")
		$sSQL = "SELECT * FROM Emploi";
	else
		$sSQL = "SELECT * FROM Emploi WHERE etat=" . tosql($etatselected, "Text");
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
    <tr <?php if ($iCounter%2) echo "bgcolor=\"#CCFFEE\""; else echo "bgcolor=\"#CCFFCC\"";?>> 
      <td width="6%" height="28"> 
        <div align="center"> 
          <?php echo  ($iCounter+($iPage-1)*$iRecordsPerPage)+1?>
        </div>
      </td>
      <td width="30%" height="21"> 
        <div align="center"><a href="adminEmploiParametre.php?EmploiID=<?php echo $fldEmploiID?>">&nbsp;<?php echo  tohtml($fldNomDeLEmploi) ?></a></div>
      </td>
      <td width="20%" height="21"> 
        <div align="center">
		  <select name="EtatDe<?php echo  $fldEmploiID ?>" OnChange="window.location.href='adminListeEmploi.php?EtatChanged=' + document.form1['EtatDe<?php echo  $fldEmploiID ?>'].value + '&FormAction=ChangerEtat&EmploiID=<?php echo  $fldEmploiID ?>' + '&EtatSelected=' + document.form1.ListeEtat.value;">
            <option value="tous" <?php if ($fldEtat=="tous") echo " SELECTED " ?>>de tous les etats</option>
            <option value="inactif" <?php if ($fldEtat=="inactif") echo " SELECTED " ?>>inactif</option>
            <option value="creer" <?php if ($fldEtat=="creer") echo " SELECTED " ?>>en cours de creation</option>
            <option value="actif" <?php if ($fldEtat=="actif") echo " SELECTED " ?>>actif</option>
            <option value="a corriger" <?php if ($fldEtat=="a corriger") echo " SELECTED " ?>>a corriger</option>
            <option value="modifier" <?php if ($fldEtat=="modifier") echo " SELECTED " ?>>en cours de modification</option>
          </select>
		</div>
      </td>
      <td width="14%" height="21"> 
        <div align="center"><?php echo  $fldDuree ?>&nbsp;minutes</div>
      </td>
      <td width="10%" height="21"> 
        <div align="center"><a href="adminEmploiSuppression.php?EmploiID=<?php echo  $fldEmploiID ?>&EtatSelected=<?php $etatselected?>">Supprimer</div>
      </td>
      <td width="10%" height="21"> 
        <div align="center"><a href="adminEmploiCopier.php?EmploiID=<?php echo  $fldEmploiID ?>">Copier</div>
      </td>
      <td width="10%" height="21"> 
        <div align="center"><a href="adminEmploiCreation.php?EmploiID=<?php echo  $fldEmploiID ?>">Modifier</div>
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
				<font>Précédente</font>
<?php		} 
		    else { ?>
				<a href="adminListeEmploi.php?PageNumber=<?php echo $iPage-1?>">Précédente</a> 
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
