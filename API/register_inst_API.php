<?php
header("Content-Type:application/json");
error_reporting(0);

 include('../conn.php');

$login=$_GET['login'];
$password=$_GET['password'];
$first_name=$_GET['first_name'];
$second_name=$_GET['second_name'];

$qu="insert into students values('', '$login', '$password', '$first_name')";
 $result = mysql_query($qu);


 response($result);

 mysql_close($conn);



function response($result)
{

 $response['Result']=$result;



 $json_response = json_encode($response);
echo $json_response;
}
?>
