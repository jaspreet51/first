<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "database/config.php";
$user_id=$_SESSION['id'];
$task = $_POST['task'];
$sql ="INSERT INTO task (user_id,task) VALUES($user_id ,'$task' )";
$res=mysqli_query($con,$sql);
if($res)
{
	$res="done";
}
else
{
	$res="not";
}
echo $res;
?>