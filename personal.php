<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<style type="text/css">

	

		#studentDetail{ 
	    display: table;
	    border-collapse: separate;
	    border-spacing: 8px;
		}

	</style>
	
	<script type="text/javascript">
		<?php require('js/activeNav.js');?>


	$(document).ready(function(){
		
	 loadAjax(0);//แสดงข้อมูลเริ่มต้นตำแหน่งที่ 0 
			
	 var count = 10;
			
	 //scroll load data detail
	  $(".data-scroll").bind("scroll", function(){
		//เมื่อ Scroll ถึงด้านล่างสุด ให้เรียก function loadAjax		
		if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight){
		    loadAjax(count);
		    count = count+10;
		   // $("#sum_count").text(count);
		}
	    });
	});
	
	//ดึงข้อมูลจาก Database มาแสดงโดยใช้ Ajax
	function loadAjax(count){
		$.ajax({
			type:"POST",
			url:"getHistoryPersonal.php",
			data:{value:count},

			success:function(data){
				$("#dataRegisterHistory").append(data);
			}
		});
	}
   

	
	</script>
</head>

<body >
<?php 
	session_start();

	$studentId=$_SESSION['id'];
	require('connect.php');
	require('css/nav.css');

	if(isset($_GET['re'])){
				
				//ลบจำนวนชั่วโมง
				
				$result=$conn->query("SELECT * FROM `registerActivity` INNER JOIN Showtime ON registerActivity.Showtime_ID=Showtime.Showtime_ID INNER JOIN Activity ON Showtime.Activity_ID=Activity.Activity_ID WHERE Register_ID='".$_GET['id']."' ");
				$rowHour=$result->fetch_assoc();

				$resultHour =$conn->query("UPDATE Student SET HourAct=HourAct-'".$rowHour['Hour']."' WHERE Student_ID='$studentId'");


				$sql ="DELETE FROM registerActivity WHERE Register_ID='".$_GET['id']."'";

				if ($conn->query($sql) == TRUE) {
						echo "<div class='container'>";
					    echo "ลบเรียบร้อย"."<br>";
					
				} else {
					    echo "Error deleting record: " or printf("ERROR: %s\n",$conn->error);
					}

						exit();
	}


	
	

	
	$sql="SELECT * FROM `Student` WHERE Student_ID='$studentId'";
	$result = $conn->query($sql);
	$rowStudent=$result->fetch_assoc();

	
?>



<div class="container">
	<div class="col-md-6">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <h4>ข้อมูลส่วนตัว</h4><span>ประวัติการลงกิจกรรม</span>
		    </div>

		    <div class="panel-body">
				<table id="studentDetail">
					<tbody>
						<tr>
							<th>รหัสนักศึกษา</th>
							<td><?echo$rowStudent['Student_Username']?> </td>
						</tr>

						<tr>
							<th>ชื่อนักศึกษา</th>
							<td><?echo$rowStudent['Student_Name']."  ".$rowStudent['Student_Lastname']?> </td>
						</tr>

						<tr>
							<th>คะแนนชั่วโมง</th>
							<td><?echo$rowStudent['HourAct']?> </td>
						</tr>

					</tbody>
				</table>
			<hr>

			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>กิจกรรม</th>
							<th>ห้อง</th>
							<th>วันที่จัด</th>
							<th>เริ่มเวลา</th>
							<th>ที่นั่ง</th>
							<th>จัดการ</th>
						</tr>
					</thead>

					<tbody>
						<?php

							$sql="SELECT * FROM `registerActivity` INNER JOIN Showtime ON registerActivity.Showtime_ID=Showtime.Showtime_ID INNER JOIN Room ON Showtime.Room_ID=Room.Room_ID INNER JOIN Seat ON registerActivity.Seat_ID=Seat.Seat_ID INNER JOIN Activity ON Showtime.Activity_ID=Activity.Activity_ID WHERE  DateShowtime>=(curdate()) AND registerActivity.Student_ID='$studentId'";
							$result = $conn->query($sql);

							while($row=$result->fetch_assoc()){ 
								
						?>

						<tr>
							<td><?echo$row['Activity_Name']?></td>
							<td><?echo$row['room_name']?></td>
							<td><?echo date('d/m/y',strtotime($row['DateShowtime']))?></td>
							<td><?echo$row['StartTimeID']?>.00</td>
							<td><?echo$row['Seat_Name']?></td>
							<td><input type="button" class="btn btn-default" value="ลบ" onclick="window.location.href='?id=<?=$row['Register_ID']?>&re=del'"></td>
						</tr>
		
						<?php } ?>
							

					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="panel panel-default">
		    <div class="panel-heading">

		        <h4 >ประวัติการลงกิจกรรม</h4><span>กิจกรรมทั้งหมดที่เคยเข้าร่วม</span>
		    </div>

		    <div class="panel-body">
		    	
		  		<ul class="list-group">
						
					<div  class="historyActivity-scroll" style="overflow-y:scroll;height:230px;">
							
						<div id="dataRegisterHistory">
							
						</div>

					</div>
						
				</ul>
					
			</div>
		</div>
	</div>

</body>
</html>