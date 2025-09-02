<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try{
	$con= mysqli_connect("localhost","root","root@123","jass");
	if(!$con)
	{
		throw new Exception("Database not connect ".mysqli_connect_error());
	}
	// echo "connect";
}
catch(Exception $error)
{
	echo $error->getMessage();
}

?>