<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();

	$emploiselected = get_param("ListeEmploi");
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$formType = get_param("FormType");
	$error = "";
	$fldEmploiID = $emploiID;
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
<title>Emploi du Temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF" tracingsrc="images.jpg" tracingopacity="100" marginwidth="0" marginheight="0">
<form method="POST" action="userEmploi.php" name="form1" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td height="27" colspan="4">&nbsp;</td>
    </tr>
    <tr> 
      <td height="27" colspan="4">&nbsp;</td>
    </tr>
    <tr> 
      <td height="32" colspan="4"> 
        <div align="right"> </div>
        <p align="center"><b><font size="3">Selection de l'Emploi du Temps &agrave; 
          voir</font></b></p>
        <p align="center"> 
          <?php
			
		$sSQL = "SELECT * FROM Emploi WHERE etat=" . tosql("actif","Text"); 
			$db->query($sSQL);
			echo "<select name=\"ListeEmploi\" size=1";
			//if ($db->nf()>8) echo "8"; else echo $db->nf();
			echo ">";
			while ($db->next_record()) {
				$fldEmploiID = $db->f("emploi_id");
				$fldNomDeLEmploi = $db->f("nom_de_lemploi");
				echo "<OPTION value=\"" . $fldEmploiID . "\"";
				if ($position==$fldEmploiID) echo " SELECTED";
				echo ">" . $fldNomDeLEmploi .  "</OPTION> <br>";
			}
?></select>
          </p>
      </td>
    </tr>
    <tr> 
      <td height="27" colspan="4">&nbsp;</td>
    </tr>
    <tr> 
      <td height="75" colspan="4"> 
        <div align="center"> 
          <input type="hidden" name="FormName" value="form1">
          <input type="hidden" name="FormAction" value="effectuer">
          <input type="hidden" name="FormType" value="<?php echo  $formType?>">
          <input type="hidden" name="EmploiSelected " value="<?php echo  $emploiselected?>">
          <input type="submit" name="submit" value="Emploi du Temps" onclick="document.form1.FormAction.value='Emploi du Temps'; ">
          <input type="submit" name="submit" value="Liste des Cours" onclick="document.form1.FormAction.value='Liste des Cours'; ">
        </div>
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p></body>
</html>

<?php
function form1_Action($action) {
	global $db;
	global $error;
	global $formType;
	global $emploiID;
	global $fldEmploiID;
	global $fldNomDeLEmploi;
	global $emploiselected;
	
	switch (strtolower($action)) {
        case "emploi du temps":
			header("Location: userEmploi2.php?EmploiID=" . $emploiselected);
			break;	
		case "liste des cours":
			header("Location: userEmploiCours.php?EmploiID=" . $emploiselected);
			break;
/*
		case "liste des professeurs": 	
			header("Location: userEmploiProfesseur.php?EmploiID=" . $emploiselected);
			break;
*/
	}
}
	
?>

