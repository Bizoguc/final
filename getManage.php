<?php
session_start(); ob_start();	


if($_SESSION['status']=='User'){
     header("Location: index.php");
     exit;
}else if($_SESSION['status']== null){
	 header("Location: login.php");
     exit;
}
 
?>



<?php

include("connect.php");

// $_POST['dataDate'] = '2015-12-1';

$date = $_POST['dataDate'];
$sql = mysql_query("SELECT * FROM `Showtime` INNER JOIN Activity on Showtime.Activity_ID = Activity.Activity_ID
	   INNER JOIN Room ON Showtime.Room_ID = Room.Room_ID  WHERE DateShowtime ='".$date."' ");

// $sql = mysql_query("SELECT * FROM Showtime WHERE DateShowtime ='".$date."' ");
// $row = mysql_fetch_assoc($sql);
 

 $results = array();
while($row = mysql_fetch_assoc($sql)){

$results[] = ($row);
}

header('Content-type: application/json');
 
echo json_encode($results);
 


?>