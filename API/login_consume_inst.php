<?php
error_reporting(0);




$loginUsername = $_POST['inst_name'];
$password = $_POST['pwd'];



$url = "http://localhost/API/login_inst_API.php?inst_name=".$loginUsername."&pwd=".$password;

 $client = curl_init($url);
 curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
 $response = curl_exec($client);

 $result = json_decode($response);

if( $result->inst_name==$loginUsername && $result->pwd==$password)
{


session_start();
    $_SESSION['inst_name']=$result->loginUsername;
    $_SESSION['pwd']=$result->password;
       

header("Location: ../index.php");


}
else
{
session_start();
$_SESSION["invalid"]="Invalid Credentials";
header("Location: ../login.php");
}


    ?>