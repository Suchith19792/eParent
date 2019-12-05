<?php require_once('Connections/inst.php'); ?><?php
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


$colname_DetailRS1 = $_GET['sid'];

mysql_select_db($inst, $database_inst);
$query_DetailRS1 = "SELECT * FROM students  WHERE stud_key = '$colname_DetailRS1'";
$DetailRS1 = mysqli_query($inst, $query_DetailRS1);
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);


$colname_si_inst_info = "-1";
if (isset($row_DetailRS1['inst_key'])) {
  $colname_si_inst_info = $row_DetailRS1['inst_key'];
}
mysql_select_db($database_inst, $inst);
$query_si_inst_info = "SELECT inst_name FROM institutions WHERE inst_key = $colname_si_inst_info";
$si_inst_info = mysqli_query($inst, $query_si_inst_info);
$row_si_inst_info = mysqli_fetch_assoc($si_inst_info);
$totalRows_si_inst_info = mysqli_num_rows($si_inst_info);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<title>eParent - Register</title>

  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Quicksand&display=swap" rel="stylesheet">
</head>
  
<body>

<link href="ss2.css" rel="stylesheet" type="text/css">
<p>&nbsp;</p>
<p>&nbsp;</p>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<nav class="menu">
  <ol>
    <li class="menu-item"><a href="http://eparent.epizy.com/Authintication_withFrontEnd/index.html">Home</a></li>
    <li class="menu-item"><a href="#0">About</a>
    <ol class="sub-menu">
        <li class="menu-item"><a href="http://eparent.epizy.com/Authintication_withFrontEnd/about_team.html">Team Members</a></li>
        <li class="menu-item"><a href="http://eparent.epizy.com/Authintication_withFrontEnd/about_system.html">About the System</a></li>
    </ol>
    </li>
    <li class="menu-item"><a href="#0">Register</a>
      <ol class="sub-menu">
        <li class="menu-item"><a href="http://eparent.epizy.com/Authintication_withFrontEnd/register_inst.php">Institute Registration</a></li>
        <li class="menu-item"><a href="http://eparent.epizy.com/Authintication_withFrontEnd/register_st.php">Student Registration</a></li>
      </ol>
    </li>
    <li class="menu-item"><a href="#0">Login</a>
      <ol class="sub-menu">
        <li class="menu-item"><a href="http://eparent.epizy.com/Authintication_withFrontEnd/login_inst.php">Institute Login</a></li>
        <li class="menu-item"><a href="http://eparent.epizy.com/Authintication_withFrontEnd/login_st.php">Student Login</a></li>
        </ol>
    </li>
      </ol>
</nav>

<div class="content-wrapper">


  <div class="field-wrapper contained">
    
    <table border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td class="answer"><strong>Student Key</strong></td>
    <td class="answer"><?php echo $row_DetailRS1['stud_key']; ?></td>
  </tr>
  <tr>
    <td class="answer"><strong>Institute Name</strong></td>
    <td class="answer"><?php echo $row_si_inst_info['inst_name']; ?></td>
  </tr>
  <tr>
    <td class="answer"><strong>Login</strong></td>
    <td class="answer"><?php echo $row_DetailRS1['login']; ?></td>
  </tr>
  <tr>
    <td class="answer"><strong>Password</strong></td>
    <td class="answer"><?php echo $row_DetailRS1['password']; ?></td>
  </tr>
  <tr>
    <td class="answer"><strong>First Name</strong></td>
    <td class="answer"><?php echo $row_DetailRS1['first_name']; ?></td>
  </tr>
  <tr>
    <td class="answer"><strong>Second Name</strong></td>
    <td class="answer"><?php echo $row_DetailRS1['second_name']; ?></td>
  </tr>
</table>


<a href="profile_inst.php">Back</a> 
  </div>

</div>






</body>
</html><?php
mysql_free_result($DetailRS1);
?>