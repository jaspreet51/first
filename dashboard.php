<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "database/config.php";
include "pages/head.php";
 if(!isset($_SESSION['name']))
 {
 	header("Location:login.php");
 }
?>
<div class="container">
	<h4 class="py-3 text-center">Welcome  <?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } ?></h4>
	<a href="logout.php" class="">Logout</a>
	<form  id="mytask">
		<div class="row py-3">
			<div class="col-md-6 ">
				<div class="mb-3">
					<input class="form-control" type="text" id="task" name="task" value="" placeholder="Enter your task">
        			</div>
        		</div>
        		<div class="col-md-6 ">
				<div class="mb-3">
					<input class="btn btn-primary" type="submit" name="addTask" value="Add">
        			</div>
        		</div>
			<div class="col-md-2 md-3">
        <div class="mb-3 alert alert-danger" style="display:none;" id="show-error"> </div>
    </div>

    </div>
  </form>
		<div class="row py-3">
			<div id="showdata" class="col-md-6"></div>
		</div>


</div>
<?php
include "pages/footer.php";
?>