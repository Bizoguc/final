<?php
	include("connect.php");

	$id = $_POST['activityId'];

	$sql = mysql_query("SELECT * FROM Showtime WHERE DateShowtime>=(curdate()) AND Activity_ID = '".$id."' ");
	
	$results = array();
	
	while($row = mysql_fetch_assoc($sql)){

	$results[] = ($row);
	}

	header('Content-type: application/json');
 
	echo json_encode($results);	
?>