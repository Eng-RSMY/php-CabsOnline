<?php 

	session_start();
	
	if(!$_SESSION['login']){
		header('location:login.php');
	}
	
	require 'dbConnection.php';
	
	if( isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['destination']) && isset($_POST['pickupDate']) && isset($_POST['pickupTime']) && isset($_POST['streetNumber']) && isset($_POST['streetName']) && isset($_POST['suburb']) ) {
		
		$customerEmail = $_SESSION['email'];
		$passengerName = $_POST['name'];
		$phone = $_POST['phone'];
		$destination = $_POST['destination'];
		$pickupDate = $_POST['pickupDate'];
		$pickupTime = $_POST['pickupTime'];
		$pickupTimeArray = explode(".",$pickupTime);
		$stringTime = $pickupTimeArray[0].":".$pickupTimeArray[1].":00";
		$unitNumber = $_POST['unitNumber'];
		$streetNumber = $_POST['streetNumber'];
		$streetName = $_POST['streetName'];
		$suburb = $_POST['suburb'];
		
		if($pickupTime >  date("H.i")+1) {
			$query = "INSERT INTO booking (customerEmail, name, phone, destination, pickupDate, pickupTime, unitNumber, streetNumber, streetName, suburb) VALUES ('$customerEmail', '$passengerName', '$phone','$destination', '$pickupDate', '$stringTime', '$unitNumber', '$streetNumber', '$streetName', '$suburb')";
			
			if ($conn->query($query) === TRUE) {
				$lastId = mysqli_insert_id($conn);
				
				$subject = 'Your booking request with CabsOnline!';
				$message = 'Dear '.$_SESSION['name'].', Thanks for booking with CabsOnline! Your booking reference number is '.$lastId.'. We will pick up the passengers in front of your provided address at '.$stringTime.' on '.$pickupDate.'.';
				$header = 'From booking@cabsonline.com.au';

				mail($customerEmail, $subject, $message, $header, "-r 101148176@student.swin.edu.au");
				
				echo '<script> alert("Your booking reference number is '.$lastId.' We will pick up the passengers in front of your provided address at '.$stringTime.' on '.$pickupDate.'."); </script>';
				
			} else {
				echo '<script> alert("Error: Unable to make a booking"); </script>';
			}
		} else {
			echo '<script> alert("Error: Booking should be 1 hour from current time."); </script>';
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="bootstrap-datetimepicker.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
		<script src="bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.datepicker').datepicker();
			});	
		</script>
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
			  <a class="navbar-brand" href="index.php">CabsOnline</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="#">Booking Home</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			  </ul>
			</div>
		  </div>
		</nav>
		<div class="container text-center" style="background-color:#ffffff;">    
		  <div class="row content">
			<div class="col-sm-12 text-left">
			<h3> Booking a cab </h3>
			<h5> Please fill all the mandatory (*) fields below to book a taxi </h5>
			<form style="padding-top: 20px; padding-bottom: 20px;" action="booking.php" method="POST">
			  <div class="form-group">
				<label for="name">Passenger Name:*</label>
				<input type="text" class="form-control" name="name" id="name" required=required>
			  </div>
			  <div class="form-group">
				<label for="phone">Phone:*</label>
				<input type="text" class="form-control" name="phone" id="phone" required=required>
			  </div>
			  <div class="form-group">
				<label for="email">Pick up address:*</label>
				<div class="col-sm-8 col-sm-offset-4">
					<div class="form-group">
						<label for="unitNumber">Unit Number:</label>
						<input type="text" class="form-control" name="unitNumber" id="unitNumber">
				    </div>
					<div class="form-group">
						<label for="streetNumber">Street Number:*</label>
						<input type="text" class="form-control" name="streetNumber" id="streetNumber" required=required>
				    </div>
					<div class="form-group">
						<label for="streetName">Street Name:*</label>
						<input type="text" class="form-control" name="streetName" id="streetName" required=required>
				    </div>
					<div class="form-group">
						<label for="suburb">Suburb:*</label>
						<input type="text" class="form-control" name="suburb" id="suburb" required=required>
				    </div>
				</div>
			  </div>
			  <div class="form-group">
				<label for="destination">Destination Suburb:*</label>
				<input type="text" class="form-control" name="destination" id="destination" required=required>
			  </div>
			  <div class="form-group">
				<label for="pickupDate">Pickup Date:*</label>
				<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-start-date="d">
					<input type="text" class="form-control" name="pickupDate" id="pickupDate" placeholder="YYYY-MM-DD" required=required>
					<div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span> </div>
				</div>
			  </div>
			  <div class="form-group">
				<label for="pickupTime">Pickup time:*</label>
				<div class="input-group date">
					<input type="type" class="form-control" name="pickupTime" id="pickupTime" min=0 max=23 step="0.01" placeholder="Time in 24 hours format (ex: 19.30)" required=required>
					<div class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </div>
				</div>
			  </div>
			  <button type="submit" class="btn btn-default">Book</button>
			</form> 
			</div>
		  </div>
		</div>
		<footer class="container-fluid text-center">
		  <p>Zohaib Ali - COS80021 - Assignment 1</p>
		</footer>
	</body>
</html>
