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

<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="jsp/jquery.min.js"></script>
	<script type="text/javascript" src="jsp/bootstrap.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="css/table.css"> -->
</head>

<body>
			<div class="container">
			<nav class="navbar navbar-default">
 				<a class="navbar-brand" href="#">Southeast Asia University</a>
				<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					
				<?php 
		// error_reporting(0);
				 	if (isset($_GET['u'])== null ) {
					
							echo "<li class='active'>";
						}else{
							echo "<li>";
					}?>
						<a href="index.php">หน้าแรก</a>
					</li>
					  

					<?php if($_SESSION['status'] == "Admin"){ ?>

				    <li class="dropdown">
			    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
					aria-expanded="false">Program Admin <span class="caret"></span></a>  

			            <ul class="dropdown-menu">
			            	<li><a href="import.php">Import Student(.CSV)</li>
			 				<li><a href="actList.php">Register ListActivity</a></li>
			                <li><a href="manageActivity.php">Manage Activity</a></li>
			                <li><a href="actlistManage.php">Table Activity</a></li>			           
			                <li><a href="index.php?u=print">Report</a></li>
			            </ul>
			            
		            </li>
				

					<? }else{?>



					<?php 
					// if (isset($_GET['u'])) {
					if (isset($_GET['u']) != null) {
						if($_GET['u'] == "personal"){
							echo "<li class='active'>";
						}else{
							echo "<li>";
						}
					}else{
							echo "<li>";
						}
					?>
					<a href="index.php?u=personal">Personal</a></li>

					<?php 
					if (isset($_GET['u']) != null) {
						if($_GET['u'] == 'register'){
							echo "<li class='active'>";
						}else{
							echo "<li>";
						}
					}else{
							echo "<li>";}
					?>
					<a href="index.php?u=register">โปรแกรมลงกิจกรรม</a></li>

				<?}?>

					  <li><a href="logout.php">Logout</a></li>


				
				</ul>
			</nav>
</div>









<?php
// deleted
include("connect.php");


	if(isset($_GET['act'])){
		$sql = ("delete FROM Activity WHERE Activity_ID='".$_GET["u"]."' ");
//	$result = $conn-> query("delete FROM Activity WHERE Activity_ID='".$_GET["u"]."' ") or die(mysql_error()); 
	
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

<div id="Content" class="container">

	
<h1 class="text-center">รายชื่อกิจกรรม มหาวิทยาลัยเอเชียอาคเนย์</h1>
<br><br>
	<table  class="table table-hover table-bordered" >
	<thead>
	<tr>
		
		<th >ชื่อกิจกรรม</th>
		<th>รายละเอียดกิจกรรม</th>
		<th>วันที่จัด</th>
		<th>เวลาที่จัด</th>
		<th>ชั่วโมงทั้งหมดที่จัด</th>
		<th>จำนวนที่รับ</th>
		<th>ประเภทกิจกรรม</th>
		<th>เฉพาะคณะ</th>
		<th>จัดการกิจกรรม</th>
		
	</tr>
	</thead>

<?php
include("connect.php");
// $result = mysql_query("SELECT * FROM Activity");
$result = mysql_query("SELECT Activity_ID,Activity_Name,Activity_Detail,Activity_Date,Time_Name,Activity_Hour,Activity_Quantity,Type_Name,Faculty_Name
	FROM Activity INNER JOIN Time ON Activity.Activity_StartTime = Time.Time_ID INNER JOIN Faculty ON Activity.Faculty_ID = Faculty.Faculty_ID 
	INNER JOIN Type ON Activity.Type_ID = Type.Type_ID ORDER by Activity_Date");

mysql_query("SET NAMES utf8");

// var_dump($result);
// exit();
while($row = mysql_fetch_array($result))
	{?>
	<tbody>
	<tr>
		<!--<td><? //echo$row['Activity_ID'];?></td>-->
		<td ><? echo$row['Activity_Name'];?></td>
		<td ><? echo$row['Activity_Detail'];?></td>
		<td ><? echo date('d M Y',strtotime($row['Activity_Date']));?></td>
		<td ><? echo$row['Time_Name'];?></td>
		<td ><? echo$row['Activity_Hour'];?></td>
		<td ><? echo$row['Activity_Quantity'];?></td>
		<td ><? echo$row['Type_Name'];?></td>
		<td ><? echo$row['Faculty_Name'];?></td>
		
		<td>
		<div class="btn-group">
		  <button class="btn btn-warning"><a href="ActListUpdate.php?u=<?=$row["Activity_ID"]?>">แก้ไข</a> </button> 
	      <button class="btn btn-danger"><a href="?u=<?=$row["Activity_ID"]?>&act=del">ลบ</a> </button>
		</div>
		</td>
		</tr>
		</tbody>
	<?}?>
	</table>
		<input type='button' class="btn btn-success " value='เพิ่มกิจกรรม' id='addButton' onclick="window.location.href='ActListInsert.php'">
	
	<?mysql_close($conn);?>
	
	</div>
</body>
