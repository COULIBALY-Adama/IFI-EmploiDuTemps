<?php
	include("common.php");
	session_start();
	$sFileName = "index.php";

	$ret_page = get_param("ret_page");
	$querystring = get_param("querystring");
	$logout = get_param("pk_logout");
	$login = get_param("pk_login");
	$logoutPassed = false;
	$loginPassed = false;
	$submit = get_param("submit");
	$sLoginFormErr = "";

        switch ($submit) {
		case "Ouvrir Session":
		    $sNomDeLogin = get_param("nomDeLogin");
		    $sMotDePasse = get_param("motDePasse");
		    $sSQL =	"SELECT personnel_id, niveau_de_securite " .
				  	"FROM Personnel " .
					"WHERE nom_de_login = " . tosql($sNomDeLogin, "Text") . " AND  mot_de_passe = " . tosql($sMotDePasse, "Text");
// printf("admLoginQuery: %s \n", $sSQL);
			$db->query($sSQL);
		    $is_passed = $db->next_record();
		    if (0 <> $is_passed)
		    {
		    	set_session("UserID", $db->f("personnel_id"));
			set_session("UserRights", $db->f("niveau_de_securite"));
				 $sPage = get_param("ret_page");
				$loginPassed = true;
				if ($db->f("niveau_de_securite") >= 3) {
					if (!strlen($sPage)) 
						$sPage = "administrateur/adminIndex.php";
					echo $sPage;
				}
				else {
					$sPage = "personnel/personnelIndex.php";
                                }
                      		?>
				<script language="JavaScript">
					var retpage = "<?php echo  $sPage ?>";
					window.open(retpage, "_self");
				</script>
				<?php
echo "return";
				return;
			}
		    else { 
				$sLoginFormErr = "Nom de Login ou Mot de passe est incorrect.";
// printf("admLoginQuery failed \n");
                       }
		break;
		case "Fermer Session":
			break;
		case  "Mot de passe oublié":
			break;
	}
?>
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#CCFFCC">
<p>&nbsp;</p>
<form method="post" action="index.php" name="login">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="37" colspan="3"> 
        <p align="center"><b><font size="6">Emploi du Temps & Agenda en ligne</font></b></p>
      </td>
    </tr>
    <tr> 
      <td colspan="3"> 
        <div align="center">&nbsp;</div>
      </td>
    </tr>
	<p></p>
<?php if ($sLoginFormErr != "") { ?>
    <tr valign="bottom" align="center"> 
      <td colspan="3" height="44"> 
        <div align="center"> 
          <p><font color="#FF0000"><b><br>
            Nom de Login ou Mot de passe est incorrect!</b></font></p>
          <p>&nbsp;</p>
        </div>
      </td>
    </tr>
<?php } ?>
    <tr> 
      <td width="39%"> 
        <div align="right"><b>Nom de login: </b></div>
      </td>
      <td width="49%"> 
        <div align="left"></div>
        <p align="left"> 
          <input type="text" name="nomDeLogin" size="30" maxlength="20">
        </p>
      </td>
      <td width="12%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="39%" height="31"> 
        <div align="right"><b>Mot de Passe: </b></div>
      </td>
      <td width="49%" height="31"> 
        <div align="left"> 
          <input type="password" name="motDePasse" size="30" maxlength="20">
        </div>
      </td>
      <td width="12%" height="31">&nbsp;</td>
    </tr>
    <tr> 
      <td width="39%">&nbsp;</td>
      <td width="49%"> 
        <div align="left"> 
          <input type="submit" name="submit" value="Ouvrir Session">
        </div>
      </td>
      <td width="12%">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3"> 
        <div align="center"></div>
      </td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3"> 
        <div align="center"></div>
      </td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
<!--
    <tr>
      <td colspan="3">
        <div align="center">&lt;<a href="../user/index.php">Emploi du Temps</a>&gt; 
          &nbsp;&nbsp;&nbsp;&nbsp;&lt;<a href="http://192.168.100.2/trombi/">Trombinoscope</a>&gt;&nbsp;&nbsp;&nbsp;&nbsp; 
          &lt;<a href="http://10.230.33.107/site_ifi">IFI Site</a>&gt;</div>
      </td>
    </tr>
  </table>
-->
</form>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
</body>
</html>
