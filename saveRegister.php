<?php
	
	session_start(); 



	$studentId=$_SESSION['id'];
	$showtimeId=$_GET['showTime'];
	$seatId=$_GET['seat'];
	
	include('connect.php');
	date_default_timezone_set('Asia/Bangkok');

	//นับค่าชั่วโมง showtime 
	$hourShowtime = $conn->query("SELECT * FROM `Showtime` INNER JOIN Activity ON Showtime.Activity_ID = Activity.Activity_ID WHERE Showtime_ID = '$showtimeId' ");
	$rowHour=$hourShowtime->fetch_assoc();
	$hour=$rowHour['Hour'];
	//ตรวจสอบลงทะเบียน
	$oldRegister = $conn->query("SELECT * FROM  registerActivity where Showtime_ID ='".$showtimeId."'");

	 if ($oldRegister) {
             

            while ($register = $oldRegister->fetch_assoc()) {
                 
                 
             
                if ($studentId == $register['Student_ID']) {
                    echo 'คุณได้ลงทะเบียนกิจกรรมห้องนี้ไปแล้ว ไม่สามารถลงซ้ำได้ ';
                    exit();
            	}
            	  if ($seatId == $register['Seat_ID']) {
                    echo 'มีคนลงทะเบียนที่นั่งไปแล้ว ';
                    exit();
            	}
			}


	$RegisDate = new DateTime();

	$result=$conn->query("INSERT INTO `SAU`.`registerActivity` (`Student_ID`, `Showtime_ID`, `Seat_ID`, `Register_Date`) VALUES ('".$studentId."', '".$showtimeId."', '".$seatId."', '".$RegisDate->format('Y-m-d H:i:s')."')");
	

	//update ชั่วโมง ลงตาราง student
	$resultHourStudent =$conn->query("UPDATE Student SET HourAct='$hour'+HourAct WHERE Student_ID='$studentId'");
		echo "เรียบร้อย";
			var_dump($hour);
	// mysql_query($sql);

}

?>