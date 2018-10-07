<?php
	include ("./common.php");
	include ("./styles.inc");

	session_start();
	check_security(3, "../index.php");

	$personnelID = strip(get_param("PersonnelID"));
	$formName = get_param("FormName");
	$formAction = get_param("FormAction");
	$position = strip(get_param("PositionSelected"));
	if (!$position) $position = strip(get_param("Position"));
	$error = "";
	$formType="";
	$fldNomDePersonnel = "";
	$fldNomDeLogin = "";
	$fldMotDePasse = "";
	$fldMotDePasseRetype = "";
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
<title>Information de Professeur</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="POST" action="adminProfesseurInfo.php?FormType=<?php echo  $formType ?>" name="form1">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr bgcolor="#000066"> 
      <td height="52" colspan="3"> 
        <div align="center"><b><font color="#FFFFFF" size="4">Descriptio</font></b><font color="#FFFFFF" size="4"><b>n 
          de Personnel</b></font> <br>
          <font color="#FFFFFF">(*) champ obliratoire.</font></div>
      </td>
    </tr>
<?php  // Error when input
	if (strlen($error)) {
?>
    <tr> 
      <td height="29" colspan="3">
        <div align="center">
          <p><b><font size="2" color="#FF0000"><?php echo  $error?></font></b></p>
        </div>
      </td>
    </tr>
<?php } 
?>
    <tr> 
      <td height="40" width="41%"> 
        <div align="right">Nom: </div>
      </td>
      <td height="40" colspan="2" width="59%">&nbsp;&nbsp; &nbsp;<?php echo  $fldNomDePersonnel ?></td>
    </tr>
    <tr> 
      <td height="27" width="41%" > 
        <div align="right">Nom de Login:&nbsp;</div>
      </td>
      <td height="27" colspan="2" width="59%">&nbsp;&nbsp; 
        <input type="text" name="nomDeLogin" value="<?php echo  $fldNomDeLogin ?>">
        (*) </td>
    </tr>
    <tr> 
      <td height="27" width="41%" > 
        <div align="right">Mot de Passe: </div>
      </td>
      <td height="27" colspan="2" width="59%">&nbsp;&nbsp; 
        <input type="password" name="motDePasse" value="<?php echo  $fldMotDePasse ?>">
        (*)&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr> 
      <td height="30" width="41%" > 
        <div align="right">Mot de Passe de Verificatoin: </div>
      </td>
      <td height="30" colspan="2" width="59%"> &nbsp;&nbsp; 
        <input type="password" name="motDePasseRetype" value="<?php echo  $fldMotDePasseRetype ?>">
        (*) </td>
    </tr>
    <tr> 
      <td height="60" colspan="3" > 
        <div align="center">
		  <input type="hidden" name="FormAction" value="enregistrer">
		  <input type="hidden" name="Position" value="<?php echo  $position ?>">
		  <input type="hidden" name="FormName" value="form1">
		  <input type="hidden" name="PersonnelID" value="<?php echo  $personnelID ?>">
          <input type="submit" name="submit" value="Enregistrer" onclick="document.form1.FormAction.value= 'enregistrer'; ">
          <input type="submit" name="submit" value="Annuler" onclick="document.form1.FormAction.value= 'annuler'; ">
        </div>
      </td>
    </tr>
  </table>
<p>&nbsp;</p></form>
</body>
</html>

<?php

function form1_get_info($action) {
	global $db;
	global $trombi;
	global $position;
	global $ajouter;
	global $formType;
	global $personnelID;
	global $fldNomDePersonnel;
	global $fldNomDeLogin;
	global $fldMotDePasse;
	global $fldMotDePasseRetype;
	$sSQL = "SELECT * FROM Personne WHERE PersonneID=" . tosql($personnelID, "Number");
	$trombi->query($sSQL);
	$trombi->next_record();
	$fldNomDePersonnel = $trombi->f("Nom") . " " . $trombi->f("Prenom");
	if (strtolower($action) == "enregistrer") {
		$fldNomDeLogin = strip(get_param("nomDeLogin"));
		$fldMotDePasse = strip(get_param("motDePasse"));
		$fldMotDePasseRetype = strip(get_param("motDePasseRetype"));
		$formType = get_param("FormType");
	}
	else {
		$sSQL = "select * from Personnel where personnel_id=" . tosql($personnelID, "Number");
		$db->query($sSQL);
		$nextdb = $db->next_record();
		if ($nextdb) {
			$fldNomDeLogin = $db->f("nom_de_login");
			$fldMotDePasse = $db->f("mot_de_passe");
			$fldMotDePasseRetype = $fldMotDePasse;
		}
		else {
			$formType = "ajouter";
			$fldNomDeLogin = "";
			$fldMotDePasse = "";
			$fldMotDePasseRetype = "";
		}
	}
}

function test_error() {
	global $db;
	global $error;
	global $position;
	global $formAction;
	global $ajouter;
	global $personnelID;
	global $fldNomDePersonnel;
	global $fldNomDeLogin;
	global $fldMotDePasse;
	global $fldMotDePasseRetype;
	
	if (!strlen($fldNomDeLogin))
	{
		$error = $error . "Il faut donner un nom de login.<br>" ;
	}
	else {
		$sSQL = "SELECT * FROM Personnel WHERE nom_de_login=" . tosql($fldNomDeLogin, "Text") . " AND personnel_id != " . $personnelID;
		$db->query($sSQL);
		$nextdb = $db->next_record();
		if ($nextdb) 
			$error = $error . "Le nom de login que vous venez de saisir existe déjà. Choisissez un autre!<br>" ;
	}
	if (!strlen($fldMotDePasse))
	{
		$error = $error . "Il faut saisir le Mot de Passe.<br>" ;
	}
	else
		if ($fldMotDePasse != $fldMotDePasseRetype)
		{
			$error = $error . "Deux saisie du Mot de Passe ne sont pas identiques'.<br>" ;
		}
}

function form1_Action($action) {
	global $db;
	global $error;
	global $ajouter;
	global $formType;
	global $personnelID;
	global $position;
	global $fldNomDePersonnel;
	global $fldNomDeLogin;
	global $fldMotDePasse;
	global $fldMotDePasseRetype;

	switch (strtolower($action)) {
		case "enregistrer":
			test_error();
			if(strlen($error)) return;
			if ($formType == "ajouter") {
				$sSQL = "INSERT INTO Personnel (" .
						"personnel_id, nom_de_login, " .
						"mot_de_passe, niveau_de_securite) " .
						"VALUES (" .
						tosql($personnelID, "Number") . ", " .
						tosql($fldNomDeLogin, "Text") . ", " .
						tosql($fldMotDePasse, "Text") . ", " .
						tosql(0, "Number") . ")";
			}
			else {
				$sWhere = "personnel_id=" . tosql($personnelID, "Number");
				$sSQL = "UPDATE Personnel SET " .
					  "nom_de_login =" . tosql($fldNomDeLogin, "Text") .
					  ", mot_de_passe =" . tosql($fldMotDePasse, "Text") . 
					  ", niveau_de_securite =" . tosql(0, "Number");
				$sSQL .= " WHERE " . $sWhere;
			}
			$db->query($sSQL);
			header("Location: adminListeProfesseur.php?PositionSelected=" . $position);
			break;
		case "annuler":
			header("Location: adminListeProfesseur.php?PositionSelected=" . $position);
			return;
	}
}

?>