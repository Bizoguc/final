<?php
	include('connect.php');
	$seat=$_POST['seatData'];

	$resultSeat=$conn->query("SELECT * FROM Seat WHERE Seat_ID='$seat'");  

	$row=$resultSeat->fetch_assoc();

	echo json_encode($row);
?>