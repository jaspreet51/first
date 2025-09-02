<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "database/config.php";

if($_POST['action'] == "done")
{
$id=$_POST['id'];
$sql = "UPDATE task SET task_status= '1' WHERE id = $id ";
$res=mysqli_query($con,$sql);
if($res)
{
	echo '1';
}
else
{
	echo "0";
}
}

if($_POST['action'] == "cancel")
{
	$id=$_POST['id'];
	$sql="DELETE FROM task WHERE id = $id";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
}
?>