<?php
header("Content-Type:application/json");

 include('../conn.php');
 $loginUsername=$_GET['user_name'];
 $password=$_GET['pwd'];

 $result = mysql_query("SELECT login, password FROM students WHERE login='$loginUsername' AND password= '$password';");

 while($row = mysql_fetch_array($result))
 {

  $loginUsername = $row['user_name'];
  $password = $row['pwd'];

 response($loginUsername, $password);

 }

 mysql_close($conn);

function response($loginUsername, $password)
{

 $response['user_name']=$loginUsername;
  $response['Password']=$password;
       

 $json_response = json_encode($response);
echo $json_response;
}
?>