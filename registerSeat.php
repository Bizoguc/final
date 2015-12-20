<?php
session_start(); ob_start();

if($_SESSION['status']== null){
	 header("Location: login.php");
     exit;
}
 
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<style type="text/css">

		table { 
	    display: table;
	    border-collapse: separate;
	    border-spacing: 8px;
		}

		.frontRoom{
			width: 264px;
			height:25px;
			margin: 0 0 10px 0;
		}
		   
		.typeImg {
	    width: 20px;
	    height: 25px;
	    
		}

		.seat-box {
		position: relative;
	    width: 27px;
	    height: 27px;
	    display: block;
	    float: left;
	   /* border: 1px solid #000;*/
		}

		.imgSize {
		width: 20px;
		height: 25px;
		    
		position: absolute;
	    z-index: 1;
	    left: 50%;
	    margin-left: -11px;
	    top: 50%;
	    margin-top: -11px;
		}

		.check {
		display: block;
	    position: absolute;
	    z-index: 2;
	    background-image: url('img/seat-selected.png'); 
	    width: 25px;
	    height: 30px;
	    right: 2px;
	    bottom: 2px; 
		}

		.hide {
			display:none;
		}

	

	</style>

	<script type="text/javascript">
		function sendRegister(seatId,showtimeId){
			window.location = "saveRegister.php?seat="+seatId+"&showTime="+showtimeId;

		}

		function registerSeat(seatId,showtimeId){
		 
		 $.ajax({
            url: "getSeat.php",
            type: 'POST',
            data: { seatData: seatId }
            
          }).done(function(result){
          	seat = (JSON.parse(result));
          	$('#sendSubmit').empty();
          	$("h5").html("คุณได้เลือกที่นั่ง"+seat.Seat_Name);
			$('#sendSubmit').append('<input type="submit" class="btn btn-success" style="float:right;margin-right: 45px;" value="ยืนยัน" onclick="sendRegister(' + seatId +","+ showtimeId +')"></button>');
          	// window.location = "actlist.php";
	});
}


		$(document).ready(function () {
	    $('a.seat-box').click(function() {
	    	$('.check').addClass('hide');
	       	$(this).find('.check').removeClass('hide')
	        //$(this).parent().addClass('selected');
	    });
	});

		function busySeat(seatId){
		
			$('#sendSubmit').empty();
			$("h5").html("เสียใจด้วยมีคนลงแล้ว");
		}
				



	</script>

	<title></title>
</head>
<body>
	<?php 

	require('connect.php');
	require('css/nav.css');
	$showTimeId=$_GET['id'];

	$sql="SELECT * FROM Showtime INNER JOIN Activity ON Showtime.Activity_ID = Activity.Activity_ID  INNER JOIN Room ON Showtime.Room_ID = Room.Room_ID WHERE Showtime_ID='$showTimeId'";
	$result=$conn->query($sql);
	$row= $result->fetch_assoc();

	?>


  <div class="container-fluid">
      <div class="container">
        <div class="col-md-4">
          	<div class="panel panel-default">
	            <div class="panel-heading">
	             	<h4>ลงทะเบียนกิจกรรม</h4> <small>เลือกกิจกรรมที่สนใจเพื่อเข้าร่วม</small>
	            </div>

			    <div class="panel-body">

				<table  class="table-responsive" id="showActivity">
					<tbody>
						<tr>
							<th>ชื่อกิจกรรม</th>
							<td><?=$row['Activity_Name']?></td>
						</tr>

						<tr>
							<th>วันที่</th>
							<td><?=$row['DateShowtime']?></td>
						</tr>

						<tr>
							<th>รอบจัดกิจกรรม</th>
							<td><?=$row['StartTimeID']?>.00 - <?=$row['EndTimeID']?>.00</td>
						</tr>

						<tr>
							<th>ห้องที่</th>
							<td><?=$row['room_name']?></td>
						</tr>

						<tr>
							<th>ตึก</th>
							<td><?=$row['room_buliding']?></td>
						</tr>
					</tbody>
				</table>

				<hr>

				<table class="table-responsive"  id="detailSeat">
					<tbody>
						<tr>
							<td style="color:red">
								<h4>**เลือกได้เพียงที่นั่งเดียวเท่านั้น**</h4>
							</td>
						<tr>
						</tr>
							<td>
								<div id="typeSeat">			
										<img src='img/seat.png' class="typeImg"><span>ที่นั่งว่าง</span>
										<img src='img/seatRegister.png' class="typeImg"><span>ที่นั่งที่เลือก</span>
										<img src='img/registerSeat.png' class="typeImg"><span>ที่นั่งไม่ว่าง</span>
								</div>
							</td>
						</tr>	
					</tbody>
				</table>

				<hr>

				<table class="table-responsive" id="chooseSeat" width="290px">
					<tbody>
						<tr>
							<td>
								<div>
									<img src='img/frontRoom.png' class="frontRoom">
								</div>
							</td>
						</tr>
						<tr>

							<td>
								<div id="choose">
									<?php
										$quantity=$row['Quantity'];

										for($i=1; $i<=$quantity; $i++ ){


										$sql = "SELECT * FROM `registerActivity` WHERE Showtime_ID = ".$_GET['id']." AND Seat_ID = ".$i;
										 
										$result=$conn->query($sql);
										$seatExist = $result->fetch_assoc();

										 
										if ($seatExist) { ?>
											 <a   
											 	class="seat-box "
											 	id="no-seat-<?=$i?>" 
											 	href="javascript:busySeat(<?=$i?>,<?=$row['Showtime_ID']?>);">
											 		<img class="imgSize" src="img/registerSeat.png">
											 		<div class="check hide"></div>
											 </a>
										<?php } else { ?>
											 <a   
											 	class="seat-box"
											 	id="no-seat-<?=$i?>" 
											 	href="javascript:registerSeat(<?=$i?>,<?=$row['Showtime_ID']?>);">
											 		<img class="imgSize" src="img/seat.png">
											 		<div class="check hide"></div>
											 </a>
										<?php } ?>  
									 
										

									<? }?>
							
										
									</div>

								</td>
							</tr>

						</tbody>

					</table>



					<h5  style="margin-left: 12px; float:left;" ></h5>

					<div id="sendSubmit"> </div>
				</div>
			</div>
		</div>

		<div class="col-md-8">
          	<div class="panel panel-default">
	            <div class="panel-heading">
	             	<h4>กฎการลงทะเบียน</h4> <small>หากทำผิดกฎจะโดนลงโทษตามความเหมาะสม</small>
	            </div>

			    <div class="panel-body">
			    	<p>1.ห้ามลงทะเบียนซ้ำในห้องกิจกรรมเดิม</p>
			    	<p>2.หากลงทะเบียนไปแล้วไม่มาเข้าร่วมกิจกรรม จะโดนหักคะแนน</p>
			    	<p>3.หากต้องการยกเลิกการลงทะเบียนกิจกรรม ให้ทำการลบก่อนกิจกรรมเริ่ม 1 วัน</p> 

			    </div>
			</div>
		</div>
	</div>		
</div>

</body>
</html>