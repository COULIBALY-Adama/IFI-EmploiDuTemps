<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3, "../index.php");
?>
<html>
<head>
<title>Rapport sur Professeur</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  <table width="71%" border="1" cellspacing="0" cellpadding="0" align="center" height="348">
    <tr bordercolor="#FFFFFF"> 
      <td colspan="3" height="59" bgcolor="#000099"> 
        <div align="center"><font color="#FFFFFF"><b>Selection des Professeurs 
          pour le Cours de &quot;CORBA&quot;</b></font></div>
      </td>
    </tr>
    <tr bgcolor="#CCFFFF"> 
      <td colspan="2" height="42"> 
        <div align="center"> 
          <select name="select">
            <option>NGUYEN Hong Quang</option>
            <option>HO Tuong Vinh</option>
          </select>
          <input type="submit" name="Submit3" value="Ajouter Professeur a la Liste">
          <a href="Copy%20of%20adminEmploiCoursProfesseur.php">Ajouter</a></div>
      </td>
    </tr>
    <tr bgcolor="#6666FF"> 
      <td width="20%" height="23">&nbsp;</td>
      <td width="80%" height="23"> 
        <div align="center"><b>Nom de Professeur</b></div>
      </td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="26" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="30" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="31" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="30" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="30" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="35" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="33" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="30" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="34" >&nbsp;</td>
      <td width="80%" height="34" colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td width="20%" height="26" >&nbsp;</td>
      <td width="80%" height="31" colspan="2" > 
        <div align="center"></div>
      </td>
    </tr>
  </table>
  <table width="71%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="62" colspan="2"> 
        <div align="left"> 
          <input type="submit" name="Submit4" value="Supprimer">
          <input type="submit" name="Submit" value="Retourner">
          <a href="adminEmploiCours.php">Retourner</a></div>
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
