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
	$RegisDate = new DateTime();
	date_default_timezone_set('Asia/Bangkok');
	
	$sql="UPDATE Activity SET Activity_Name = '".$_POST["Name"]."',Activity_Detail ='".$_POST["Detail"]."'
	,Activity_Date ='".$_POST["Date"]."',Activity_StartTime ='".$_POST["Time"]."' 
	,Activity_Hour='".$_POST["Hour"]."',Activity_Quantity ='".$_POST["Quan"]."',Type_ID='".$_POST["typeActivity"]."'
	,RegisDate='".$RegisDate->format('Y-m-d H:i:s')."'
	WHERE Activity_ID ='".$_GET['u']."'";

	// $sql= "UPDATE Activity SET ";
	// $sql .="Activity_Name = '".$_POST["Name"]."'";
	// $sql .=",Activity_Detail = '".$_POST["Detail"]."'";
	// $sql .=",Activity_Date = '".$_POST["Date"]."'";
	// $sql .=",Time_ID = '".$_POST["startActivity"]."'";
	// $sql .=",Activity_Hour = '".$_POST["Hour"]."'";
	// $sql .=",Activity_Quantity = '".$_POST["Quan"]."'";
	// $sql .=",Type_ID = '".$_POST["typeActivity"]."'";
	// $sql .="WHERE Activity_ID ='".$_GET['u']."'";
	// $query = mysql_query($result);

	mysql_query("SET NAMES 'utf8'");
	$query = mysql_query($sql) or die ("Error in query: . ".mysql_error());

 

	if($sql){
		echo "แก้ไขข้อมูลเรียบร้อย<br>";
		echo "<a href=ActList.php> กลับ </a>";
	}else{
		echo "Error!";
	}
	
?>