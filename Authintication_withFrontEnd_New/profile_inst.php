<?php require_once('Connections/inst.php'); ?>
<?php


if (!isset($_SESSION)) {
  session_start();
}


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

mysql_select_db($database_inst, $inst);
$query_st = "SELECT * FROM institutions WHERE login = '$colname_st'";
$st = mysqli_query($inst, $query_st);
$row_st = mysqli_fetch_assoc($st);
$totalRows_st = mysqli_num_rows($st);

$colname_num_of_st = "-1";
if (isset($_SESSION['MM_Username'])) 
{
  $colname_num_of_st = $_SESSION['MM_Username'];
}

$nn = $row_st['inst_key'];

mysql_select_db($database_inst, $inst);
$query_num_of_st = "SELECT * FROM students WHERE inst_key = '$nn'";
$num_of_st = mysqli_query($inst, $query_num_of_st);
$row_num_of_st = mysqli_fetch_assoc($num_of_st);
$totalRows_num_of_st = mysqli_num_rows($num_of_st);

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


  <div class="field-wrapper contained profile">
    <h1>Profile</h1>
    <hr>
    <div class="profile-summary left">
      <div class="photo-wrapper">
      
      <img class="photo" src="inst_pics/<?php echo $user_info = $_SESSION['MM_Username']; ?>.jpg" alt="Empty profile picture">
      
      </div>
      <div class="info-attribute">
        Institute Name
      </div>
      <div class="info-value">
        <?php echo $row_st['inst_name']; ?>
      </div>
      
      <div class="info-attribute">
        Number of Students
      </div>
      <div class="info-value">      
         <?php echo $totalRows_num_of_st; ?>
      </div>
    </div>


    <div class="prediction-wrapper right">
      <h2>Our prediction</h2>
      <div class="prediction">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque maximus lorem quis nulla
        fermentum tempor ac ac justo. Vivamus hendrerit, metus non finibus hendrerit, neque mi tincidunt diam,
        et molestie risus erat a ipsum. Nunc et lorem sapien. Fusce dictum ut eros a vestibulum. Nam suscipit erat
        non ex finibus blandit. Nullam porta suscipit velit, vitae mattis dui molestie eu. Curabitur ut maximus purus.
        Aenean porttitor iaculis velit, ut aliquet est lacinia a. In cursus eu mi vitae iaculis. Vestibulum tempor
        lobortis libero, quis placerat velit pellentesque eget.
        Pellentesque eget rhoncus sapien, vel sollicitudin enim. Mauris pharetra est dui, nec sodales est tristique sit amet.
        Donec vestibulum porttitor mauris, at eleifend nisi iaculis in. Quisque non auctor tellus. Aliquam erat volutpat.
        Nullam at cursus lacus. In hac habitasse platea dictumst. Proin pellentesque commodo tincidunt. Aliquam et quam vitae
        nunc malesuada sollicitudin. Sed cursus, sapien eu viverra facilisis, lectus tortor ullamcorper velit, in elementum lorem
        tellus ac nunc. Donec tortor orci, feugiat tempor quam non, mollis viverra odio. Vivamus ultrices nunc in nibh rutrum, ut maximus
        ipsum pulvinar. Vestibulum sem dolor, feugiat et semper molestie, convallis ac justo. Cras accumsan ut lorem ut suscipit.
        Curabitur vel urna non velit facilisis condimentum. Integer vel ante nec ipsum tristique consequat.
      </div>
      <div class="login-wrapper">
        <a href="details.html" class="login-button">
          Details
        </a>
      </div>
    </div>
  </div>

</div>

</body>
</html>
<?php
mysql_free_result($st);

mysql_free_result($num_of_st);
?>
