<?php
// script to connect to the database

$servername="localhost";
$username="root";
$password="";
$database="idiscuss";

$conn=mysqli_connect($servername,$username,$password,$database);
if($conn)
{
	// echo "Connection done";
}
else
{
	//echo "Connection failed";  
	//or use to see error funtion of php	
	die ("Connection failed beacuase ".mysqli_connect_error() );
	
	
}
?>