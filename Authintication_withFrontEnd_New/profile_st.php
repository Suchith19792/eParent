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

<link href="ss2.css" rel="stylesheet" type="text/css">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
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


  <div class="field-wrapper contained profile" style="height:1450px !important;">
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
        mysqli_select_db($database_inst, $inst);

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
    <input type="number" name="email" max="100" min="1"><br/>

    <button type="submit" name="save">save</button>
    </form>
</div>
    
    </div>


    <div class="prediction-wrapper right">

   <!-- <div class="login-wrapper">
        <a href="details.html" class="login-button">
          Details
        </a>
      </div>
      <h2>Our prediction</h2>
      <div class="prediction">-->

        <?php

         if( file_exists( ' st_picsf/ '. $user_info = $_SESSION['MM_Username'] ) ){
            exec_shell( 'python eParent_algo_v2.py' );

            $patch_img_1 = "script_out/". $_SESSION['MM_Username'] .'_1.png';
            $patch_img_2 = "script_out/". $_SESSION['MM_Username'] .'_2.png';
            $patch_img_3 = "script_out/". $_SESSION['MM_Username'] .'_3.png';
          }
        ?>

        <img src="/script_out/<?php echo $patch_img_1?>_1.png" alt="Smiley face" height="450" width="625"><br><br>
        <img src="/script_out/<?php echo $patch_img_1?>_2.png" alt="Smiley face" height="450" width="625"><br><br>
        <img src="/script_out/<?php echo $patch_img_1?>_3.png" alt="Smiley face" height="450" width="625">

        
      </div>
   
      
    </div>
   
     <!-- <div class="login-wrapper">
        <a href="details.html" class="login-button">
          Details
        </a>
      </div>
    </div>
  </div>-->

</div>

</body>
</html>
<?php
mysql_free_result($st);

mysql_free_result($si_inst_info);
?>
