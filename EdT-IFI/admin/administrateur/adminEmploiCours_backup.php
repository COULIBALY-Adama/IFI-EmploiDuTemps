<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	//check_security(3, "../index.php");
?>
<html>
<head>
<title>Selection des Cours</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="post" action="">
  <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#FF66CC" height="348">
    <tr bordercolor="#FFFFFF"> 
      <td colspan="4" height="57" bgcolor="#000099"> 
        <div align="center"><font color="#FFFFFF"><b>Selection des cours</b></font></div>
      </td>
    </tr>
    <tr bgcolor="#CCFFFF"> 
      <td colspan="4" height="52"> 
        <div align="center"> 
          <select name="select">
            <option>CORBA</option>
            <option>Projet</option>
            <option>Conception d'application</option>
          </select>
          <input type="submit" name="Submit3" value="Ajouter Cours a la Liste">
          <a href="adminEmploiCoursProfesseur.php">Ajouter</a></div>
      </td>
    </tr>
    <tr bgcolor="#6666FF"> 
      <td width="4%">&nbsp;</td>
      <td width="35%"> 
        <div align="center"><b>Nom de Cours</b></div>
      </td>
      <td width="42%"> 
        <div align="center"><b>Professeurs</b></div>
      </td>
      <td width="19%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%" height="22"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox" value="checkbox">
        </div>
      </td>
      <td width="35%" height="22">&nbsp;</td>
      <td width="42%" height="22">&nbsp;</td>
      <td width="19%" height="22">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%" height="27"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox2" value="checkbox">
        </div>
      </td>
      <td width="35%" height="27">&nbsp;</td>
      <td width="42%" height="27">&nbsp;</td>
      <td width="19%" height="27">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox3" value="checkbox">
        </div>
      </td>
      <td width="35%">&nbsp;</td>
      <td width="42%">&nbsp;</td>
      <td width="19%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox4" value="checkbox">
        </div>
      </td>
      <td width="35%">&nbsp;</td>
      <td width="42%">&nbsp;</td>
      <td width="19%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%" height="30"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox5" value="checkbox">
        </div>
      </td>
      <td width="35%" height="30">&nbsp;</td>
      <td width="42%" height="30">&nbsp;</td>
      <td width="19%" height="30">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%" height="32"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox6" value="checkbox">
        </div>
      </td>
      <td width="35%" height="32">&nbsp;</td>
      <td width="42%" height="32">&nbsp;</td>
      <td width="19%" height="32">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox7" value="checkbox">
        </div>
      </td>
      <td width="35%">&nbsp;</td>
      <td width="42%">&nbsp;</td>
      <td width="19%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox8" value="checkbox">
        </div>
      </td>
      <td width="35%">&nbsp;</td>
      <td width="42%">&nbsp;</td>
      <td width="19%">&nbsp;</td>
    </tr>
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td height="64" colspan="2"> 
        <div align="left"> 
          <input type="submit" name="Submit4" value="Supprimer">
          <input type="submit" name="Submit32" value="Etape Precedent">
          <a href="adminEmploiListeHoraire.php"> Etape Precedent</a> 
          <input type="submit" name="Submit42" value="Etape Suivant">
          <a href="adminEmploiCreation.php">Etape Suivant</a> </div>
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
