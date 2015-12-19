<?php
	include("connect.php");

	$id = $_POST['activityId'];

	$sql = $conn->query("SELECT * FROM Showtime INNER JOIN Room ON Showtime.Room_ID = Room.Room_ID WHERE DateShowtime>=(curdate()) AND Activity_ID = '".$id."' ORDER BY DateShowtime,StartTimeID");
	
	$results = array();
	
	while($row = $sql->fetch_assoc()){

	$results[] = ($row);
	}

	header('Content-type: application/json');
 
	echo json_encode($results);	
?>