<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "database/config.php";
$i=1;
$sql="SELECT * FROM task";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)>0)
{
	$table ="<table class='table'>
	<tr>
	<th>Sr. No.</th>
	<th>Task</th>
	<th>Status</th>
	<th>Action</th>
	</tr>";
	while($row=mysqli_fetch_assoc($res)){
		if($row['task_status'] == '1')
		{
			$status="Done";
		}
		else
		{
			$status ="Pending";
		}
		$table.="<tr><td>".$i++."</td>
		<td>".$row['task']."</td>
		<td><span>$status</span></td>
		<td> <i style='color:green' class='fa-solid fa-check done' data-id='".$row['id']."'></i>   <i style='color:red' class='fa-solid fa-xmark cancel' data-id='".$row['id']."' ></i></td></tr>";
	}
	$table.="</table>";
	$res= $table;
}
else
{
	$res="Data Not found";
}
echo $res;
?>