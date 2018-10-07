<?php
	include ("./common.php");
	include ("./styles.inc");
	session_start();
	check_security(3);
	$sFileName = "participant.php";
	$sAction = get_param("FormAction");
	$sForm = get_param("FormName");
	$smembresErr = "";
	switch ($sForm) {
	  case "membres":
	    membres_action($sAction);
	  break;
	}
?>

<html>
	<head>
		<title>Profile</title>
		<meta name="GENERATOR" content="Ecole d'été en informatique 2002">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	</head>
	<body leftmargin="0" topmargin="0" bgcolor="#FFFFCC" <?php echo  $styles["PageBODY"] ?>>

		<table width = "570" align = "center" <?php echo  $styles["FormTABLE"] ?>>
			<tr>
				<CENTER>
				<?php profile_show() ?>
				</CENTER>
				</td>
			</tr>
		</table>

	</body>
</html>
<?php

function membres_action($sAction)
{
  global $db;
  global $sForm;
  global $smembresErr;
  global $styles;
  $sActionFileName = "listMember.php";
  $sWhere = "";
  $bErr = false;
  $pPKid = "";

  if($sAction == "cancel")
  {
     header("Location: " . $sActionFileName);
	 return;
  }
  if($sAction == "update" || $sAction == "delete") 
  {
	$pPKid = get_param("PK_id");
    if( !strlen($pPKid)) return;
    $sWhere = "id=" . tosql($pPKid, "Number");
  }
  $fldcheck = get_param("check");
  $fldname = get_param("name");
  $fldgenre = get_param("genre");
  $fldposition = get_param("position");
  $fldoffice = get_param("office");
  $fldemail = get_param("email");
  $fldtelephone = get_param("telephone");
  $fldfax = get_param("fax");
  $fldday = get_param("day");
  $fldmonth = get_param("month");
  $fldyear = get_param("year");
  $fldpassword = get_param("password");
  $fldlevel_security = get_param("level_security");

  if($sAction == "update") 
  {
	// data validator
	if(!strlen($fldname))
	  $smembresErr .= "Il faut donner la valeur à la champs Nom.<br>";

	if(!strlen($fldoffice))
	  $smembresErr .= "Il faut donner la valeur à la champs Bureau.<br>";

	if(!strlen($fldposition))
	  $smembresErr .= "Il faut donner la valeur à la champs Position.<br>";

	if(!strlen($fldoffice))
	  $smembresErr .= "Il faut donner la valeur à la champs Office.<br>";

	if(!strlen($fldemail))
	  $smembresErr .= "Il faut donner la valeur à la champs Email.<br>";
    else 
		if ($fldlevel_security <3 && !isEmailAddress($fldemail))
			$smembresErr .= "La valeur à la champs Email est incorrecte.<br>";
		else {
			$sSQL = "select email from membres where email='" . $fldemail 
				. "' and " . "id != " . tosql($pPKid, "Number");
			$db->query($sSQL);
			if ($db->next_record()) 
				$smembresErr .= "Ce courriel est utilisé par une autre personne.<br>";
		}

	if(!checkdate(tosql($fldmonth,"Number"),tosql($fldday,"Number"), tosql($fldyear, "Number")))
	  $smembresErr .= "La date de naissance est invalide.<br>";


	if(!strlen($fldpassword))
	  $smembresErr .= "Il faut donner la valeur à la champs 'Mot de passe'.<br>";

	if(!is_number($fldlevel_security))
	  $smembresErr .= "La valeur dans la champs Niveau sécurité est incorrecte.<br>";

	if(strlen($smembresErr)) return;
  }

  $fldbirdthday = $fldyear . "-" . $fldmonth . "-" . $fldday;

  switch(strtolower($sAction)) 
  {
    case "update":
        $sSQL = "update membres set " .
          "check=" . tosql($fldcheck, "Number") .
          ",name=" . tosql($fldname, "Text") .
          ",genre=" . tosql($fldgenre, "Text") .
          ",position=" . tosql($fldposition, "Text") .
          ",office=" . tosql($fldoffice, "Text") .
          ",email=" . tosql($fldemail, "Text") .
          ",telephone=" . tosql($fldtelephone, "Text") .
          ",fax=" . tosql($fldfax, "Text") .
          ",birdthday=" . tosql($fldbirdthday, "Date") .
          ",password=" . tosql($fldpassword, "Text") .
          ",level_security=" . tosql($fldlevel_security, "Number");
        $sSQL .= " where " . $sWhere;
    break;
    case "delete":
		if ($fldlevel_security >=3) return;
        $sSQL = "delete from membres where " . $sWhere;
    break;
  }
  if(strlen($smembresErr)) return;
  $db->query($sSQL);
  header("Location: " . $sActionFileName);
}

