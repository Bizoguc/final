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
			</script>
			
		<title>Index | Student</title>
	</head>

	<body>

		<?php
			include("css/nav.css");
				
			// deleted
			include("connect.php");

			if(isset($_GET['act'])){
				$sql = ("delete FROM Activity WHERE Activity_ID='".$_GET["u"]."' ");
			
				if (mysql_query($sql) == TRUE) {
						echo "<div class='container'>";
					    echo "ลบเรียบร้อย"."<br>";
					    echo "<a href=ActList.php> กลับสู่หน้ากิจกรรม</a>";
				} else {
					    echo "Error deleting record: " . $conn->error;
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
		            </div>	
		            	        
					<div class="panel-body">
						<div class="table-responsive">
							<table  class="table table-hover table-bordered" >
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

		<?php
			include("connect.php");
			// $result = mysql_query("SELECT * FROM Activity");
			$result = mysql_query("SELECT Activity_StartTime ,Activity_ID,Activity_Name,Activity_Detail,Activity_Date,Activity_Hour,Activity_Quantity,Type_Name,Faculty_Name FROM Activity 
				INNER JOIN Faculty ON Activity.Faculty_ID = Faculty.Faculty_ID INNER JOIN Type ON Activity.Type_ID = Type.Type_ID ORDER by Activity_Date");

			mysql_query("SET NAMES utf8");

			// var_dump($result);
			// exit();
			while($row = mysql_fetch_array($result))
				{?>
				<tbody>
				<tr>


					<td ><? echo$row['Activity_Name'];?></td>
					<td ><? echo$row['Activity_Detail'];?></td>
					<td ><? echo date('d M Y',strtotime($row['Activity_Date']));?></td>
					<!-- <td ><? echo date('H.i',strtotime($row['Activity_StartTime']));?></td> -->
					<td ><? echo$row['Activity_StartTime'].".00";?></td>
					<td ><? echo$row['Activity_Hour']."  ชั่วโมง";?></td>
					<td ><? echo$row['Activity_Quantity'];?></td>
					<td ><? echo$row['Type_Name'];?></td>
					<td ><? echo$row['Faculty_Name'];?></td>
			
					<td>
					
					  <button class="btn btn-warning" onclick="window.location.href='ActListUpdate.php?u=<?=$row["Activity_ID"]?>'">แก้ไข</a> </button> 
				      <button class="btn btn-danger" onclick="window.location.href='?u=<?=$row["Activity_ID"]?>&act=del'">ลบ</a> </button>
						
					</td>

					</tr>
					</tbody>
				<?}?>
				</table>
					
				
				<?mysql_close($conn);?>
				
			</div>
		</div>		
	</div>
</div>

</body>


	
