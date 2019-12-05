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



//upload code
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
    $item1 = mysqli_real_escape_string($inst, $data[0]);  
    $item2 = mysqli_real_escape_string($inst, $data[1]);
	$item3 = mysqli_real_escape_string($inst, $data[2]);
    $query = "INSERT into st_data(stud_key, subject_name, gr_data) values('$item1','$item2','$item3')";
    mysqli_query($inst, $query);
   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
 }
}




?>

<!DOCTYPE html>
<html>
<head>

</head>
  <title>eParent - Profile</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Quicksand:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
<body>

<link href="ss2.css" rel="stylesheet" type="text/css">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
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

  <div class="field-wrapper contained profile">
    <h1>Profile</h1>
    <hr>
    <div class="profile-summary left">
      <div class="photo-wrapper">
      
      <img width="150" class="photo" src="inst_pics/<?php echo $user_info = $_SESSION['MM_Username']; ?>.jpg" alt="Empty profile picture">
      
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

<div class="info-attribute">
      <form method="post" enctype="multipart/form-data">
   <div align="center">  
    <label>Select Grades File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
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
        <a href="details.php" class="login-button">
          Details
        </a>
      </div>
      


<p>&nbsp;</p>

     <table border="1" cellpadding="5" cellspacing="5">
   <tr>
     <td><strong>First Name</strong></td>
     <td><strong>Second Name</strong></td>
   </tr>
   <?php do { ?>
     <tr>
       <td><a href="st_details.php?sid=<?php echo $row_num_of_st['stud_key'] ?>"><?php echo $row_num_of_st['first_name']; ?></a></td>
       <td><?php echo $row_num_of_st['second_name']; ?></td>
     </tr>
     <?php } while ($row_num_of_st = mysql_fetch_assoc($num_of_st)); ?>
 </table>



    </div>
    
  </div>

</div>



 

</body>
</html>
<?php
mysql_free_result($st);

mysql_free_result($num_of_st);
?>