function profile_show()
{
  global $db;
  
  global $sAction;
  global $sForm;
  global $sFileName;
  global $smembresErr;
  global $styles;

  $fldid = "";
  $fldcheck = "";
  $fldname = "";
  $fldgenre = "";
  $fldposition = "";
  $fldoffice = "";
  $fldemail = "";
  $fldtelephone = "";
  $fldfax = "";
  $fldbirdthday = "";
  	$fldday = "";
	$fldmonth = "";
	$fldyear = "";
  $fldpassword = "";
  $fldlevel_security = "";
  $sFormTitle = "Profile du participant";
  $sWhere = "";
?>
   <form method="POST" action="<?php echo  $sFileName ?>" name="membres">
   <tr>
	<td bgcolor="#660033" <?php echo  $styles["FormHeaderTD"] ?> colspan="2"><font <?php echo  $styles["FormHeaderFONT"] 			?>><?php echo $sFormTitle?></font>
	</td></tr>

   <?php if ($smembresErr) { ?>
		<tr><td <?php echo  $styles["DataTD"] ?> colspan="2"><font <?php echo  $styles["ErrorFONT"] ?>><?php echo  $smembresErr ?></font></td></tr>
	 <?php } ?>
<?php 
  if($smembresErr == "")
  {
    $fldid = get_param("id");
	$pid = get_param("id");
	$sWhere .= "id=" . tosql($pid, "Number");
	// check = 1
	$sSQL = "update membres set check=1 where " . $sWhere;
	$db->query($sSQL);
	// get data
	$sSQL = "select * from membres where " . $sWhere;
	$db->query($sSQL);
	$db->next_record();
    $fldcheck = $db->f("check");
    $fldid = $db->f("id");
    $fldname = $db->f("name");
	$fldgenre = $db->f("genre");
	$fldposition = $db->f("position");
	$fldoffice = $db->f("office");
	$fldemail = $db->f("email");
	$fldtelephone = $db->f("telephone");
	$fldfax = $db->f("fax");
	$fldbirdthday = $db->f("birdthday");
	list($fldyear, $fldmonth, $fldday) = sscanf($fldbirdthday,"%d-%d-%d");
	$fldpassword = $db->f("password");
	$fldlevel_security = $db->f("level_security");

  }
  else
  {
    $fldid = strip(get_param("id"));
    $fldcheck = strip(get_param("check"));
    $fldname = strip(get_param("name"));
    $fldgenre = strip(get_param("genre"));
    $fldposition = strip(get_param("position"));
    $fldoffice = strip(get_param("office"));
    $fldemail = strip(get_param("email"));
    $fldtelephone = strip(get_param("telephone"));
    $fldfax = strip(get_param("fax"));
    $fldbirdthday = strip(get_param("birdthday"));
	$fldday = strip(get_param("day"));
	$fldmonth = strip(get_param("month"));
	$fldyear = strip(get_param("year"));
	$fldpassword = strip(get_param("password"));
    $fldlevel_security = strip(get_param("level_security"));
	$pid = get_param("PK_id");
  }
    ?>
      <tr>
       <td width = 120 <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Nom*</font>
       </td>
       <td width = 450 <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="name" maxlength="50" value="<?php echo  tohtml($fldname) ?>" size="50" ></font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Genre </font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>>
<?php
    $LOV = split(";", "Homme;Homme;Femme;Femme");
  
    if(sizeof($LOV)%2 != 0) 
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);
    
    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $fldgenre) 
        $option="<input type=\"radio\" name=\"genre\" value=\"". $LOV[$i] ."\" checked > <font " .$styles["DataFONT"]." >".$LOV[$i + 1]."</font>";
      else
        $option="<input type=\"radio\" name=\"genre\" value=\"". $LOV[$i] ."\" > <font " .$styles["DataFONT"]." >".$LOV[$i + 1]."</font>";

      echo $option;
    }

