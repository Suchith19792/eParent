<?php  require_once('Connections/inst.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

class postInfo
{
	public $iKey;
	public $log;
	public $pp;
	public $fName;
	public $sName;
	
	function setPost($v1, $v2, $v3, $v4, $v5)
	{
		$this->iKey = $v1;
		$this->log = $v2;
		$this->pp = $v3;
		$this->fName = $v4;
		$this->sName = $v5;
	}
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) 
{
	move_uploaded_file($_FILES['pic']['tmp_name'], "st_pics/".$_POST['login'].".jpg");
	
		$cObj = new postInfo();
	$cObj->setPost($_POST['inst_key'], $_POST['login'], $_POST['password'], $_POST['first_name'], $_POST['second_name']);
	
	$iKey = $cObj->iKey;
	$log = $cObj->log;
	$pp = $cObj->pp;
	$fName = $cObj->fName;
	$sName = $cObj->sName;
	
  $insertSQL = "INSERT INTO students ( inst_key, login, password, first_name, second_name) VALUES ('$iKey', '$log', '$pp', '$fName', '$sName')";

 
	  echo "<script>alert('New Student Inserted Successfully');</script>";
  

if ($inst->query($insertSQL) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insertSQL . "<br>" . $inst->error;
}

  //mysqli_select_db($database_inst, $inst);
  //$Result1 = mysqli_query($insertSQL, $inst) or die(mysql_error());
}


//mysql_select_db($database_inst, $inst);
/*$query_inst_names = "SELECT * FROM institutions";
$inst_names = mysqli_query($query_inst_names, $inst);
$row_inst_names = mysqli_fetch_assoc($inst_names);
$totalRows_inst_names = mysqli_num_rows($inst_names);
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<title>eParent - Register</title>

  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Quicksand&display=swap" rel="stylesheet">
</head>
  
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


  <div class="field-wrapper contained">
    <h1>Student Register</h1>
    <form  action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <hr>
    <div class="fields left">
    
    <?php $sql = "SELECT * FROM institutions";
    $result = mysqli_query($inst, $sql);
?>

      <form  action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="600px" align="center" cellpadding="5" cellspacing="5">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Institution:</td>
      <td class="answer"><select name="inst_key">
        <?php 

    while($row = mysqli_fetch_assoc($result)) {
        ?><option value="<?php echo $row['inst_key']; ?>" ><?php echo $row['inst_name']; ?></option><?php
        //echo $row["password"];
    }

/*do {  
?>
        <option value="<?php echo $row_inst_names['inst_key']; ?>" ><?php echo $row_inst_names['inst_name']; ?></option>
        <?php
} while ($row_inst_names = mysqli_fetch_assoc($inst_names));*/
?> 
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User name:</td>
      <td class="answer"><span id="sprytextfield1">
        <input type="text" name="login" value="" size="32" />
      <span class="textfieldRequiredMsg">Feild is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td class="answer"><span id="sprytextfield2">
        <input type="password" name="password" value="" size="32" />
      <span class="textfieldRequiredMsg">Feild is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">First name:</td>
      <td class="answer"><span id="sprytextfield3">
        <input type="text" name="first_name" value="" size="32" />
      <span class="textfieldRequiredMsg">Feild is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Second name:</td>
      <td class="answer"><input type="text" name="second_name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Picture</td>
      <td class="answer"><label for="pic"></label>
      <input type="file" name="pic" id="pic" class="sbmt" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="question left">&nbsp;</td>
      <td class="answer"><input type="submit" class="sbmt" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
  </div>
  </form>
  </div>

</div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>
</html> 
