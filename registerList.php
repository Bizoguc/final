<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript">

		function getShowTime(dataShowTime) {
	 
				$.ajax({
			        url: "getShowTimeByActivityId.php",
			        type: 'POST',
			        data: { activityId: dataShowTime}
				    }).done(function(result) {
	 				
	 				var dataShowTime = result;
 					//console.log(dataShowTime, 'a')

 					  $.each(dataShowTime, function( index, showTime ) {
 					  	
 					  	$('.dateContent').append(showTime.DateShowtime+"<a href=javascript:void(0)>" + showTime.StartTimeID + '.00' + "</a>"+"<br>");
 					 	// $('.timeContent').append("<a href=javascript:void(0)>" + showTime.StartTimeID + '.00' + "</a>"+"<br>");
 					 	});
				
				}).error(function(){
					console.log("ERROR");
				 });
		}

		$(document).ready(function () {
        $("a").click(function () {
 
    				 $('.dateContent').empty();
        		});
        });




	</script>

</head>
<body>
<h1></h1>
<table id="nameActivity" class="table table-hover ">
<thead>
	<tr>
		<td>1.เลือกกิจกรรม</td>
	</tr>
</thead>	

<tbody>

<?php
	include("connect.php");	
	$sql="SELECT * FROM Showtime  INNER JOIN Activity ON Showtime.Activity_ID = Activity.Activity_ID WHERE DateShowtime>=(curdate())  GROUP BY Activity_Name"; 
	
	$result=mysql_query($sql);
	

	while($row=mysql_fetch_assoc($result)){
?>
	
	<div><?=$row['Activity_ID']?></div>
	
	
	<tr>
		
		<td><a id="act-<?=$row['Activity_ID']?>" href="javascript:getShowTime(<?=$row['Activity_ID']?>);"><?echo$row['Activity_Name']?></a> </td>
		
	</tr>


	

<?}?>
</tbody>
</table>

<table id="content" class="table table-hover border ">
	<thead>
		<tr>
			<td>2.เลือกรอบกิจกรรม</td>
		</tr>
	</thead>

	<tbody>

		<tr>
			<td class="dateContent"></td>

		</tr>
		<tr>
			<td class="timeContent"></td>
		</tr>
	</tbody>

</table>


</body>

