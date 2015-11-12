<?php
	include("connect.php");
	
	$id = $_POST['dataShowTime'];

	$sql = mysql_query("DELETE FROM Showtime where Showtime_ID ='".$id."'");
?>