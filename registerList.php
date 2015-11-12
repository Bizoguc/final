<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="jsp/jquery.min.js"></script>
	<script type="text/javascript" src="jsp/bootstrap.js"></script>

	<script type="text/javascript">

		function getShowTime(activityId) {
	 
				$.ajax({
			        url: "getShowTimeByActivityId.php",
			        type: 'GET',
			        data: { activityId: activityId } //activityId ชื่อค่า : id value ค่า

				    }).done(function(result) {
				 		
				 		console.log(activityId);

				 });
		}
// 		$(document).ready(function(){
// 			$('a').click(function(){
// 				var test = $('a').attr("href");
// 					$.ajax({
// 			        url: "getRegisterlist.php",
// 			        type: 'GET',
// 			        data: { activityId: test } //activityId ชื่อค่า : id value ค่า

// 				    }).done(function(result) {
// 				// $test=window.location.search ;
// 				 // $.get('getRegisterlist', {'u' : $(this).val()}, function(data){
				 	
// 				 	console.log('actId',test);

// 				 });
				
            
//         });
  
// });
        



	</script>

</head>
<body>

<table class="table table-hover table-bordered">
<thead>
	<tr>
		<td>1.เลือกกิจกรรม</td><td>2.เลือกรอบกิจกรรม</td>
	</tr>
</thead>	

<tbody>

<?php
	include("connect.php");	
	$sql="SELECT Activity.Activity_ID,Activity_Name,DateShowtime,Time_Name,Showtime_ID,Room_Name,Showtime.Hour  FROM Showtime INNER JOIN Activity ON Activity.Activity_ID = Showtime.Activity_ID 
	LEFT JOIN Time ON Showtime.StartTimeID = Time.Time_ID LEFT JOIN Room ON Room.Room_ID = Showtime.Room_ID WHERE DateShowtime>=(curdate())
	GROUP BY Activity_Name ORDER BY Showtime.DateShowtime,Room.Room_ID,Showtime.Hour"; 
	
	$result=mysql_query($sql);
	

	while($row=mysql_fetch_assoc($result)){
?>
	
	<div><?=$row['Activity_ID']?></div>
	
	
	<tr>
		<!--?u=<?=$row['Activity_ID']?>-->
		<td><a id="act-<?=$row['Activity_ID']?>" href="javascript:getShowTime(<?=$row['Activity_ID']?>);"><?echo$row['Activity_Name']?></a> </td>
		<!-- <td><?echo$row['Time_Name']?>&nbsp;</td>
		<td><button class="btn btn-success"><a href="RegisterActivity.php?u=<?=$row['Showtime_ID']?>">ลงทะเบียน</a></td> -->
		<td id="content"></td>
	</tr>


	

<?}?>


</tbody>
</table>
</body>

