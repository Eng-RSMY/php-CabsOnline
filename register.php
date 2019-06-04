<?php
	require 'dbConnection.php';
	
	if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['phone'])){
		
		$emailAddress = $_POST['email'];
		
		$password = $_POST['password'];
		$confrim = $_POST['confrimPassword'];
		
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		
		if($password === $confrim) {
			$query = "INSERT INTO customer (emailAddress, customerName, phoneNumber, password) VALUES ('$emailAddress', '$name', '$phone','$password')";
			
			if ($conn->query($query) === TRUE) {
				echo '<script> alert("User has been successfully register"); window.location.href ="login.php"; </script>';
				
			} else {
				echo '<script> alert("Error: Unable to register user"); </script>';
			}
		} else {
			echo '<script> alert("Password and confrim password does not matched"); </script>';
		}
	}
	
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Zohaib Ali - COS80021 - Assignment 1</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <style>
		/* Remove the navbar's default margin-bottom and rounded borders */ 
		.navbar {
		  margin-bottom: 0;
		  border-radius: 0;
		}
		
		/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		.row.content {height: 450px}
		
		/* Set gray background color and 100% height */
		.sidenav {
		  padding-top: 20px;
		  background-color: #f1f1f1;
		  height: 100%;
		}
		
		/* Set black background color, white text and some padding */
		footer {
		  background-color: #555;
		  color: white;
		  padding: 15px;
		}
		
		/* On small screens, set height to 'auto' for sidenav and grid */
		@media screen and (max-width: 767px) {
		  .sidenav {
			height: auto;
			padding: 15px;
		  }
		  .row.content {height:auto;} 
		}
	  </style>
	</head>
	<body style="background-color:#555555;">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		  </button>
		  <a class="navbar-brand" href="#">CabsOnline</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
		  </ul>
		</div>
	  </div>
	</nav>
	<div class="container text-center" style="background-color:#ffffff;">    
	  <div class="row content">
		<div class="col-sm-12 text-left"> 
			<form style="padding-top: 20px; padding-bottom: 20px;" action="register.php" method="POST">
			  <div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" name="name" id="name" required=required>
			  </div>
			  <div class="form-group">
				<label for="phone">Phone:</label>
				<input type="text" class="form-control" name="phone" id="phone" required=required>
			  </div>
			  <div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" name="email" id="email" required=required>
			  </div>
			  <div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" name="password" id="pwd" required=required>
			  </div>
			  <div class="form-group">
				<label for="confrimpwd">Confrim Password:</label>
				<input type="password" class="form-control" name="confrimPassword" id="confrimpwd" required=required>
			  </div>
			  <button type="submit" class="btn btn-default">Register</button>
			</form> 
			<h4 class="text-center"> Already Register ? <a href="login.php"> Login here </a> </h4> 
		</div>
	  </div>
	</div>
	<footer class="container text-center">
	  <p>Zohaib Ali - COS80021 - Assignment 1</p>
	</footer>
</body>
</html>
