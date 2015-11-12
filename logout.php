<?php session_start(); ob_start();
	include 'connect.php';
	$sql = "DELETE FROM Login WHERE Student_Username = '".$_SESSION['user']."'";
	$query = mysql_query($sql);
	
	unset($_SESSION['user']);
	session_destroy();
	header("Location: index.php");

?>