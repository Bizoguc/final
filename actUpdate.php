<?php
	include("connect.php");
	$RegisDate = new DateTime();
	date_default_timezone_set('Asia/Bangkok');
	
	$sql="UPDATE Activity SET Activity_Name = '".$_POST["Name"]."',Activity_Detail ='".$_POST["Detail"]."'
	,Activity_Date ='".$_POST["Date"]."',Activity_StartTime ='".$_POST["startActivity"]."' 
	,Activity_Hour='".$_POST["Hour"]."',Activity_Quantity ='".$_POST["Quan"]."',Type_ID='".$_POST["typeActivity"]."'
	,RegisDate='".$RegisDate->format('Y-m-d H:i:s')."'
	WHERE Activity_ID ='".$_GET['u']."'";

	

	$conn->query("SET NAMES 'utf8'");
	$result = $conn->query($sql) or printf ("Error in query: . ",$conn->error);

 

	if($sql){
		echo "แก้ไขข้อมูลเรียบร้อย<br>";
		echo "<a href=ActList.php> กลับ </a>";
	}else{
		echo "Error!";
	}
	
?>