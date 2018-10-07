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
	function afficher()
	{
		window.open("userProfesseurAgendaEmploi.php");
	}
</script>
<body bgcolor="#CCFFFF" marginwidth="0" marginheight="0">
<form method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr bgcolor="#000066"> 
      <td height="27" colspan="3"><b><font color="#FFFFFF">Parametrage de l'Emploi 
        du Temps</font></b></td>
    </tr>
    <tr> 
      <td height="27" width="38%" > 
        <div align="right"> 
          <input type="checkbox" name="checkbox" value="checkbox" checked>
        </div>
      </td>
      <td height="27" colspan="2">Agenda</td>
    </tr>
    <tr> 
      <td height="27" width="38%" > 
        <div align="right"> 
          <input type="checkbox" name="checkbox2" value="checkbox" checked>
        </div>
      </td>
      <td height="27" colspan="2">Emploi du Temps</td>
    </tr>
    <tr> 
      <td height="27" width="38%" > 
        <div align="right">Cours: </div>
      </td>
      <td height="27" width="12%"> 
        <select name="select">
          <option>CORBA</option>
          <option>Projet</option>
          <option>Francais</option>
        </select>
      </td>
      <td height="27" width="50%"> 
        <input type="checkbox" name="checkbox3" value="checkbox">
        Tous les Cours</td>
    </tr>
    <tr> 
      <td height="27" width="38%" > 
        <div align="right">Classe: </div>
      </td>
      <td height="27" width="12%"> 
        <select name="select2">
          <option>P6</option>
          <option>P7</option>
          <option>P8</option>
        </select>
      </td>
      <td height="27" width="50%"> 
        <input type="checkbox" name="checkbox4" value="checkbox">
        Toutes les Classes</td>
    </tr>
    <tr> 
      <td height="27" width="38%" > 
        <div align="right">Semestre: </div>
      </td>
      <td height="27" colspan="2"> 
        <select name="select3">
          <option>I</option>
          <option>II</option>
          <option>III</option>
        </select>
      </td>
    </tr>
    <tr> 
      <td height="27" width="38%" > 
        <div align="right">Afficher &agrave; partir de la semaine: </div>
      </td>
      <td height="27" colspan="2"> 
        <select name="select4">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>
      </td>
    </tr>
    <tr> 
      <td height="27" width="38%" > 
        <div align="right">Nombre de semaine par page: </div>
      </td>
      <td height="27" colspan="2"> 
        <input type="text" name="textfield" value="1" size="9" maxlength="2">
      </td>
    </tr>
    <tr> 
      <td height="60" colspan="3" > 
        <div align="center">
          <input type="submit" name="Submit" value="Afficher l'Emploi du Temps" onclick="afficher()">
          <a href="personnelEmploi2.php">Afficher</a></div>
      </td>
    </tr>
  </table>
<p>&nbsp;</p></form>
</body>
</html>
