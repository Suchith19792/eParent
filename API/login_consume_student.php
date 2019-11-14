<?php
error_reporting(0);




$loginUsername = $_POST['user_name'];
$password = $_POST['pwd'];



$url = "http://localhost/API/login_inst_API.php?user_name=".$loginUsername."&pwd=".$password;

 $client = curl_init($url);
 curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
 $response = curl_exec($client);

 $result = json_decode($response);

if( $result->inst_name==$loginUsername && $result->pwd==$password)
{


session_start();
    $_SESSION['user_name']=$result->loginUsername;
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