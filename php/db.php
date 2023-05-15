<?php 

$conn = new mysqli('localhost','root','','usersform');
if(!$conn.mysqli_connect_error())
{
    echo "Connection Denied";
}
?>