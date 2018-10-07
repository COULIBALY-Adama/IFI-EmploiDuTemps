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
  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="65">
    <tr bordercolor="#FFFFFF" bgcolor="#000099"> 
      <td colspan="2" height="37"> 
        <div align="center"><font color="#FFFFFF"><b>Supprimer un ET</b></font></div>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="14">&nbsp;</td>
      <td width="52%" height="14">&nbsp;</td>
    </tr>
    <tr> 
      <td width="48%" height="35"> 
        <div align="right"> 
          <p>Emploi du Temps: </p>
        </div>
      </td>
      <td width="52%" height="35"> &nbsp; 
        <select name="select">
          <option>TKB-P6-S3</option>
          <option>TKB-P7-S3</option>
        </select>
      </td>
    </tr>
    <tr> 
      <td width="48%" height="14">&nbsp;</td>
      <td width="52%" height="14">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" height="14"> 
        <div align="center"> 
          <input type="submit" name="Submit" value="Effectuer la suppression">
        </div>
      </td>
    </tr>
  </table>
  <p> <br>
    &nbsp;</p>
</form>
<p>&nbsp;</p></body>
</html>
