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


<html>

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

<div class="container">

<form action="excel.php" method="post" enctype="multipart/form-data" name="form1">
  <input name="fileCSV" type="file" id="fileCSV">
  <input name="btnSubmit" type="submit"  value="Submit">
</form>
</body>
</html>