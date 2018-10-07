<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(1, "../index.php");
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#CCFFFF">
<form method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="7" height="32">
        <div align="center"><b><font size="5">Emploi du Temps vu par personnel</font></b></div>
      </td>
    </tr>
    <tr> 
      <td colspan="7" height="31"><b>Semain 1</b></td>
    </tr>
  </table>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#6666FF" height="192" align="center">
    <tr bordercolor="#FFCCCC" bgcolor="#CCCCFF"> 
      <td width="19%"> 
        <div align="center"><font color="#000033"><b>Periodes</b></font></div>
      </td>
      <td width="15%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Lundi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Mardi</b></font></a></div>
      </td>
      <td width="12%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Mercredi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Jeudi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Vendredi</b></font></a></div>
      </td>
      <td width="15%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Samedi</b></font></a></div>
      </td>
    </tr>
    <tr bordercolor="#FFCCCC" bgcolor="#CCCCFF"> 
      <td width="19%" height="21"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFCCCC"><font color="#FFFFFF"><font color="#000033">&nbsp;</font></font></font></b></font></div>
      </td>
      <td width="15%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>1/10/2002</b></font></a></div>
      </td>
      <td width="13%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>2/10/2002</b></font></a></div>
      </td>
      <td width="12%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>3/10/2002</b></font></a></div>
      </td>
      <td width="13%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>4/10/2002</b></font></a></div>
      </td>
      <td width="13%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>5/10/2002</b></font></a></div>
      </td>
      <td width="15%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>6/10/2002</b></font></a></div>
      </td>
    </tr>
    <tr> 
      <td width="19%" height="36"> 
        <div align="center">09h00-10h00</div>
      </td>
      <td width="15%" height="36"> 
        <div align="center">&nbsp; CORBA</div>
      </td>
      <td width="13%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="12%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="15%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td width="19%" height="35"> 
        <div align="center">10h00-11h00</div>
      </td>
      <td width="15%" height="35"> 
        <div align="center">&nbsp;&nbsp;CORBA&nbsp;</div>
      </td>
      <td width="13%" height="35"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="12%" height="35"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="35"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="35"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="15%" height="35"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td width="19%" height="31"> 
        <div align="center">10h00-12h00</div>
      </td>
      <td width="15%" height="31"> 
        <div align="center">&nbsp; CORBA</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="12%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="15%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td height="7" width="19%"></td>
      <td height="7" width="15%"></td>
      <td height="7" width="13%"></td>
      <td height="7" width="12%"></td>
      <td height="7" width="13%"></td>
      <td height="7" width="13%"></td>
      <td height="7" width="15%"></td>
    </tr>
    <tr> 
      <td width="19%" height="32"> 
        <div align="center">14h30-15h30</div>
      </td>
      <td width="15%" height="32"> 
        <div align="center">&nbsp;&nbsp;Synthese d'Image</div>
      </td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="12%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="15%" height="32">&nbsp;</td>
    </tr>
    <tr> 
      <td width="19%" height="27"> 
        <div align="center">15h30-16h30</div>
      </td>
      <td width="15%" height="27"> 
        <div align="center">&nbsp;&nbsp;Synthese d'Image</div>
      </td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="12%" height="27">&nbsp;</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="15%" height="27">&nbsp;</td>
    </tr>
    <tr> 
      <td width="19%" height="32"> 
        <div align="center">16h30-17h30</div>
      </td>
      <td width="15%" height="32"> 
        <div align="center">&nbsp;&nbsp;Synthese d'Image</div>
      </td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="12%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="15%" height="32">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="7" height="44"> 
        <div align="left"><b>Semain 2</b></div>
      </td>
    </tr>
  </table>
  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#6666FF" height="192" align="center">
    <tr bordercolor="#FFCCCC" bgcolor="#CCCCFF"> 
      <td width="19%"> 
        <div align="center"><font color="#000033"><b>Periodes</b></font></div>
      </td>
      <td width="15%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Lundi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Mardi</b></font></a></div>
      </td>
      <td width="12%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Mercredi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Jeudi</b></font></a></div>
      </td>
      <td width="13%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Vendredi</b></font></a></div>
      </td>
      <td width="15%"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>Samedi</b></font></a></div>
      </td>
    </tr>
    <tr bordercolor="#FFCCCC" bgcolor="#CCCCFF"> 
      <td width="19%" height="21"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFCCCC"><font color="#FFFFFF"><font color="#000033">&nbsp;</font></font></font></b></font></div>
      </td>
      <td width="15%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>1/10/2002</b></font></a></div>
      </td>
      <td width="13%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>2/10/2002</b></font></a></div>
      </td>
      <td width="12%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>3/10/2002</b></font></a></div>
      </td>
      <td width="13%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>4/10/2002</b></font></a></div>
      </td>
      <td width="13%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.htm"><font color="#000033"><b>5/10/2002</b></font></a></div>
      </td>
      <td width="15%" height="21"> 
        <div align="center"><a href="../adminEmploiCreationJour.php"><font color="#000033"><b>6/10/2002</b></font></a></div>
      </td>
    </tr>
    <tr> 
      <td width="19%" height="36"> 
        <div align="center">09h00-10h00</div>
      </td>
      <td width="15%" height="36"> 
        <div align="left"> &nbsp; CORBA</div>
      </td>
      <td width="13%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="12%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="15%" height="36"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td width="19%" height="30"> 
        <div align="center">10h00-11h00</div>
      </td>
      <td width="15%" height="30"> 
        <div align="left"> &nbsp;&nbsp;CORBA&nbsp;</div>
      </td>
      <td width="13%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="12%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="15%" height="30"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td width="19%" height="31"> 
        <div align="center">10h00-12h00</div>
      </td>
      <td width="15%" height="31"> 
        <div align="left">&nbsp; CORBA</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="12%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="13%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
      <td width="15%" height="31"> 
        <div align="left">&nbsp;</div>
      </td>
    </tr>
    <tr> 
      <td height="7" width="19%"></td>
      <td height="7" width="15%"></td>
      <td height="7" width="13%"></td>
      <td height="7" width="12%"></td>
      <td height="7" width="13%"></td>
      <td height="7" width="13%"></td>
      <td height="7" width="15%"></td>
    </tr>
    <tr> 
      <td width="19%" height="32"> 
        <div align="center">14h30-15h30</div>
      </td>
      <td width="15%" height="32"> &nbsp;&nbsp;Synthese d'Image</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="12%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="15%" height="32">&nbsp;</td>
    </tr>
    <tr> 
      <td width="19%" height="27"> 
        <div align="center">15h30-16h30</div>
      </td>
      <td width="15%" height="27">&nbsp;&nbsp;Synthese d'Image</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="12%" height="27">&nbsp;</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="13%" height="27">&nbsp;</td>
      <td width="15%" height="27">&nbsp;</td>
    </tr>
    <tr> 
      <td width="19%" height="32"> 
        <div align="center">16h30-17h30</div>
      </td>
      <td width="15%" height="32">&nbsp;&nbsp;Synthese d'Image</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="12%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="13%" height="32">&nbsp;</td>
      <td width="15%" height="32">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
