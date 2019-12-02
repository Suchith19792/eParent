<?php

$hostname_inst = "sql213.epizy.com";
$database_inst = "epiz_24798502_eparent";
$username_inst = "epiz_24798502";
$password_inst = "HcNFlfqDwTGZ3u";

$inst = mysqli_connect($hostname_inst, $username_inst, $password_inst, $database_inst); 
// Check connection

// Check connection
if (!$inst) {
    echo $hostname_inst." -- ";
    echo $database_inst." -- ";
    echo $username_inst." -- ";
    echo $password_inst." -- ";
    echo"Connection failed: " . mysqli_connect_error();
}
else


 $v1 = $_GET['v1'];
 $v2 = $_GET['v2'];


$qu = "SELECT * FROM students WHERE login = '$v1' AND password = '$v2'";
$row = mysqli_query($inst, $qu);

$r = mysqli_fetch_assoc($row);
$count = mysqli_num_rows($row);
    echo $r['stud_key'];
echo $count;



?>