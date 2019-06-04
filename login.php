<?php 
	require 'dbConnection.php';
	
	if(isset($_POST['email']) && isset($_POST['password'])){
		$emailAddress = $_POST['email'];
		$password = $_POST['password'];
		
		$query = "SELECT * FROM customer WHERE emailAddress='$emailAddress' and password='$password'";
		
		$results = mysqli_query($conn, $query);
		
		
		if(mysqli_num_rows($results) == 1) {
			session_start();
			$row = mysqli_fetch_assoc($results);
			$_SESSION['login'] = true;
			$_SESSION['email'] = $row['emailAddress'];
			$_SESSION['name'] = $row['customerName'];
			$_SESSION['phone'] = $row['phoneNumber'];
			$_SESSION['isAdmin'] = $row['isAdmin'] == 1 ? true : false;
			
			if($_SESSION['isAdmin']) {
				header('location:admin.php');
			} else {
				header('location:booking.php');
			}
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
  </div>
</nav> 
<div class="container text-center" style="background-color:#ffffff;">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
       <form style="padding-top: 20px; padding-bottom: 20px;" action="login.php" method="POST">
		  <div class="form-group">
			<label for="email">Email address:</label>
			<input type="email" class="form-control" name="email" id="email" required=required>
		  </div>
		  <div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" name="password" id="pwd" required=required>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form> 
		<h4 class="text-center"> Not a user yet, no worry <a href="register.php"> Register Here! </a> </h4>
    </div>
  </div>
</div>
<footer class="container text-center">
  <p>Zohaib Ali - COS80021 - Assignment 1</p>
</footer>
</body>
</html>
