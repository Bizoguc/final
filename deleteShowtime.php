<?php
	include("connect.php");
	
	$id = $_POST['dataShowTime'];

	$sql = $conn->query("DELETE FROM Showtime where Showtime_ID ='".$id."'");
?>