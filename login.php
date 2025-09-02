<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(isset($_SESSION['name']))
{
	header("Location:dashboard.php");
}
include "database/config.php";
include "pages/head.php";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	 $err=[];
	//validate email
	 if(empty($email))
	 {
	 	$err[]="Email is required";
	 }
	 else if(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/",$email))
	 {
	 	$err[]="Enter valid Email";
	 }
	 else
	 {
	 	$email = trim(strip_tags($email));
	 }

	 //validate Password
	 if(empty($password))
	 {
	 	$err[] = "Password is required ";
	 }
	 else if (!preg_match("/^[A-Za-z0-9]+$/",$password))
	 {
	 	$err[]="Enter valid Password";
	 }
	 else if (strlen($password) < 8 | strlen($password) > 12)
	 {
	 	$err[] = " Password contains minimum 8 and maximum 12 characters";
	 }
	 else
	 {
	 	$password = trim(strip_tags($password));
	 }

	 if(empty($err))
	 {
	 	$sql = "SELECT * FROM  userlist WHERE email = '$email'";
	 	$res= mysqli_query($con,$sql);
	 	if(mysqli_num_rows($res)>0)
	 	{
	 		$row= mysqli_fetch_assoc($res);
	 		if(password_verify($password, $row['pass']))
	 			{
	 				$_SESSION['id']= $row['id'];
	 				$_SESSION['name']= $row['name'];
	 				header("Location:dashboard.php");
	 			}
	 			else
	 			{
	 				$err[]="Password does not match ";
	 			}
	 		}
	 	else 
	 	{
	 		$err[]= "User not found ";
	 	}
	 }
}
?>
<div class="container">
	<h4 class="py-3 text-center">Form</h4>
	<form method="post" id="mylogin">
		<div class="row py-3">
			<div class="col-md-6 offset-md-3">
				<!-- <div class="mb-3">
					<label for="name">Name</label>
					<input class="form-control" type="text" id="name" name="name" value="<?php if(isset($name)) { echo $name ; } ?>">
				</div> -->
				<div class="mb-3">
					<label for="email">Email</label>
					<input class="form-control" type="email" id="email" name="email" value="<?php if(isset($email)) {  echo $email; }  ?>">
				</div>
				<div class="mb-3">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" value="<?php if(isset($password)) { echo $password; } ?>">
				</div>
			
        <div  class="mb-3">
        	<input class="btn btn-primary" type="submit" name="login" value="Login">
        </div>
        <div class="mb-3 alert alert-danger" hidden id="show-error"> </div>

        <?php
        if(isset($err))
        {
        	if(count($err) > 0)
        	{
        	echo "<div class = 'mb-3 alert alert-danger'><ul>";
        	foreach($err as $e)
        	{
        		echo "<li>$e</li>";
        	}
        	echo "</ul></div>";
        }
        }
        ?>
       
      </div>
    </div>
  </form>
</div>

<?php
include "pages/footer.php";
?>