<?php
/*********************************************************************************
 *       Filename: common.php
 *********************************************************************************/
error_reporting (E_ALL ^ E_NOTICE);

include("./db_mysql.inc");

define("DATABASE_NAME","edtifi");
define("DATABASE_USER","root");
define("DATABASE_PASSWORD","ifipassword");
define("DATABASE_HOST","mysql");

// Database Initialize
$db = new DB_Sql();
$db->Database = DATABASE_NAME;
$db->User     = DATABASE_USER;
$db->Password = DATABASE_PASSWORD;
$db->Host     = DATABASE_HOST;

//if ($db->Debug)		//test contectivity - Quang added
//	$db->query("SELECT * FROM Emploi WHERE etat='actif'");

/* Quang commented
define("TROMBI_DATABASE_NAME","trombi");
define("TROMBI_DATABASE_USER","trombi");
define("TROMBI_DATABASE_PASSWORD","trombi");
define("TROMBI_DATABASE_HOST","192.168.100.2");

// Database Initialize
$trombi = new DB_Sql();
$trombi->Database = TROMBI_DATABASE_NAME;
$trombi->User     = TROMBI_DATABASE_USER;
$trombi->Password = TROMBI_DATABASE_PASSWORD;
$trombi->Host     = TROMBI_DATABASE_HOST;
*/
// Obtain the path where this site is located on the server
$app_path = ".";

// check email address
function isEmailAddress($strValue)
{
	return  preg_match('^([._a-z0-9-]+[._a-z0-9-]*)@(([a-z0-9-]+\.)*([a-z0-9-]+)(\.[a-z]{2,3}))$',$strValue);
}

// check email address
function isNameString($strValue)
{
	return  true;//eregi('^([a-z]+[-a-z]*) ([a-z]+[-a-z]*)*',$strValue);
}

// Convert non-standard characters to HTML
function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}

// Convert value to URL
function tourl($strValue)
{
  return urlencode($strValue);
}

// Obtain specific URL Parameter from URL string
function get_param($param_name)
{
/* Deprecated variables
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;
*/
  $param_value = "";
  if(isset($_POST[$param_name]))
    $param_value = $_POST[$param_name];
  else if(isset($_GET[$param_name]))
    $param_value = $_GET[$param_name];

  return $param_value;
}

function get_session($param_name)
{
/*  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;*/
  global ${$param_name};

  $param_value = "";
  if(!isset($_POST[$param_name]) && !isset($_GET[$param_name]) && isset($_SESSION[$param_name]))
    $param_value = ${$param_name};

  return $param_value;
}

function set_session($param_name, $param_value)
{
  global ${$param_name};
/*  if(session_is_registered($param_name)) //deprecated - Quang
    session_unregister($param_name);
  ${$param_name} = $param_value;
  session_register($param_name);*/
 if(isset($_SESSION[$param_name]))
    unset($_SESSION[$param_name]);
  ${$param_name} = $param_value;
  $_SESSION[$param_name] = $param_value;
}

function is_number($string_value)
{
  if(is_numeric($string_value) || !strlen($string_value))
    return true;
  else
    return false;
}

// Convert value for use with SQL statament
function tosql($value, $type)
{
  if(!strlen($value))
    return "NULL";
  else
    if($type == "Number")
      return str_replace (",", ".", doubleval($value));
    else
    {
      if(get_magic_quotes_gpc() == 0)
      {
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
      }

      return "'" . $value . "'";
    }
}

function strip($value)
{
  if(get_magic_quotes_gpc() == 0)
    return $value;
  else
    return stripslashes($value);
}

function db_fill_array($sql_query)
{
  global $db;
  $db_fill = new DB_Sql();
  $db_fill->Database = $db->Database;
  $db_fill->User     = $db->User;
  $db_fill->Password = $db->Password;
  $db_fill->Host     = $db->Host;

  $db_fill->query($sql_query);
  if ($db_fill->next_record())
  {
    do
    {
      $ar_lookup[$db_fill->f(0)] = $db_fill->f(1);
    } while ($db_fill->next_record());
    return $ar_lookup;
  }
  else
    return false;

}

// Deprecated function - use get_db_value($sql)
function dlookup($table_name, $field_name, $where_condition)
{
  $sql = "SELECT " . $field_name . " FROM " . $table_name . " WHERE " . $where_condition;
  return get_db_value($sql);
}

// Lookup field in the database based on SQL query
function get_db_value($sql)
{
  global $db;
  $db_look = new DB_Sql();
  $db_look->Database = $db->Database;
  $db_look->User     = $db->User;
  $db_look->Password = $db->Password;
  $db_look->Host     = $db->Host;

  $db_look->query($sql);
  if($db_look->next_record())
    return $db_look->f(0);
  else
    return "";
}

// Obtain Checkbox value depending on field type
function get_checkbox_value($value, $checked_value, $unchecked_value, $type)
{
  if(!strlen($value))
    return tosql($unchecked_value, $type);
  else
    return tosql($checked_value, $type);
}

// Obtain lookup value from array containing List Of Values
function get_lov_value($value, $array)
{
  $return_result = "";

  if(sizeof($array) % 2 != 0)
    $array_length = sizeof($array) - 1;
  else
    $array_length = sizeof($array);

  for($i = 0; $i < $array_length; $i = $i + 2)
  {
    if($value == $array[$i]) $return_result = $array[$i+1];
  }

  return $return_result;
}

// Verify user's security level and redirect to login page if needed
function check_security($security_level)
{
  global $UserRights;
//printf("UserID = %s, UserRights = %s\n",$_SESSION["UserID"], $_SESSION["UserRights"]);
//  if(!session_is_registered("UserID")) - deprecated - Quang
  if(!isset($_SESSION["UserID"]))
    header ("Location: adminLogout.php");
//    header ("Location: loginForm.php?querystring=" . urlencode(getenv("QUERY_STRING")) . "&ret_page=" . 	urlencode(getenv("REQUEST_URI")));
  else
//	 if (!session_is_registered("UserRights") || $UserRights < $security_level)
	 if (!isset($_SESSION["UserRights"]) || $_SESSION["UserRights"] < $security_level)
    		header ("Location: adminLogout.php");
//    header ("Location: loginForm.php?querystring=" . urlencode(getenv("QUERY_STRING")) . "&ret_page=" . 	urlencode(getenv("REQUEST_URI")));
//printf("QUERY_STRING: %s, REQUEST_URI: %s\n", urlencode(getenv("QUERY_STRING")), urlencode(getenv("REQUEST_URI")));
}

?>
