<?php require_once('Connections/inst.php'); ?>
<?php



if (!isset($_SESSION)) {
  session_start();
}
$patch_img_1 = rand(1,10);
$user_info = $_SESSION['MM_Username'];


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

$colname_st = "-1";
if (isset($_SESSION['MM_Username'])) 
{
  $colname_st = $_SESSION['MM_Username'];
}
mysqli_select_db($database_inst, $inst);
$query_st = "SELECT * FROM students WHERE login = '$colname_st'";
$st = mysqli_query($inst, $query_st);
$row_st = mysqli_fetch_assoc($st);
$totalRows_st = mysqli_num_rows($st);


$colname_si_inst_info = "-1";
if (isset($row_st['inst_key'])) {
  $colname_si_inst_info = $row_st['inst_key'];
}
mysqli_select_db($database_inst, $inst);
$query_si_inst_info = "SELECT inst_name FROM institutions WHERE inst_key = $colname_si_inst_info";
$si_inst_info = mysqli_query($inst, $query_si_inst_info);
$row_si_inst_info = mysqli_fetch_assoc($si_inst_info);
$totalRows_si_inst_info = mysqli_num_rows($si_inst_info);
 
?>

<!DOCTYPE html>
<html>
<head>

</head>
  <title>eParent - Profile</title>

  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Quicksand:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
<body>

<div class="navbar-wrapper">
  <div class="login-wrapper">
    <a href="index.html" class="login-button">
      Home
    </a>
  </div>
</div>

<div class="logo-wrapper">
  <div class="logo">
    eParent
  </div>
</div>

<div class="content-wrapper">


  <div class="field-wrapper contained profile" style="height:1200px !important;">
    <h1>Profile</h1>
    <hr>
    <div class="profile-summary left">
      <div class="photo-wrapper">
      
      <img class="photo" src="st_pics/<?php echo $user_info = $_SESSION['MM_Username']; ?>.jpg" alt="Empty profile picture">
      
      </div>
      <div class="info-attribute">
        First Name
      </div>
      <div class="info-value">
        <?php echo $row_st['first_name']; ?>
      </div>
      <div class="info-attribute">
        Second Name
      </div>
      <div class="info-value">
        <?php echo $row_st['second_name']; ?>
      </div>
      <div class="info-attribute">
        Institute Name
      </div>
      <div class="info-value">
        <?php echo $row_si_inst_info['inst_name']; ?>
      </div>
    </div>


    <div class="prediction-wrapper right">

    <div class="login-wrapper">
        <a href="details.html" class="login-button">
          Details
        </a>
      </div>
      <h2>Our prediction</h2>
      <div class="prediction">

        <?php

          if( file_exists( ' st_picsf/ '. $user_info = $_SESSION['MM_Username'] ) ){
            exec_shell( 'python eParent_algo_v2.py' );

            $patch_img_1 = "script_out/". $_SESSION['MM_Username'] .'_1.png';
            $patch_img_2 = "script_out/". $_SESSION['MM_Username'] .'_2.png';
            $patch_img_3 = "script_out/". $_SESSION['MM_Username'] .'_3.png';
          }
        ?>

        <img src="/script_out/<?php echo $patch_img_1?>_1.png" alt="Smiley face" height="300" width="500"><br><br>
        <img src="/script_out/<?php echo $patch_img_1?>_2.png" alt="Smiley face" height="300" width="500"><br><br>
        <img src="/script_out/<?php echo $patch_img_1?>_3.png" alt="Smiley face" height="300" width="500">

        
      </div>
   
      
    </div>
  </div>

</div>

</body>
</html>
<?php
mysql_free_result($st);

mysql_free_result($si_inst_info);
?>
