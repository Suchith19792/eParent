<?php 
require_once('Connections/inst.php');
 ?>
<?php

error_reporting(0);



if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}


class postInfo
{
	public $uName;
	public $pp;
	
	function setPost($v1, $v2)
	{
		$this->uName = $v1;
		$this->pp = $v2;
	}
}



if (isset($_POST['user_name'])) 
{
	
	$cObj = new postInfo();
	$cObj->setPost( $_POST['user_name'], $_POST['pwd']);
	
    
	
  $loginUsername=$cObj->uName;
  $password=$cObj->pp;
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "profile_inst.php";
  $MM_redirectLoginFailed = "login_inst.php?a=1";
  $MM_redirecttoReferrer = false;
  
  
  /*//mysql_select_db($database_inst, $inst);
  $LoginRS = mysqli_query($inst,"SELECT * FROM `students` WHERE login = '.$loginUsername.' AND password = '.$password.'");
  //$LoginRS__query=sprintf("SELECT login, password FROM students WHERE login=%s AND password=%s",
  //  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  //$LoginRS = mysql_query($LoginRS__query, $inst) ;
  $loginFoundUser = mysql_num_rows($LoginRS);*/

$qu = "SELECT * FROM institutions WHERE login = '$loginUsername' AND password = '$password'";
$row = mysqli_query($inst, $qu);
$r = mysqli_fetch_assoc($row);
$loginFoundUser = mysqli_num_rows($row);

  if ($loginFoundUser) 
  {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) 
    {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else 
  {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><html>
<head>
<title>eParent - Login</title>

  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Quicksand&display=swap" rel="stylesheet">
  
  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
  
<body>

<link href="ss2.css" rel="stylesheet" type="text/css">

<nav class="menu">
  <ol>
    <li class="menu-item"><a href="index.html">Home</a></li>
    <li class="menu-item"><a href="#0">About</a>
    <ol class="sub-menu">
        <li class="menu-item"><a href="about_team.html">Team Members</a></li>
        <li class="menu-item"><a href="about_system.html">About the System</a></li>
    </ol>
    </li>
    <li class="menu-item"><a href="#0">Register</a>
      <ol class="sub-menu">
        <li class="menu-item"><a href="register_inst.php">Institute Registration</a></li>
        <li class="menu-item"><a href="register_st.php">Student Registration</a></li>
      </ol>
    </li>
    <li class="menu-item"><a href="#0">Login</a>
      <ol class="sub-menu">
        <li class="menu-item"><a href="login_inst.php">Institute Login</a></li>
        <li class="menu-item"><a href="login_st.php">Student Login</a></li>
        </ol>
    </li>
  </ol>
</nav>


<div class="content-wrapper">


  <div class="field-wrapper contained h-short">
    <h1>Institute Login</h1>
    <hr>
    
    
      <div class="panel">
      <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
        
        <table width="300" align="center" cellpadding="0"><tr>
        
        <td class="question left right-align">
          User Name
        </td>
        <td class="answer right short">
          
          
          <label for="user_name"></label>
        <span id="sprytextfield1">
        <input type="text" name="user_name" id="user_name" placeholder="Value"/>
      <span class="textfieldRequiredMsg">Feild is required.</span></span>
      
        </td></tr>
        <tr><td class="question left right-align">
          Password
        </td>
        <td class="answer right short">
        <span id="sprytextfield2">
        <input type="password" name="pwd" id="pwd" placeholder="Value"/>
      <span class="textfieldRequiredMsg">Feild is required.</span></span>
          
        </td></tr>
        <tr>
          <td class="question left right-align">&nbsp;</td>
          <td class="answer right short"><input name="login" type="submit" class="sbmt" id="login" value="Submit" /></td>
        </tr>
        </table>
        
        
        </form>
      </div>
    </div>
  </div>
<?php
  if ($_GET['a'] == 1)
  {
	  echo "<script>alert('Wrong Username or Password');</script>";
  }
  ?>
  
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>
