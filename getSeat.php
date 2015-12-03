<?php
	include('connect.php');
	$seat=$_POST['seatData'];

	$sql=mysql_query("SELECT * FROM Seat WHERE Seat_ID='".$seat."'");  
	$row=mysql_fetch_assoc($sql);


	echo json_encode($row);
?>