?></font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Position*</font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="position" maxlength="40" value="<?php echo  tohtml($fldposition) ?>" size="40" ></font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Université*</font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="office" maxlength="30" value="<?php echo  tohtml($fldoffice) ?>" size="30" ></font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Courriel*</font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="email" maxlength="40" value="<?php echo  tohtml($fldemail) ?>" size="20" >&nbsp;&nbsp;par ex: thanhbon@yahoo.com</font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Téléphone</font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="telephone" maxlength="15" value="<?php echo  tohtml($fldtelephone) ?>" size="15" ></font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Fax</font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="fax" maxlength="15" value="<?php echo  tohtml($fldfax) ?>" size="15" ></font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Date de naissance  </font>
       </td>
    <td <?php echo  $styles["DataTD"] ?>> <font <?php echo  $styles["DataFONT"] ?>> 
      <input type="text" name="day" maxlength="2" value="<?php echo  tohtml($fldday) ?>" size="6">
      <select name="month">
        <option value="1" <?php if($fldmonth=="1") echo("selected"); ?>>1</option>
        <option value="2" <?php if($fldmonth=="2") echo("selected"); ?>>2</option>
        <option value="3" <?php if($fldmonth=="3") echo("selected"); ?>>3</option>
        <option value="4" <?php if($fldmonth=="4") echo("selected"); ?>>4</option>
        <option value="5" <?php if($fldmonth=="5") echo("selected"); ?>>5</option>
        <option value="6" <?php if($fldmonth=="6") echo("selected"); ?>>6</option>
        <option value="7" <?php if($fldmonth=="7") echo("selected"); ?>>7</option>
        <option value="8" <?php if($fldmonth=="8") echo("selected"); ?>>8</option>
        <option value="9" <?php if($fldmonth=="9") echo("selected"); ?>>9</option>
        <option value="10" <?php if($fldmonth=="10") echo("selected"); ?>>10</option>
        <option value="11" <?php if($fldmonth=="11") echo("selected"); ?>>11</option>
        <option value="12" <?php if($fldmonth=="12") echo("selected"); ?>>12</option>
      </select>
      <input type="text" name="year" maxlength="4" value="<?php echo  tohtml($fldyear) ?>" size="10" >
      &nbsp; &nbsp;(dd-mm-yyyy par ex: 15-3-1974)</font> </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Mot de passe*</font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="password" maxlength="20" value="<?php echo  tohtml($fldpassword) ?>" size="20" ></font>
       </td>
     </tr>
      <tr>
       <td <?php echo  $styles["FieldCaptionTD"] ?>>
         <font <?php echo  $styles["FieldCaptionFONT"] ?>>Niveau sécurité</font>
       </td>
       <td <?php echo  $styles["DataTD"] ?>>
         <font <?php echo  $styles["DataFONT"] ?>><input type="text" name="level_security" maxlength="6" value="<?php echo  tohtml($fldlevel_security) ?>" size="6" ></font>
       </td>
     </tr>

	<tr>
		<td <?php echo  $styles["FormHeaderTD"] ?> colspan="2"><font <?php echo  $styles["FormHeaderFONT"] 			?>>&nbsp;</font>
	</td></tr>

	<tr >
		<td colspan = "2" align="left">
			  <input type="hidden" value="update" name="FormAction"/>
			  <input type="submit" value="Sauvegarder" onclick="document.membres.FormAction.value = 'update';">
			  <input type="submit" value="Supprimer" onclick="document.membres.FormAction.value = 'delete';">
			  <input type="submit" value="Annuler" onclick="document.membres.FormAction.value = 'cancel';">
			  <input type="hidden" name="FormName" value="membres">
			  <input type="hidden" name="PK_id" value="<?php echo  $pid ?>">  
			  <input type="hidden" name="id" value="<?php echo  tohtml($fldid)?>">
			  <input type="hidden" name="check" value="<?php echo  tohtml($fldcheck)?>">
		</td>
	</tr>

 </form>
</table>
<?php
}
?>