<?php 
	session_start();
	
	if(!$_SESSION['login']){
		header('location:login.php');
	}
	
	require 'dbConnection.php';

	$showTable = '';
	
	if(isset($_POST['showList'])) {
		$today = date("Y-m-d");
		$currentTime = date("H:i:S");
		$time = date("H")+2;
		$time .= ':'.date("i");
		$time .= ":00";
		
		$query = "SELECT * FROM booking WHERE pickupDate='$today' and pickupTime>='$currentTime' and pickupTime<'$time' and assignStatus=0";
		$results = mysqli_query($conn, $query);
	
		if(mysqli_num_rows($results) > 0) {
			
			$showTable = '<table class="table table-striped"> <thead> <tr> <th>Reference #</th> <th>Customer Name</th>  <th>Passenger Name</th> <th>Passenger contact phone</th> <th>Pick-up Address</th> <th>Destination suburb</th> <th>Pick-up Time</th> </tr> </thead> <tbody>';
			
			$row = mysqli_fetch_assoc($results);
			while($row) {
				
				$email = $row['customerEmail']; 
				$subQuery = "SELECT * FROM customer WHERE emailAddress = '$email'";
				$res = mysqli_query($conn, $subQuery);
				$subRow = mysqli_fetch_assoc($res);
				
				$showTable .= '<tr>';
				$showTable .= '<td>'.$row['bookingNumber'].'</td>';
				$showTable .= '<td>'.$subRow['customerName'].'</td>';
				$showTable .= '<td>'.$row['name'].'</td>';
				$showTable .= '<td>'.$row['phone'].'</td>';
				
				if(!$row['unitNumber']) {
					$showTable .= '<td>'.$row['streetNumber'].', '.$row['streetName'].', '.$row['suburb'].'.</td>';
				} else {
					$showTable .= '<td>'.$row['unitNumber'].'/'.$row['streetNumber'].', '.$row['streetName'].', '.$row['suburb'].'.</td>';
				}
				
				$showTable .= '<td>'.$row['destination'].'</td>';
				$showTable .= '<td>'.$row['pickupDate'].' '.$row['pickupTime'].'</td>';
				$showTable .= '</tr>';
				$row = mysqli_fetch_assoc($results);
			}
			
			$showTable .= '</tbody> </table>';
			
		} else {
			$showTable = '<hr>';
			$showTable .= '<h5 class="text-center">No Record Found</h5>';
			$showTable .= '<hr>';
			
		}
	}
	
	if(isset($_POST['referneceNumber'])) {
		$bookingNumber = $_POST['referneceNumber'];
		$query = "UPDATE booking SET assignStatus = 'assign' WHERE bookingNumber = '$bookingNumber'";
			
		if ($conn->query($query) === TRUE) {
			echo '<script> alert("Booking has been assign successfully."); </script>';
		} else {
			echo '<script> alert("Error: Unable to assign driver."); </script>';
		}
	}
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
			  <ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Admin Home</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			  </ul>
			</div>
		  </div>
		</nav>
		<div class="container text-center" style="background-color:#ffffff;">    
		  <div class="row content">
			<div class="col-sm-12 text-left" style="padding-top:20px; padding-bottom: 20px;">
				<h3> Admin page of CabsOnline </h3>
				<h5> 1. Click below button to serach for all unassigned booking requests with a pick-up time within 2 hours. </h5>
				<form  action="admin.php" method="POST"> 
					<input type="hidden" value="show" name="showList" />
					<button type="submit" class="btn btn-primary">List All</button>
				</form>
				<div style="padding-bottom:20px; padding-top:20px;" class="col-sm-12">
					<?php echo $showTable ?>
				</div>
				<h5> 2. Input a reference number below and click "update" button to assign a taxi to that request. </h5>
				<form  action="admin.php" method="POST"> 
				  <div class="form-group">
					<label for="referneceNumber">Reference Number:</label>
					<input type="text" class="form-control" name="referneceNumber" id="referneceNumber" required=required>
				  </div>
				  <button type="submit" class="btn btn-primary">update</button>
				</form>
				
			</div>
		  </div>
		</div>
		<footer class="container-fluid text-center">
		  <p>Zohaib Ali - COS80021 - Assignment 1</p>
		</footer>
	</body>
</html>
