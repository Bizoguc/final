<?php
	include('checkLogin.php');
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript">
		<?php require('js/actListManage.js');
			  require('js/activeNav.js');
		?>
	</script>
	<title>ตารางกิจกรรม</title>

</head>

 <body>
	<?php include('css/nav.css');?>

<?php

	$times = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

	// foreach ($times as $key => $value) {
	// 	echo $value.'<br/>'.$key.'<br/>';
	// }
?>
		<div class="container">
			<div class="col-md-12">
				 <div class="panel panel-default">
		            <div class="panel-heading">
		            	<h4>ตารางวันที่จัดกิจกรรม
			            	<input type="date" id="iDate" value="<?php echo date('Y-m-d'); ?>">
			            	<input style="float:right; margin-right:2%;" type="submit" value="เพิ่มห้องกิจกรรม" class="btn btn-success" onclick="window.location.href='manageActivity.php'"  >
		            	</h4>
		            </div>	

		            <div class="panel-body">
						<div class="table-responsive">
							<table  id="content"  class="table table-hover table-bordered">
								<thead>
								<tr>
									 <th>ห้อง/เวลา</th>
							         <th id='8'>08.00</th>
							         <th id='9'>09.00</th>
							         <th id='10'>10.00</th>
							         <th id='11'>11.00</th>
							         <th id='12'>12.00</th>
							         <th id='13'>13.00</th>
							         <th id='14'>14.00</th>
							         <th id='15'>15.00</th>
							         <th id='16'>16.00</th>
							         <th id='17'>17.00</th>
							         <th id='18'>18.00</th>
							         <th id='19'>19.00</th>
							         <th id='20'>20.00</th>
								
								</tr>
								</thead>


							<tbody>
								<?php
									include("connect.php");
									$result = mysql_query("SELECT * FROM Room");
									while($row = mysql_fetch_array($result))
								{?>

								
								
								<tr>
									<td id="room-no-<?=$row['Room_ID'];?>"><? echo$row['room_name'];?></td>
									
									<?php

										/**for ($i=8; $i <= 20; $i++) {
										    echo "<td id=activity-<?=$row['Room_ID']?>-".$i."</td>";
										}**/

										include("connect.php");
										//$timeResult = mysql_query("SELECT * FROM Time");
										//while($timeRow = mysql_fetch_array($timeResult))
											//ห้องและเวลา

										
										$times = array(
											    "8" => "",
											    "9" => "",
											    "10" => "",
											    "11" => "",
											    "12" => "",
											    "13" => "",
											    "14" => "",
											    "15" => "",
											    "16" => "",
											    "17" => "",
											    "18" => "",
											    "19" => "",
											    "20" => "",
											);
										foreach ($times as $key => $value) 
											//echo $value.'<br/>'.$key.'<br/>';
									 
										

										{?>			
										
											<td id="activity-<?=$row['Room_ID']?>-<?=$key?>"></td> 
									
										<?}?>					

								</tr>	
								
								<?}?>
							</tbody>

						</table>

					</div>
				</div>
			</div>
		</div>
	</div>


</body>
</html>