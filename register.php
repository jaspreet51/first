<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "database/config.php";
include 'pages/head.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];

 	$err=[];
	if(empty($name))
	{
		$err[] = "Name is mandatory";
	}
	else if(!preg_match("/^[A-Za-z\s]+$/" , $name))
	{
		$err[]="Name contaions only alphabets";
	}
	else
	{
		$name = trim(strip_tags($name));
	}

	//validate email
	if(empty($email))
	{
		$err[]="Email is required";
	}
	else if(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/",$email))
	{
		$err[]="Enter the valid Email";
	}
	else
	{
		$email = trim(strip_tags($email));
	}

	// validate Password

	if(empty($password))
	{
		$err[]= "Password is required";
	}
	else if (!preg_match("/^[A-Za-z0-9]+$/",$password))
	{
		$err[]="Enter the valid Password";
	}
	else if(strlen($password) < 8 || strlen($password) > 12)
	{
		$err[] = "Password contains minimum  8 and maximum 12 characters";
	}
	else
	{
		$password = trim(strip_tags($password));
	}

	//validate phone number 
	if(empty($phone))
	{
		$err[]="Phone number is mandatory";
	}
	else if(!preg_match("/^\d{10}$/",$phone))
	{
		$err[]="Number contains 10 digits only";
	}
	else 
	{
		$phone= trim(strip_tags($phone));
	}


//validate country

	if(empty($country))
	{
		$err[]="Select your country";
	}
	else
	{
		$country = trim(strip_tags($country));
	}
	if(!empty($err))
	{
 	$errors=[];
		foreach($err as $e)
		{
			$errors[]=$e;
		}
	}
	else
	{
		$newpassword= password_hash($password,PASSWORD_DEFAULT);
		// echo $newpassword;
		$sql = "INSERT INTO  userlist (name,email,pass,phone,country) VALUES ('$name','$email','$newpassword','$phone','$country')";
		$res= mysqli_query($con,$sql);
		if($res)
		{
			header("Location: login.php");
		}
		else
		{
			// echo "not";
			$err[] = "Database error : ".mysqli_error($con);
		}
	}
}
?>

<div class="container">
	<h4 class="py-3 text-center">Form</h4>
	<form method="post" id="myform">
		<div class="row py-3">
			<div class="col-md-6 offset-md-3">
				<div class="mb-3">
					<label for="name">Name</label>
					<input class="form-control" type="text" id="name" name="name" value="<?php if(isset($name)) { echo $name ; } ?>">
				</div>
				<div class="mb-3">
					<label for="email">Email</label>
					<input class="form-control" type="email" id="email" name="email" value="<?php if(isset($email)) { echo $email; } ?>">
				</div>
				<div class="mb-3">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" value="<?php if(isset($password)) { echo $password; } ?>">
				</div>
				<div class="mb-3">
					<label for="phone">Phone</label>
					<input class="form-control" type="text" id="phone" name="phone" value="<?php if(isset($phone)) { echo $phone; } ?>">
				</div>
				<div class="mb-3">
					<label for="country">Countries</label>
				      <select class="form-control" id="country" name="country">
            <option value="">-- Select Country --</option>
            <option value="India" <?php if(isset($country)) { if($country == "India") { echo 'selected'; } }  ?> >India</option>
            <option value="Pakistan" <?php if(isset($country)) { if($country == "Pakistan") { echo 'selected'; } }  ?>>Pakistan</option>
            <option value="Bangladesh" <?php if(isset($country)) { if($country == "Bangladesh") { echo 'selected'; } }  ?>>Bangladesh</option>
            <option value="Nepal" <?php if(isset($country)) { if($country == "Nepal") { echo 'selected'; } }  ?>>Nepal</option>
          </select>
        </div>
        <div  class="mb-3">
        	<input class="btn btn-primary" type="submit" name="sub" value="Register">
        </div>
        <div class="mb-3 alert alert-danger" hidden id="show-error"> </div>
        <?php
        	if(!empty($errors))
        	{
        		echo "<div class='mb-3 alert alert-danger' ><ul>";
        		foreach($errors as $e)
        		{
        			echo "<li>$e</li>";
        		}
        		echo "</ul></div>";
        	}
        	?>
      </div>
    </div>
  </form>
</div>

<?php

include "pages/footer.php";
?>