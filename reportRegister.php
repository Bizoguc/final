

<html>
<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>

		<style type="text/css">
				@media print{

					.printHide{ 
						display: none !important;
						
					}
					#studentRegister{ 
						
						width: 100%;
						
	         		
					}
				}
		</style>
		<script type="text/javascript">
				
				function printList() {
		    		window.print();
				}

				function getReport(dataShowTime){
						console.log(dataShowTime)
						$.ajax({
				        url: "getReportShowTime.php",
				        type: 'POST',
				        data: { activityId: dataShowTime}
					    }).done(function(result) {
			

					    	var student = result;

					    	$.each(student,function(index,row){

					    		  var d = new Date(row.DateShowtime);  //timestamp
								  var day = d.getDate();//day
								  var month = d.getMonth()+1;   //month
								  var year = d.getFullYear();   //year
								  var dateShow = day + "/" + month + "/" + year;
					    		  
					    		  console.log(dateShow);

					    		$('#headShowtime').html('<center>'+'กิจกรรม '+row.Activity_Name+'</center>');
					    		$('#contentShowtime').html('<center> ห้อง '+ row.room_name +'วันที่ '+dateShow +' เริ่ม  '+ row.StartTimeID+'.00' +' ถึง '+ row.EndTimeID+'.00 '+'</center><hr>');
					    		$('#studentRegister > tbody').append('<tr><td>'+row.Student_Username+'</td>'+'<td>'+row.Student_Name+'   '+row.Student_Lastname+'</td><td>'+row.Seat_Name+'</td><td></td></tr>')
					    	
					    	});


					    });

				}

				$(document).ready(function(){
					$('#studentRegister').hide();
					$('#printStudent').hide();
					
			
				})

				$(document).ready(function(){
					$('a').click(function(){
						$('#studentRegister').show();
						$('#printStudent').show();
						$('#studentRegister').find('tbody > tr').remove();

					})

				})

		</script>
</head>

<body>

<?php
	require('checkAdminLogin.php');
	require('css/nav.css');
	include('connect.php');
	$sql="SELECT * FROM registerActivity  INNER JOIN Showtime ON registerActivity.Showtime_ID=Showtime.Showtime_ID INNER JOIN Activity ON Showtime.Activity_ID = Activity.Activity_ID  INNER JOIN Room ON Showtime.Room_ID=Room.Room_ID WHERE DateShowtime>=(curdate()) GROUP BY registerActivity.Showtime_ID ORDER BY Activity_Name asc";
	$result=$conn->query($sql);


?>
	<div class="container">
		<div class="col-md-6">
			<div class="panel panel-default">
		        <div class="panel-heading printHide">
		            <h4>ออกใบรายชื่อนักศึกษา</h4><span>เลือกกิจกรรมที่ต้องปริ้นรายชื่อนักศึกษาที่ลงทะเบียนที่นั่ง</span>
		        </div>

		        <div class="panel-body">
		           	<div class="table-responsive">
						<table class="printHide table table-hover table-bordered" id="listShowtime">
							<thead>
								<tr>
								<th>ชื่อกิจกรรม</th>
								<th>ห้อง</th>
								<th>วันที่จัดกิจกรรม</th>
								<th>เริ่ม</th>
								
								

								</tr>
							</thead>
							<tbody>

												
								<?php while($rowReport=$result->fetch_assoc()){
									$dateShowtime=$rowReport['DateShowtime'];
								?>

								<tr>
									<td>
										<a href="javascript:getReport(<?=$rowReport['Showtime_ID']?>);"><?echo $rowReport['Activity_Name']?></a>
									</td>
									<td>
										<?=$rowReport['room_name'];?>
									</td>
									<td>
										<?php echo date('d/m/Y',strtotime($rowReport['DateShowtime']))?></td>
									</td>

									<td>
										<?=$rowReport['StartTimeID'].'.00'.' - '.$rowReport['EndTimeID'].'.00'; ?>
									</td>
									
								
								</tr>
								<?php } ?>
								
							</tbody>
							</table>
						</div>
						
							<hr class="printHide">

							<h3 id="headShowtime"></h3>
							<span id="contentShowtime"></span>
							<div class="table-responsive">
							<table border="1px" class="table table-hover table-bordered" id="studentRegister">
							<thead>
								<tr>
								<th>รหัสนักศึกษา</th>
								<th>ชื่อ-นามสกุล</th>
								<th>เลขที่นั่ง</th>
								<th>หมายเหตุ</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
							</table>
							</div>
							<br>
							<button id="printStudent" class="printHide btn btn-default" onclick="printList()">ออกใบรายชื่อ</button>
					</div>
</body>

</html>