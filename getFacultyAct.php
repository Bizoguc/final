<?php
	include('connect.php');
	$faculty = $_POST['faculty'];
	
	$sql = mysql_query("SELECT * FROM `Faculty` INNER JOIN Activity ON Faculty.Faculty_ID = Activity.Faculty_ID INNER JOIN Type ON Activity.Type_ID = Type.Type_ID WHERE Faculty.Faculty_ID = '".$faculty."'");
	
	$results = array();
	
	while($row = mysql_fetch_assoc($sql)){

	$results[] = ($row);
	}

	header('Content-type: application/json');
 
	echo json_encode($results);	


?>