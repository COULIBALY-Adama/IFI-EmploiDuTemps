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
<script language="JavaScript">
	function ajouterClick()
	{
		open("personnelTache.php");
	}
	function supprimerClick()
	{
		alert("Supprimer des Taches!");
	}
</script>
<body bgcolor="#CCFFFF">
<form method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF" align="center" height="434">
    <tr bgcolor="#000066"> 
      <td colspan="4" height="39"> 
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr> 
            <td><font color="#FFFFFF"><b>Annee</b></font> : 
              <select name="select">
                <option>2002</option>
                <option>2003</option>
                <option>2004</option>
                <option>2005</option>
                <option>2006</option>
                <option>2007</option>
                <option>2008</option>
                <option>2009</option>
              </select>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>1</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>2</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>3</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>4</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>5</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>6</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>7</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>8</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>9</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>10</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>11</b></font></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><font color="#FFFFFF"><b>12</b></font></a></div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#000066">
      <td colspan="4" height="36"> 
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr> 
            <td><b><font color="#FFFFFF">&nbsp;&nbsp;<font color="#FFFF00">Jours 
              : </font></font></b></td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">1</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">2</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">3</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">4</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">5</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">6</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">7</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">8</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">9</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">10</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">11</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.htm"><b><font color="#FFFF00">12</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">13</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">14</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">15</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">16</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">17</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">18</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">19</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">20</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">21</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">22</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">23</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">24</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">25</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">26</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">27</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">28</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">29</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">30</font></b></a></div>
            </td>
            <td> 
              <div align="center"><a href="personnelAgendaJour.php"><b><font color="#FFFF00">31</font></b></a></div>
            </td>
          </tr>
        </table>
        
      </td>
    </tr>
    <tr bgcolor="#000066"> 
      <td colspan="4"> 
        <div align="center"><b><font size="4" color="#FFFFFF">Liste des Taches 
          du <font color="#FFFF00">Lundi, 19/12/2002</font></font></b></div>
      </td>
    </tr>
    <tr bgcolor="#000099" bordercolor="#006699"> 
      <td width="4%"><b><font color="#FFFFFF"></font></b></td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF">Periodes</font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><b><font color="#FFFFFF">Titre</font></b></div>
      </td>
      <td width="50%"> 
        <div align="center"><b><font color="#FFFFFF">Description</font></b></div>
      </td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox" value="checkbox">
        </div>
      </td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">11h00-12h00</a></font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><font color="#000099"><b>Diancom</b></font></div>
      </td>
      <td width="50%"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox2" value="checkbox">
        </div>
      </td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">14h30-16h00</a></font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><font color="#000099"><b>reunion</b></font></div>
      </td>
      <td width="50%"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%" height="24"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox3" value="checkbox">
        </div>
      </td>
      <td width="25%" height="24"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">11h00-12h00</a></font></b></div>
      </td>
      <td width="21%" height="24"> 
        <div align="center"><font color="#000099"><b>khongaibiet</b></font></div>
      </td>
      <td width="50%" height="24"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%" height="22"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox4" value="checkbox">
        </div>
      </td>
      <td width="25%" height="22"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">13h30-14h30</a></font></b></div>
      </td>
      <td width="21%" height="22"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#000099">tache1</font></b></font></div>
      </td>
      <td width="50%" height="22"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox5" value="checkbox">
        </div>
      </td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">14h30-15h30</a></font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFFFFF"><b><font color="#000099">tache2</font></b></font><font color="#000099"></font></b></font></div>
      </td>
      <td width="50%"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox6" value="checkbox">
        </div>
      </td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">15h30-16h30</a></font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFFFFF"><b><font color="#000099">tache3</font></b></font><font color="#000099"></font></b></font></div>
      </td>
      <td width="50%"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox7" value="checkbox">
        </div>
      </td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">16h30-17h30</a></font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFFFFF"><b><font color="#000099">tache4</font></b></font><font color="#000099"></font></b></font></div>
      </td>
      <td width="50%"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%" height="30"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox8" value="checkbox">
        </div>
      </td>
      <td width="25%" height="30"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">19h30-20h30</a></font></b></div>
      </td>
      <td width="21%" height="30"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFFFFF"><b><font color="#000099">tache5</font></b></font><font color="#000099"></font></b></font></div>
      </td>
      <td width="50%" height="30"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox9" value="checkbox">
        </div>
      </td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">20h30-21h30</a></font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFFFFF"><b><font color="#000099">tache6</font></b></font><font color="#000099"></font></b></font></div>
      </td>
      <td width="50%"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
    <tr bordercolor="#CCCCFF"> 
      <td width="4%"> 
        <div align="center"> 
          <input type="checkbox" name="checkbox10" value="checkbox">
        </div>
      </td>
      <td width="25%"> 
        <div align="center"><b><font color="#FFFFFF"><a href="personnelTache.php" target="_self">21h30-22h30</a></font></b></div>
      </td>
      <td width="21%"> 
        <div align="center"><font color="#FFFFFF"><b><font color="#FFFFFF"><b><font color="#000099">tache7</font></b></font><font color="#000099"></font></b></font></div>
      </td>
      <td width="50%"><font color="#000099"><b>&nbsp;</b></font></td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td height="43">
        <div align="right">&lt;<a href="personnelAgendaJour.php">Precedent</a>&lt; 
          <b>Lundi</b> 19/12/2002 &gt;<a href="personnelAgendaJour.php">Suivant</a>&gt;</div>
      </td>
    </tr>
    <tr> 
      <td height="39"> 
        <input type="submit" name="Submit" value="Ajouter une Tache" onclick="ajouterClick()">
        <input type="submit" name="Submit2" value="Supprimer" onclick="supprimerClick()">
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p align="center"><b></b></p>
<p>&nbsp; </p>
</body>
</html>
