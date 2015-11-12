<?php
	include("connect.php");

	$sql="SELECT * FROM Showtime INNER JOIN Activity ON Showtime.Activity_ID = Activity.Activity_ID 
	
	WHERE Showtime_ID='".$_GET["u"]."'"; 
	$query=mysql_query($sql);

	while ($row=mysql_fetch_assoc($query)) {
		echo "<div>".$row['Activity_Name']."<div>";
	}
?>