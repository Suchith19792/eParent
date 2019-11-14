<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

$hostname_inst = "localhost";
$database_inst = "eparent";
$username_inst = "root";
$password_inst = "";



$inst = @mysql_pconnect($hostname_inst, $username_inst, $password_inst) or trigger_error(mysql_error(),E_USER_ERROR); 
?>