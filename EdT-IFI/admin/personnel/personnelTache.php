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
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" height="258">
    <tr bgcolor="#000066"> 
      <td height="56" colspan="2"> 
        <div align="center"><b><font color="#FFFFFF" size="4">Descriptio</font></b><font color="#FFFFFF" size="4"><b>n 
          d'une Tache</b></font><br>
          <font color="#FFFFFF">(*) il est obliratoire de saisir des donnees dans 
          ces champs)</font></div>
      </td>
    </tr>
    <tr bgcolor="#CCFFCC"> 
      <td height="65" colspan="2"> 
        <div align="center"><font color="#FFFF00"><b><font color="#FF0099">La 
          date de debut est invalide!<br>
          La date de fin est invalide! <br>
          Le titre est invalide! </font></b></font></div>
      </td>
    </tr>
    <tr> 
      <td height="46" width="36%"> 
        <div align="right"><b>Debut: </b></div>
      </td>
      <td height="46" width="64%">&nbsp;&nbsp; 
        <input type="text" name="textfield">
        (*) </td>
    </tr>
    <tr> 
      <td height="29" width="36%" > 
        <div align="right"><b>Fin:&nbsp;</b></div>
      </td>
      <td height="29" width="64%" >&nbsp;&nbsp; 
        <input type="text" name="textfield3">
        (*) </td>
    </tr>
    <tr> 
      <td height="27" width="36%" > 
        <div align="right"><b>Titre: </b></div>
      </td>
      <td height="27" width="64%" >&nbsp;&nbsp; 
        <input type="password" name="textfield4">
        (*) </td>
    </tr>
    <tr> 
      <td height="25" width="36%" > 
        <div align="right"><b>Description: </b></div>
      </td>
      <td height="25" width="64%" > &nbsp;&nbsp; 
        <textarea name="textfield2" cols="50" rows="5"></textarea>
      </td>
    </tr>
    <tr> 
      <td height="60" colspan="2" > 
        <div align="center"> 
          <input type="submit" name="Submit" value="Enregistrer" onclick="enregistrerClick()">
          <input type="submit" name="Submit2" value="Annuler" onclick="annulerClick()">
        </div>
      </td>
    </tr>
  </table>
<p>&nbsp;</p></form>
</body>
</html>
