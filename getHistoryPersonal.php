<?php

session_start(); ob_start();
 
 $user= $_SESSION["user"];

?>

<?php
	require('connect.php');

	if(isset($_POST['value'])){
	 $value = $_POST['value'];
	}
	
	$result = $conn->query("SELECT * FROM `registerActivity` INNER JOIN Student ON registerActivity.Student_ID=Student.Student_ID INNER JOIN Showtime ON registerActivity.Showtime_ID=Showtime.Showtime_ID INNER JOIN Activity ON Showtime.Activity_ID=Activity.Activity_ID where Student.Student_Username='".$user."' AND DateShowtime<curdate()limit $value ,10");
 
	while($result_data = $result->fetch_assoc()){

			
  		
		echo '<li class="list-group-item">'.$result_data['Activity_Name'].' เมื่อวันที่ '.date('d/my',strtotime($result_data['DateShowtime'])).'</li>';
 
	}




?>