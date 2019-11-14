<?php
header("Content-Type:application/json");

 include('../conn.php');
 $loginUsername=$_GET['inst_name'];
 $password=$_GET['pwd'];

 $result = mysql_query("SELECT login, password FROM institutions WHERE login='$loginUsername' AND password= '$password';");

 while($row = mysql_fetch_array($result))
 {

  $loginUsername = $row['inst_name'];
  $password = $row['pwd'];

 response($loginUsername, $password);

 }

 mysql_close($conn);

function response($loginUsername, $password)
{

 $response['inst_name']=$loginUsername;
  $response['Password']=$password;
       

 $json_response = json_encode($response);
echo $json_response;
}
?>