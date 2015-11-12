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
	date_default_timezone_set('Asia/Bangkok');
	$RegisDate = new DateTime();

//(date_format($now, 'Y-m-d'));
//var_dump($now);
//exit();
//var_dump($now->format('Y-m-d'));

//exit();

	$date = ($_POST['Date']);

	//exit();

	if($_POST["Name"]==""){
		echo "กรุณากรอกชื่อกิจกรรม !!<br>";
		echo "<a href=ActListInsert.php> กลับสู่หน้าลงกิจกรรม</a>";
		exit();
	}

	if($_POST["Hour"]==""){
		echo "กรุณากรอกจำนวนชั่วโมงกิจกรรม !!<br>";
		echo "<a href=ActListInsert.php> กลับสู่หน้าลงกิจกรรม</a>";
		exit();
	}

	if($_POST["Quan"]==""){
		echo "กรุณากรอกจำนวนที่รับนผู้เข้าร่วมกิจกรรม !!<br>";
		echo "<a href=ActListInsert.php> กลับสู่หน้าลงกิจกรรม</a>";
		exit();
	}

	if($_POST["facultyActivity"]==""){
		echo "กรุณาเลือกคณะที่ต้องการจัดกิจกรรม !!<br>";
		echo "<a href=ActListInsert.php> กลับสู่หน้าลงกิจกรรม</a>";
		exit();
	}

	if($_POST["typeActivity"]==""){
		echo "กรุณากรอกประเภทกิจกรรม !!<br>";
		echo "<a href=ActListInsert.php> กลับสู่หน้าลงกิจกรรม</a>";
		exit();
	}

	

	mysql_query("SET NAMES 'utf8'");
	$result=mysql_query("INSERT INTO Activity(Activity_Name,Activity_Detail,Activity_Date,Activity_StartTime,Activity_Hour,Activity_Quantity,Faculty_ID,Type_ID,RegisDate)
	values('".$_POST["Name"]."','".$_POST["Detail"]."','".$date."','".$_POST["startActivity"]."','".$_POST["Hour"]."','".$_POST["Quan"]."','".$_POST["facultyActivity"]."',
		'".$_POST["typeActivity"]."','".$RegisDate->format('Y-m-d H:i:s')."')") or die(mysql_error());
	
	if($result){
		echo "ใส่ข้อมูลเรียบร้อย<br>";
		echo "<a href=ActList.php> กลับ </a>";
	}else{
		echo "Error!";
	}
	mysql_close($conn);
?>