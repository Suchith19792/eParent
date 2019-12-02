<?php require_once('Connections/inst.php'); ?>
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
	public $log;
	public $pp;
	public $iName;
	
	function setPost($v1, $v2, $v3)
	{
		$this->log = $v1;
		$this->pp = $v2;
		$this->iName = $v3;
	}
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) 
{
	move_uploaded_file($_FILES['pic']['tmp_name'], "inst_pics/".$_POST['login'].".jpg");
	
	
	
	
	$cObj = new postInfo();
	$cObj->setPost($_POST['login'], $_POST['password'], $_POST['inst_name']);
	
	$log = $cObj->log;
	$pp = $cObj->pp;
	$iName = $cObj->iName;
echo $log." -- ";
echo $pp." -- ";
echo $iName;
  $insertSQL = "INSERT INTO institutions (login, password, inst_name) VALUES ('$log', '$pp', '$iName')";


	  echo "<script>alert('New Institute Inserted Successfully');</script>";

if ($inst->query($insertSQL) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $insertSQL . "<br>" . $inst->error;
}

  //mysql_select_db($database_inst, $inst);
  //$Result1 = mysql_query($insertSQL, $inst) or die(mysql_error());
}
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
    <h1>institution Register</h1>
    <hr>
    <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table align="center" cellpadding="5" cellspacing="5" width="500px">
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="question">User name:</td>
      <td class="answer"><span id="sprytextfield1">
        <input type="text" name="login" value="" size="32" />
      <span class="textfieldRequiredMsg">Feild is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="question">Password:</td>
      <td class="answer"><span id="sprytextfield2">
        <input type="password" name="password" value="" size="32" />
      <span class="textfieldRequiredMsg">Feild is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="question">Institution name:</td>
      <td class="answer"><span id="sprytextfield3">
        <input type="text" name="inst_name" value="" size="32" />
      <span class="textfieldRequiredMsg">Feild is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="question">Picture</td>
      <td class="answer"><label for="pic"></label>
      <input class="sbmt" type="file" name="pic" id="pic" /></td>
    </tr>
    
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="question">&nbsp;</td>
      <td class="answer"><input class="sbmt" type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
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
