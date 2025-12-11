<?php
// Parking Management System
// File: connection.php
// Purpose: Establishes a connection to the database
// Author: Iqrar
// Date: (today’s date)
// Notes: Central DB connection file used throughout the system

$server="localhost";
$username="root";
$password="";
$databasename="pms_db";

$conn = mysqli_connect($server, $username, $password);

$abc=mysqli_select_db($conn,$databasename);

if(!$abc)
{
	die("disconnect");
}
else
{
	//die ("successfull");
}
?>
