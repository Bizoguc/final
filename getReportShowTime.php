<?php
	include("connect.php");

	$id = $_POST['activityId'];

	$sql = $conn->query("SELECT * FROM registerActivity INNER JOIN Student ON registerActivity.Student_ID=Student.Student_ID INNER JOIN Seat ON registerActivity.Seat_ID=Seat.Seat_ID INNER JOIN Showtime ON registerActivity.Showtime_ID=Showtime.Showtime_ID INNER JOIN Room ON Showtime.Room_ID=Room.Room_ID INNER JOIN Activity ON Showtime.Activity_ID=Activity.Activity_ID WHERE  registerActivity.Showtime_ID = '".$id."' ");
	
	$results = array();
	
	while($row = $sql->fetch_assoc()){

	$results[] = ($row);
	}

	header('Content-type: application/json');
 
	echo json_encode($results);	
?>