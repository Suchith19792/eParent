<?php
error_reporting(0);


$login=$_GET['login'];
$password=$_GET['password'];
$inst_name=$_GET['inst_name'];




$url = "http://localhost/API/register_inst_API.php?login=".$login.
"&password=".$password."&inst_name=".$inst_name;

 $client = curl_init($url);
 curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
 $response = curl_exec($client);

 $result = json_decode($response);

if( $result->Result==true)
{


header("Location: ../index.php");


}
else
{
session_start();
$_SESSION["invalid"]="Registration Failed";
header("Location: ../Register.php");
}


    ?>