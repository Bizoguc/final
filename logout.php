<?php session_start(); ob_start();
	include 'connect.php';
	$sql ="UPDATE Student SET LogIn='0' WHERE Student_Username='".$_SESSION['user']."'";
	//$sql = "UPDATE FROM Login WHERE Student_Username = '".$_SESSION['user']."'";
	$query = $conn->query($sql);
	
	unset($_SESSION['user']);
	session_destroy();
	header("Location: login.php");

?>
