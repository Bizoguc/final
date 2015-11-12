<?php
$conn = mysql_connect("localhost","root","");
mysql_select_db("SAU");

mysql_query("SET character_set_results=utf8", $conn);
if(!$conn) 

	die('Could not connect:'.mysql_error());

?>