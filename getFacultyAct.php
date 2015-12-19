<?php
	include('connect.php');
	$faculty = $_POST['faculty'];
	
	$resultFaculty = $conn->query("SELECT * FROM `Faculty` INNER JOIN Activity ON Faculty.Faculty_ID = Activity.Faculty_ID INNER JOIN Type ON Activity.Type_ID = Type.Type_ID WHERE Faculty.Faculty_ID = '".$faculty."'");
	
	$results = array();
	
	while($row = $resultFaculty->fetch_assoc()){

	$results[] = ($row);
	}

	header('Content-type: application/json');
 
	echo json_encode($results);	



?>