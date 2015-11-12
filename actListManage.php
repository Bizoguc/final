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

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="jsp/jquery.min.js"></script>
	<script type="text/javascript" src="jsp/bootstrap.js"></script>
	<script type="text/javascript">



	 	function getManage(date) {

          	$.ajax({ 
			  url: "getManage.php",
			  type: 'POST',
			  data: { dataDate: date }
			  }).done(function(result) {

			  var date = result;
 
 			  console.log(date.length);

			  $.each(date, function( index, showTime ) {
  					

  					console.log(showTime);

  					var $tdStartTime = $('#activity-' + showTime.Room_ID + '-' + showTime.StartTimeID);
  					var $tdEndTime =  $('#activity-' + showTime.Room_ID + '-' + showTime.EndTimeID);

  					//console.log($tdStartTime.index(), $tdEndTime.index());

  						$tdStartTime.html($tdStartTime.html() + '<a href=javascript:void(0);>' + showTime.Activity_Name + '     ' +'del</a>');

  						$tdEndTime.html(showTime.Activity_Name);

  						var diff = $tdStartTime.index() - $tdEndTime.index() + 1;

  						console.log($tdStartTime.index(), $tdEndTime.index())


  						// merge cell
  						var colspan = $tdEndTime.index() - $tdStartTime.index() + 1;
  						//$tdStartTime.attr('colspan', colspan)

  						for (i=$tdEndTime.index(); i <= $tdEndTime.index() + diff; i++) {
  							//$tdEndTime.parent().eq(i).remove();
  						}

  						// $tdStartTime.attr('href', gg.php) 
  						// console.log(colspan-1);
  						// remove cell
  						console.log(showTime.Activity_Name, $tdStartTime.index(), $tdEndTime.index());

  						for (i=$tdStartTime.index(); i <= $tdEndTime.index(); i++)  {
  						 	

  							var $row = $('#room-no-' + showTime.Room_ID).parent();

  							//$row.find('td:last').remove();
  							// console.log($row.html());
  							//$row.find('td:nth-child(i+1)').remove();
  							//$row.find('td:nth-child(i+colspan)').remove();
  						}

  						$tdStartTime.css({
  							'text-align': 'center',
  							'background-color':'#EEEEEE',
  							'color':'#000000',
  							'font-weight': 'bold',

  						});
  						// $tdEndTime.html(showTime.Activity_Name + ' E');
				});

 			

			}).error(function(){
				console.log("ERROR");
			});
	 	}

	 

	 $(document).ready(function () {

       $("#iDate").change(function () {


       	// $('#content tbody').empty();
       	// $('#content tbody').remove();
       // $("#content > tbody").html("");
       // $('#content').dataTable().fnClearTable();

$("#content > tbody").find('td:not(:first-child)').css({'background-color': 'white'}).attr('colspan', '').empty();

      		var id = $(this).val();

          	console.log('Date', id);

          	getManage(id);
		});
     var date = new Date();
     console.log(date);
var day = date.getDate();
var monthIndex = date.getMonth() + 1;
var year = date.getFullYear();


console.log(day, monthIndex, year);
	var datenow = year + '-' + monthIndex + '-' + day;
	console.log(datenow);
       //getManage(datenow);
       getManage("2015-11-10");
    });
      
	

	</script>
	<title>ตารางกิจกรรม</title>
</head>
<body>

	<form action="listManage.php" method="post">
	<input type="date" id="iDate" value="<?php echo date('Y-m-d'); ?>">

	<table  id="content" class="table table-hover table-bordered" >
		<thead>
		<tr>
			<th>ห้อง/เวลา</th>

				<?php
					include("connect.php");
					$result = mysql_query("SELECT * FROM Time");

					while($row = mysql_fetch_array($result))
					{?>			
						<th id="time-<?=$row['Time_ID'];?>"><? echo$row['Time_Name'];?></th>
			
					<?}?>
	
			
		</tr>
		</thead>



			<?php
				include("connect.php");
				$result = mysql_query("SELECT * FROM Room");
				while($row = mysql_fetch_array($result))
			{?>

			
			<tbody>
			<tr>
				<td id="room-no-<?=$row['Room_ID'];?>"><? echo$row['room_name'];?></td>
				
				<?php
					include("connect.php");
					$timeResult = mysql_query("SELECT * FROM Time");

					while($timeRow = mysql_fetch_array($timeResult))
						//ห้องและเวลา
					{?>			
					
						<td id="activity-<?=$row['Room_ID']?>-<?=$timeRow['Time_ID']?>">&nbsp;</td> 
				
					<?}?>					

			</tr>	
			</tbody>
			<?}?>
	

</table>
</form>
	
</body>
</html>