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
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript">
		<?php require('js/activeNav.js');?>
	

		$(document).ready(function() {
	   		$("#content").hide();
			$('hr').hide();
		});

		function registerSeat(showTimeId) {
   				 	//$.get("ActListUpdate.php");
   				 	window.location = "registerSeat.php?id=" +showTimeId;
    				//return false;
				}


		function getShowTime(dataShowTime) {
	 		
				$.ajax({
			        url: "getShowTimeByActivityId.php",
			        type: 'POST',
			        data: { activityId: dataShowTime}
				    }).done(function(result) {
	 				
	 				var dataShowTime = result;
 					console.log(dataShowTime,'a')

 					  $.each(dataShowTime, function( index, showTime ) {
 					  
 								  var d = new Date(showTime.DateShowtime);  //timestamp
								  var day = d.getDate();//day
								  var month = d.getMonth()+1;   //month
								  var year = d.getFullYear();   //year
								  var dateShow = day + "/" + month + "/" + year;
					    		  
					    		  console.log(dateShow);


 					  	$('.dateContent').append(dateShow+"<br>");
 					  	$('.roomContent').append(showTime.room_name+"<br>");
 					  	$('.timeContent').append("<a href=javascript:void(0) onclick=registerSeat('" + showTime.Showtime_ID + "')>" + showTime.StartTimeID + '.00' + ' - '+ showTime.EndTimeID + '.00' + "</a>"+"<br>");
 					 	// $('.timeContent').append("<a href=javascript:void(0)>" + showTime.StartTimeID + '.00' + "</a>"+"<br>");
 					 	});
				
				}).error(function(){
					console.log("ERROR");
				 });
		}

		$(document).ready(function () {
        $("a").click(function () {
    			$('.dateContent').empty();
    		    $('.timeContent').empty();
    		    $('.roomContent').empty();
    			$('#content').show();
    			$('hr').show();
    				 
        		});
        });




	</script>

</head>


<body>

<?php 
	require('css/nav.css');
	include("connect.php");	
?>

	
  <div class="container-fluid">
      <div class="container">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
         
              <h4>ลงทะเบียนกิจกรรม</h4> <small>เลือกกิจกรรมที่สนใจเพื่อเข้าร่วม</small>
            </div>

            <div class="panel-body">

            <div class="table-responsive">
				<!-- 	<div style="float:left"> -->
				<table id="nameActivity" class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>1.เลือกกิจกรรม</th>
							<th>รายละเอียด</th>
						</tr>
					</thead>	

					<tbody>

						<?php
								
							$sql="SELECT * FROM Showtime  INNER JOIN Activity ON Showtime.Activity_ID = Activity.Activity_ID WHERE DateShowtime>=(curdate())  GROUP BY Activity_Name"; 
								
							$result=$conn->query($sql);
								

							while($row=$result->fetch_assoc()){
						?>
						
						<tr>
									
							<td><a id="act-<?=$row['Activity_ID']?>" href="javascript:getShowTime(<?=$row['Activity_ID']?>);"><?echo$row['Activity_Name']?></a> </td>
							<td><?=$row['Activity_Detail']?></td>
						</tr>
						
						<?}?>

					</tbody>

				</table>
				<hr>
						<table id="content" class="table table-hover border table-bordered">
							<thead>
								<tr>
									<th>2.เลือกรอบกิจกรรม</th>
									<th>ห้อง</th>
									<th>เวลาเริ่ม</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="dateContent"></td>
									<td class="roomContent"></td>
									<td class="timeContent"></td>
								</tr>
										
							</tbody>

						</table>


					</div>
				</div>
				</div>

			</div>


	
	 <div class="col-md-6">
          <div class="panel panel-default">
            <div id="chooseActivity"class="panel-heading">
            	<h4>ประโยชน์ของกิจกรรม</h4> <small>การร่วมกิจกรรมมีประโยชน์มากมายดังนี้</small>
         	</div>

         	<div id="detailActivity"class="panel-body">
         		  1. เพื่อพัฒนาด้านสุขภาพ (Health Development)
	              <p>&nbsp;&nbsp;&nbsp;- ทำให้ร่างกายมีการเคลื่อนไหว ซึ่งถือเป็นการออกกำลังกายอย่างหนึ่ง</p>

	             	2. เพื่อพัฒนาด้านมนุษยสัมพันธ์ (Human Relationship)
	              <p>&nbsp;&nbsp;&nbsp;- ก่อให้เกิดความสามัคคี รักใคร่กลมเกลียวกันในหมู่คณะส่งเสริมมนุษยสัมพันธ์และการทำงานเป็นทีม</p>
	            	3. เพื่อพัฒนาการเป็นพลเมืองดี (Civic Development)
	              <p>&nbsp;&nbsp;&nbsp;- ส่งเสริมความเป็นพลเมืองดี ลดปัญหาการประพฤติผิดศีลธรรม หรือปัญหาอาชญากรรม โดยใช้เวลาให้เกิดประโยชน์ </p>
	            	4. เพื่อพัฒนาตนเอง (Self Development)
	              <p>&nbsp;&nbsp;&nbsp;- ประโยชน์ต่อตนเอง ทำให้มีสุขภาพดีทั้งกายและใจ พักผ่อนคลายความตึงเครียด </p>


      
         	</div>
          </div>
      </div>
	</div>
	</div>

</body>

