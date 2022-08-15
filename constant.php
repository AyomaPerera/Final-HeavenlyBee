<?php 

//Start Session
session_start();

//create Constant to Stor Non repeating values
define('SITEURL','http://localhost/heveanlybee/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWord', '');
define('DB_Name', 'heavenlybee');


$conn = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWord) or die(mysqli_error());//Database connection.
$db_select = mysqli_select_db($conn, DB_Name) or die(mysqli_error());//selecting Database

if($conn)
{
    echo "success";
}
else
{
    die(mysql_error($conn));
}


?>