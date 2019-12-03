<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

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


/*
$hostname_inst = "sql213.epizy.com";
$database_inst = "epiz_24798502_eparent";
$username_inst = "epiz_24798502";
$password_inst = "49902969";



$inst = mysqli_connect($hostname_inst, $username_inst, $password_inst, $database_inst); 

// Check connection
if ($inst->connect_error) {
    die("Connection failed: " . $inst->connect_error);
}
echo "Connected successfully";
*/
?>