<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(1, "../index.php");
?>
<html>
<head>
<title>Rapport sur Professeur</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript">
	function enregistrerClick() 
	{
		this.close();
	}
	function annulerClick() 
	{
		this.close();
	}
</script>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr bgcolor="#000066"> 
      <td height="62" colspan="3"> 
        <div align="center"><b><font color="#FFFFFF" size="4">Change</font></b><font color="#FFFFFF" size="4"><b>ment 
          du Mot de Passe</b></font> <br>
          <font color="#FFFFFF">(*) il est obliratoire de saisir des donnees dans 
          ces champs)</font></div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF" bgcolor="#CCCCFF"> 
      <td height="44" colspan="3" > 
        <div align="center"><font color="#FF0033"><b><font color="#FF0066">Ancien 
          mot de passe n'est pas valide.<br>
          Verification du nouveau mot de passe est echoue.</font></b></font></div>
      </td>
    </tr>
    <tr> 
      <td height="39" width="45%" > 
        <div align="right"><font color="#000000"><b>Ancien Mot de Passe: </b></font></div>
      </td>
      <td height="39" colspan="2" width="55%"><b><font color="#FFFFFF">&nbsp;&nbsp; 
        <input type="password" name="textfield4">
        (*)&nbsp;&nbsp;</font></b></td>
    </tr>
    <tr> 
      <td height="42" width="45%" > 
        <div align="right"><font color="#000000"><b>Nouveau Mot de Passe: </b></font></div>
      </td>
      <td height="42" colspan="2" width="55%"><b><font color="#FFFFFF">&nbsp;&nbsp; 
        <input type="password" name="textfield2">
        (*) </font></b></td>
    </tr>
    <tr> 
      <td height="38" width="45%" > 
        <div align="right"><font color="#000000"><b>Verification du nouveau Mot 
          de Passe: </b></font></div>
      </td>
      <td height="38" colspan="2" width="55%"><b><font color="#FFFFFF">&nbsp;&nbsp; 
        <input type="password" name="textfield22">
        (*)</font></b></td>
    </tr>
    <tr> 
      <td height="81" colspan="3" > 
        <div align="center"> 
          <input type="submit" name="Submit" value="OK" onclick="enregistrerClick()">
          <input type="submit" name="Submit2" value="Annuler" onclick="annulerClick()">
        </div>
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p></body>
</html>
