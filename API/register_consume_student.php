<?php
error_reporting(0);


$login=$_GET['login'];
$password=$_GET['password'];
$first_name=$_GET['first_name'];
$second_name=$_GET['second_name'];



$url = "http://localhost/API/register_student_API.php?login=".$login.
"&password=".$password."&first_name=".$first_name."&second_name=".$second_name;

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