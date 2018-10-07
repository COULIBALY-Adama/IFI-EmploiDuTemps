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
<body bgcolor="#0066CC" marginwidth="0" marginheight="0">
<form method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#CCFFCC" height="348">
    <tr bordercolor="#FFFFFF"> 
      <td colspan="4" height="56" bgcolor="#000099"> 
        <div align="center"><font color="#FFFFFF"><b>Creation de l'Emploi du Temps 
          d'un Jour</b></font></div>
      </td>
    </tr>
    <tr bordercolor="#FFFFFF"> 
      <td colspan="4" height="26" bgcolor="#000099"> 
        <div align="center"><font color="#FFFFFF"><b>Lundi 01-10-2002</b></font></div>
      </td>
    </tr>
    <tr bgcolor="#6666FF"> 
      <td width="17%"> 
        <div align="center"><b>Periodes</b></div>
      </td>
      <td width="25%"> 
        <div align="center"><b>Nom de Cours</b></div>
      </td>
      <td width="19%"> 
        <div align="center"><b>Local</b></div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="32" bordercolor="#CCCCFF"> 
        <div align="center">09h00-10h00</div>
      </td>
      <td width="25%"> 
        <div align="center"> 
          <select name="select">
            <option>CORBA</option>
            <option>Synthese d'Image</option>
            <option>Communication </option>
          </select>
        </div>
      </td>
      <td width="19%"> 
        <div align="center"> 
          <select name="select7">
            <option>Salle de TP1</option>
            <option>Amphi</option>
            <option>203</option>
          </select>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="30" bordercolor="#CCCCFF"> 
        <div align="center">10h00-11h00</div>
      </td>
      <td width="25%"> 
        <div align="center"> 
          <select name="select2">
            <option>CORBA</option>
            <option>Synthese d'Image</option>
            <option>Communication </option>
          </select>
        </div>
      </td>
      <td width="19%"> 
        <div align="center"> 
          <select name="select8">
            <option>Salle de TP1</option>
            <option>Amphi</option>
            <option>203</option>
          </select>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="30" bordercolor="#CCCCFF"> 
        <div align="center">10h00-12h00</div>
      </td>
      <td width="25%" height="30"> 
        <div align="center"> 
          <select name="select3">
            <option>CORBA</option>
            <option>Synthese d'Image</option>
            <option>Communication </option>
          </select>
        </div>
      </td>
      <td width="19%" height="30"> 
        <div align="center"> 
          <select name="select9">
            <option>Salle de TP1</option>
            <option>Amphi</option>
            <option>203</option>
          </select>
        </div>
      </td>
    </tr>
    <tr> 
      <td height="26" width="17%" bordercolor="#CCCCFF">&nbsp;</td>
      <td width="25%"> 
        <div align="center"></div>
      </td>
      <td width="19%"> 
        <div align="center"></div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="28" bordercolor="#CCCCFF"> 
        <div align="center">14h30-15h30</div>
      </td>
      <td width="25%" height="30"> 
        <div align="center"> 
          <select name="select4">
            <option>Synthese d'Image</option>
            <option>CORBA</option>
            <option>Communication </option>
          </select>
        </div>
      </td>
      <td width="19%" height="30"> 
        <div align="center"> 
          <select name="select10">
            <option>Salle 203</option>
            <option>Amphi</option>
            <option>Sale de TP1</option>
          </select>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="33" bordercolor="#CCCCFF"> 
        <div align="center">15h30-16h30</div>
      </td>
      <td width="25%" height="33"> 
        <div align="center"> 
          <select name="select5">
            <option>Synthese d'Image</option>
            <option>CORBA</option>
            <option>Communication </option>
          </select>
        </div>
      </td>
      <td width="19%" height="33"> 
        <div align="center"> 
          <select name="select11">
            <option>Salle 203</option>
            <option>Amphi</option>
            <option>Sale de TP1</option>
          </select>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="17%" height="33" bordercolor="#CCCCFF"> 
        <div align="center">16h30-17h30</div>
      </td>
      <td width="25%" height="33"> 
        <div align="center"> 
          <select name="select6">
            <option>Synthese d'Image</option>
            <option>CORBA</option>
            <option>Communication </option>
          </select>
        </div>
      </td>
      <td width="19%" height="33"> 
        <div align="center"> 
          <select name="select12">
            <option>Salle 203</option>
            <option>Amphi</option>
            <option>Sale de TP1</option>
          </select>
        </div>
      </td>
    </tr>
    <tr> 
      <td width="17%"> 
        <div align="center"></div>
      </td>
      <td width="25%">&nbsp;</td>
      <td width="19%"> 
        <div align="center"></div>
      </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td height="64"> 
        <input type="submit" name="Submit" value="Enregistrer">
        <input type="submit" name="Submit2" value="Annuler">
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
