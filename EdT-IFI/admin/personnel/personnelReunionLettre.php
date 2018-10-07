<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(1, "../index.php");
?>
<html>
<head>
<title>Redaction Une Lettre</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#CCFFCC">
<form method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="2" bgcolor="#000099" height="42"> 
        <div align="center"><b><font color="#FFFFFF">Redaction d'une Lettre pour 
          les Participants</font></b></div>
      </td>
    </tr>
    <tr> 
      <td width="47%" height="25"> 
        <div align="right">Titre de la Reunion: </div>
      </td>
      <td width="53%" height="25"> &nbsp;<b>Reunion des Etudes</b></td>
    </tr>
    <tr> 
      <td width="47%" height="20"> 
        <div align="right">Date: </div>
      </td>
      <td width="53%" height="20"> <b>&nbsp;30/3/2002</b></td>
    </tr>
    <tr> 
      <td width="47%" height="20"> 
        <div align="right">Lieu: </div>
      </td>
      <td width="53%" height="20"><b>&nbsp;Amphi</b></td>
    </tr>
    <tr> 
      <td width="47%" height="20"> 
        <div align="right">Horaire: </div>
      </td>
      <td width="53%" height="20">&nbsp;<b>de 14h30 &agrave; 16h</b></td>
    </tr>
    <tr> 
      <td width="47%" height="20">&nbsp;</td>
      <td width="53%" height="20">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" height="39"> 
        <div align="center">Subject: 
          <input type="text" name="textfield" size="100" maxlength="100" value="Reunion des Etudes, 30/3/2002, de 14h30">
        </div>
      </td>
    </tr>
    <tr> 
      <td colspan="2" height="20"> 
        <div align="center"> 
          <textarea name="textfield2" cols="100" rows="10"></textarea>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="47%" height="20">&nbsp;</td>
      <td width="53%" height="20">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" height="20">
        <div align="center">
          <input type="submit" name="Submit" value="Envoyer &agrave; tous les Participants">
        </div>
      </td>
    </tr>
    <tr> 
      <td width="47%" height="20">&nbsp;</td>
      <td width="53%" height="20">&nbsp;</td>
    </tr>
    <tr> 
      <td width="47%" height="20">&nbsp;</td>
      <td width="53%" height="20">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
