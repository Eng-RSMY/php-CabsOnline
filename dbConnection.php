<?php 
$conn = @mysqli_connect('ictstu-db1.cc.swin.edu.au','s101148176','290191') or die('Failed to connect to server');
	@mysqli_select_db($conn, 's101148176_db') or die('Database not available');
?>