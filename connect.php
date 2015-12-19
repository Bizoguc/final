<?php
$conn = new mysqli("localhost","root","","SAU");



if($conn->connect_errno){

	printf("Could not connect: %s\n", $conn->connect_error);
}

$conn->query("SET character_set_results=utf8");
?>