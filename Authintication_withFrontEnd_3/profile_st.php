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
$query_st = "SELECT * FROM students WHERE login = '$colname_st'";
$st = mysqli_query($inst, $query_st);
$row_st = mysqli_fetch_assoc($st);
$totalRows_st = mysqli_num_rows($st);


$colname_si_inst_info = "-1";
if (isset($row_st['inst_key'])) {
  $colname_si_inst_info = $row_st['inst_key'];
}
mysql_select_db($database_inst, $inst);
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


  <div class="field-wrapper contained profile">
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
      <div class="info-attribute">
      <?php
    
    if(isset($_GET['password'])){
        mysql_select_db($database_inst, $inst);

        $s_id = $row_st['stud_key'];
        $s_name = $_GET["password"];
        $s_grade = $_GET["email"];

    $query = "INSERT into st_data(stud_key, subject_name, gr_data) values('$s_id','$s_name','$s_grade')";
    mysqli_query($inst, $query);

    }

    ?>
     <p>&nbsp;</p>
Add a Grade
    <form method="get"> 
    

    <label id="first">Subject Name</label><br/>

    <select name="password">
        <option value="grade1_maths" >grade1_maths</option>
        <option value="grade2_maths" >grade2_maths</option>
        <option value="grade3_maths" >grade3_maths</option>
        <option value="grade4_maths" >grade4_maths</option>
        <option value="grade5_maths" >grade5_maths</option>
        <option value="grade6_maths" >grade6_maths</option>
        <option value="grade7_maths" >grade7_maths</option>
        <option value="grade8_maths" >grade8_maths</option>
        <option value="grade9_maths" >grade9_maths</option>
        <option value="grade10_maths" >grade10_maths</option>
        
        <option value="grade1_science" >grade1_science</option>
        <option value="grade2_science" >grade2_science</option>
        <option value="grade3_science" >grade3_science</option>
        <option value="grade4_science" >grade4_science</option>
        <option value="grade5_science" >grade5_science</option>
        <option value="grade6_science" >grade6_science</option>
        <option value="grade7_science" >grade7_science</option>
        <option value="grade8_science" >grade8_science</option>
        <option value="grade9_science" >grade9_science</option>
        <option value="grade10_science" >grade10_science</option>
        
        <option value="grade1_language" >grade1_language</option>
        <option value="grade2_language" >grade2_language</option>
        <option value="grade3_language" >grade3_language</option>
        <option value="grade4_language" >grade4_language</option>
        <option value="grade5_language" >grade5_language</option>
        <option value="grade6_language" >grade6_language</option>
        <option value="grade7_language" >grade7_language</option>
        <option value="grade8_language" >grade8_language</option>
        <option value="grade9_language" >grade9_language</option>
        <option value="grade10_language" >grade10_language</option>
        
      </select>
<br>
    <label id="first">Grade</label><br/>
    <input type="number" name="email" max="100"><br/>

    <button type="submit" name="save">save</button>
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

mysql_free_result($si_inst_info);
?>
