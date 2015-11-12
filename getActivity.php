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



$id = $_POST['activityId'];


$sql = mysql_query("SELECT * FROM Activity WHERE Activity_ID='".$id."' ");
$row = mysql_fetch_assoc($sql);

echo json_encode($row);



?>