test
<?php

session_start(); ob_start();
 
// เช็คว่า User ได้ผ่านการ Login มาหรือไม่ 
	if (!isset($_SESSION['user'])) {
	     header("Location: login.php");
	     exit;
}
 
?>
<html>
	<head>
		<title>Index | Student</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script type="text/javascript" src="jsp/jquery.min.js"></script>
		<script type="text/javascript" src="jsp/bootstrap.js"></script>

	

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








<div class="container  text-center">
<div class="ex">


<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/Home.jpg" alt="มหาลัย" width="1200" height="700">
        <div class="carousel-caption">
          <h3>มหาวิทาลัยเอเชียอาคเนย์</h3>
          <p>ก่อตั้งเมื่อวันที่ 6 สิงหาคม 2516</p>
        </div>      
      </div>
       <div class="item">
        <img src="img/Home2.png" alt="Chicago" width="1200" height="700">
        <div class="carousel-caption">
          <h3>กิจกรรมรับน้อง</h3>
          <p>รุ่นพี่ต้อนรับน้องเด็กศึกษาใหม่</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="img/Home3.png" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>กิจกรรม</h3>
          <p>กิจกรรมที่จัดขึ้นในมหาลัย</p>
        </div>      
      </div>
    </div>

    

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
	</div>
 	
 	

 	<br><br>
 		<div class ="row">
 			<div class="col-sm-4">
 				
 			</div>
 			<div class="col-sm-4">
 				<a href="" >
 					<img src="img/personal.png" class="img-circle person" width="100"></a>
 				     <div ><p><?php
 				     	echo "<br>";
  						echo "ชื่อ ".$_SESSION['user']."<br>";
  						echo "สถานะ ".$_SESSION['status']."<br>"?>
  					</p></div>
 			</div>
 			<div class="col-sm-4">
 			
 			</div>
 			</div>
 	

</div>
</div>
 	<!-- <a href="logout.php">Logout</a> -->

 </div>
</div>

</body>
</html>
