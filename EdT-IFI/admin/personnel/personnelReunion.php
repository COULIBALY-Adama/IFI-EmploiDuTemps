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
  <table width="90%" border="0" cellspacing="0" cellpadding="0" height="137" align="center">
    <tr bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td colspan="2" height="31"> 
        <div align="left"><font color="#FFFFFF"><b>Parametres Generales de la 
          Reunion</b></font></div>
      </td>
    </tr>
    <tr> 
      <td width="39%" height="33"> 
        <div align="right">Titre de la Reunion: </div>
      </td>
      <td width="61%" height="33">&nbsp;&nbsp; 
        <input type="text" name="textfield" size="40" value="Reunion des Etudes">
      </td>
    </tr>
    <tr> 
      <td width="39%" height="25"> 
        <div align="right">Date: </div>
      </td>
      <td width="61%" height="25">&nbsp;&nbsp; 
        <input type="text" name="textfield2" size="15" maxlength="8" value="30/3/2002">
      </td>
    </tr>
    <tr> 
      <td width="39%" height="27"> 
        <div align="right">Lieu : </div>
      </td>
      <td width="61%" height="27">&nbsp;&nbsp; 
        <input type="text" name="textfield3" size="40" value="Amphi">
      </td>
    </tr>
  </table>
  <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" height="348">
    <tr bordercolor="#FFFFFF"> 
      <td colspan="2" height="33" bgcolor="#000099"> 
        <div align="left"><font color="#FFFFFF"><b>Selection des Participants 
          </b></font></div>
      </td>
    </tr>
    <tr bgcolor="#6666FF"> 
      <td width="48%" height="22" bgcolor="#6666FF"> 
        <div align="center"><b>Nom de Participant</b></div>
      </td>
      <td width="52%" height="22"> 
        <div align="center"><b>Selection</b></div>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="30" > 
        <div align="center"><b>NGUYEN Hong Quang</b></div>
      </td>
      <td width="52%" height="30"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox" value="checkbox" checked>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="30" > 
        <div align="center"><b>HO Tuong Vinh</b></div>
      </td>
      <td width="52%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox2" value="checkbox" checked>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="31" > 
        <div align="center"><b>Patrick Bellot</b></div>
      </td>
      <td width="52%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox3" value="checkbox" checked>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="30" > 
        <div align="center"><b>Alain Boucher</b></div>
      </td>
      <td width="52%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox4" value="checkbox" checked>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="30" > 
        <div align="center"><b>Christelle Brouillet</b></div>
      </td>
      <td width="52%" height="30"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox5" value="checkbox">
        </div>
      </td>
    </tr>
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td height="62"> 
        <input type="submit" name="Submit" value="Tester">
        <input type="submit" name="Submit2" value="Annuler">
      </td>
    </tr>
  </table>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr bgcolor="#000099"> 
      <td height="30"> 
        <div align="left"><b><font color="#FFFFFF">Liste des Horaire libre d'ensemble 
          de tous les participants selectionnes</font></b></div>
      </td>
    </tr>
  </table>
  <table width="50%" border="1" cellspacing="0" cellpadding="0" align="center">
    <tr bgcolor="#6666FF"> 
      <td height="23" width="28%"> 
        <div align="center"><b><font color="#FFFFFF">Debut</font></b></div>
      </td>
      <td height="23" width="25%"> 
        <div align="center"><font color="#FFFFFF"><b>Fin</b></font></div>
      </td>
      <td height="23" width="47%"> 
        <div align="center"><font color="#FFFFFF"><b>Duree</b></font></div>
      </td>
    </tr>
    <tr> 
      <td height="23" width="28%"> 
        <div align="center">6h</div>
      </td>
      <td height="23" width="25%"> 
        <div align="center">8h</div>
      </td>
      <td height="23" width="47%"> 
        <div align="center">2h</div>
      </td>
    </tr>
    <tr> 
      <td height="23" width="28%"> 
        <div align="center">11h</div>
      </td>
      <td height="23" width="25%"> 
        <div align="center">13h30</div>
      </td>
      <td height="23" width="47%"> 
        <div align="center">2h30</div>
      </td>
    </tr>
    <tr> 
      <td height="23" width="28%"> 
        <div align="center">15h15</div>
      </td>
      <td height="23" width="25%"> 
        <div align="center">18h00</div>
      </td>
      <td height="23" width="47%"> 
        <div align="center">2h45</div>
      </td>
    </tr>
    <tr> 
      <td height="23" width="28%"> 
        <div align="center">&nbsp;</div>
      </td>
      <td height="23" width="25%"> 
        <div align="center">&nbsp;</div>
      </td>
      <td height="23" width="47%"> 
        <div align="center">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td height="23" width="28%"> 
        <div align="center">&nbsp;</div>
      </td>
      <td height="23" width="25%"> 
        <div align="center">&nbsp;</div>
      </td>
      <td height="23" width="47%"> 
        <div align="center">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td height="26" width="28%"> 
        <div align="center">&nbsp;</div>
      </td>
      <td height="26" width="25%"> 
        <div align="center">&nbsp;</div>
      </td>
      <td height="26" width="47%"> 
        <div align="center">&nbsp;</div>
      </td>
    </tr>
  </table>
  <br>
  <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr bgcolor="#000099"> 
      <td colspan="2"><b><font color="#FFFFFF">Selection de temps</font></b></td>
    </tr>
    <tr> 
      <td width="39%"> 
        <div align="right">Le debut de la reunion: </div>
      </td>
      <td width="61%"> &nbsp;&nbsp; 
        <input type="text" name="textfield4">
      </td>
    </tr>
    <tr> 
      <td width="39%" height="30"> 
        <div align="right">La duree: </div>
      </td>
      <td width="61%" height="30"> &nbsp;&nbsp; 
        <select name="select">
          <option>30</option>
          <option>1h</option>
          <option>1h30</option>
          <option>2h</option>
          <option>2h30</option>
          <option>3h</option>
          <option>3h30</option>
          <option>4h</option>
          <option>4h30</option>
          <option>5</option>
        </select>
      </td>
    </tr>
    <tr>
      <td width="39%" height="48">
        <input type="submit" name="Submit3" value="Envoyer email">
        <a href="personnelReunionLettre.php">Envoyer email</a></td>
      <td width="61%" height="48">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp; </p>
</form>
</body>
</html>
