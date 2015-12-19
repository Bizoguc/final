<?php
 require 'checkAdminLogin.php';
?>

<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		
			<script type="text/javascript">

				<?php 
					  require('js/activeNav.js');

				?>

				function editActivity(activityId) {
   				 	//$.get("ActListUpdate.php");
   				 	window.location = "actListUpdate.php?id=" +activityId;
    				//return false;
				}

				function delActivity(activityId) {
   				 	//$.get("ActListUpdate.php");
   				 	window.location = "actList.php?id="+activityId+"&act=del";
    				//return false;
				}

				function showFacultyActivity(id){
					$.ajax({ 
		            url: "getFacultyAct.php",
		            type: 'POST',
		            data: { faculty: id } //ค่าแรกคือค่าที่ส่งไปอีกหน้า : คือค่าที่จะส่งไป หน้านี้นี่เอง
		            }).done(function(result) {

		            var id = result;
     				console.log(id.length);

		             // $("#listAct > tbody").find('td').css({'background-color': 'white'}).attr('colspan', '').empty();
					 $('#listAct tbody tr').remove();
		             $.each(id, function( index, listAct ) {


					    		  var d = new Date(listAct.Activity_Date);  
								  var day = d.getDate();//day
								  var month = d.getMonth()+1;   //month
								  var year = d.getFullYear();   //year
								  var dateActivity = day + "/" + month + "/" + year;
					    		  
					    		  

		             	 //$("#dtd").html(listAct.Activity_Name);
                  		$('#listAct tbody').append('<tr>'+ 
                  			'<td>' + listAct.Activity_Name +  '</td>'+
                  			'<td>' + listAct.Activity_Detail +  '</td>'+
                  			'<td>' + dateActivity +  '</td>'+
                  			'<td>' + listAct.Activity_StartTime +  '</td>'+
                  			'<td>' + listAct.Activity_Hour +  '</td>'+
                  			'<td>' + listAct.Activity_Quantity +  '</td>'+
                  			'<td>' + listAct.Type_Name +  '</td>'+
                  			'<td>' + listAct.Faculty_Name +  '</td>'+
                  			'<td><button class="btn btn-warning"   onclick="editActivity('+ listAct.Activity_ID + ')" >แก้ไข</button>  <button class="btn btn-danger"  onclick="delActivity('+ listAct.Activity_ID + ')">ลบ</button></td></tr>');
                  		
				             });
					    });
				}


				$(document).ready(function() {
				$('input[type=radio][id=facultyCheck]').change(function() {
   					
   					var id = $(this).val();
             	    console.log('faculty', id);

             	    showFacultyActivity(id);
             	   	
			        });
				});
		      
	</script>

		<title>Index | Student</title>
	</head>

	<body>

		<?php
			require("css/nav.css");
				
			// deleted
			require("connect.php");

			if(isset($_GET['act'])){
				$sql ="DELETE FROM Activity WHERE Activity_ID='".$_GET['id']."'";
			
				if ($conn->query($sql) == TRUE) {
						echo "<div class='container'>";
					    echo "ลบเรียบร้อย"."<br>";
					    echo "<a href=ActList.php> กลับสู่หน้ากิจกรรม</a>";
				} else {
					    echo "Error deleting record: " or printf("ERROR: %s\n",$conn->error);
					}

						exit();
			}

		?>

		<div class="container">
			<div class="col-md-12">
				 <div class="panel panel-default">
		            <div class="panel-heading">
		            	<h3>รายชื่อกิจกรรม
		            	
		            	<input style="float:right; margin-right:2%;" type='button' class="btn btn-success " value='เพิ่มกิจกรรม' id='addButton' onclick="window.location.href='ActListInsert.php'">
		            	</h3>

							  <input type="radio" id="facultyCheck" name="facultyCheck" value="1"> บริหารธุรกิจ
							  <input type="radio" id="facultyCheck" name="facultyCheck" value="2"> วิศวกรรมศาสตร์
							  <input type="radio" id="facultyCheck" name="facultyCheck" value="3"> นิติศาสตร์
							  <input type="radio" id="facultyCheck" name="facultyCheck" value="4"> ศิลปศาสตร์และวิทยาศาสตร์
							     
							 
						
		            </div>	
		            	        
					<div class="panel-body">
						<div class="table-responsive">
							<table id="listAct" class="table table-hover table-bordered" >
							<thead>
								<tr>
									
									<th >ชื่อกิจกรรม</th>
									<th>รายละเอียดกิจกรรม</th>
									<th>วันที่จัด</th>
									<th>เวลาที่จัด</th>
									<th>ระยะเวลากิจกรรม</th>
									<th>จำนวนที่รับ</th>
									<th>ประเภทกิจกรรม</th>
									<th>เฉพาะคณะ</th>
									<th>จัดการกิจกรรม</th>
									
								</tr>
							</thead>
							<tbody>

		<?php
			include("connect.php");
			// $result = mysql_query("SELECT * FROM Activity");
			$result = $conn->query("SELECT Activity_StartTime ,Activity_ID,Activity_Name,Activity_Detail,Activity_Date,Activity_Hour,Activity_Quantity,Type_Name,Faculty_Name FROM Activity 
				INNER JOIN Faculty ON Activity.Faculty_ID = Faculty.Faculty_ID INNER JOIN Type ON Activity.Type_ID = Type.Type_ID ORDER by Activity_Date");

			mysql_query("SET NAMES utf8");

			// var_dump($result);
			// exit();

			while($row = $result->fetch_assoc())
				{?>
				
				<tr>


					<td ><? echo$row['Activity_Name'];?></td>
					<td ><? echo$row['Activity_Detail'];?></td>
					<td ><? echo date('d/m/y',strtotime($row['Activity_Date']));?></td>
					<!-- <td ><? echo date('d m y',strtotime($row['Activity_StartTime']));?></td> -->
					<td ><? echo$row['Activity_StartTime'].".00";?></td>
					<td ><? echo$row['Activity_Hour']."  ชั่วโมง";?></td>
					<td ><? echo$row['Activity_Quantity'];?></td>
					<td ><? echo$row['Type_Name'];?></td>
					<td ><? echo$row['Faculty_Name'];?></td>
			
					<td>
					
					  <button class="btn btn-warning" onclick="window.location.href='ActListUpdate.php?id=<?=$row["Activity_ID"]?>'">แก้ไข</a> </button> 
				      <button class="btn btn-danger" onclick="window.location.href='?id=<?=$row["Activity_ID"]?>&act=del'">ลบ</a> </button>
						
					</td>

					</tr>
				
				<?}?>
					</tbody>
				</table>
					
				
				<?$conn->close();?>
				
			</div>
		</div>		
	</div>
</div>

</body>


	
