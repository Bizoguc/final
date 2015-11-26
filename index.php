
<?php

session_start(); ob_start(); 
// เช็คว่า User ได้ผ่านการ Login มาหรือไม่ 
	if (!isset($_SESSION['user'])) {
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
			<?php require('js/activeNav.js');?>
		</script>

		<title>Index | Student</title>

	</head>

	<body>
		
	<?php include('css/nav.css');?>
	
		<div class="container-fluid" >

			<div class="container" >

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
				        <img src="img/Home2.png" alt="รับน้อง" width="1200" height="700">

				        <div class="carousel-caption">
				          <h3>กิจกรรมรับน้อง</h3>
				          <p>รุ่นพี่ต้อนรับน้องเด็กศึกษาใหม่</p>
				        </div>      

				      </div>
				    
				      <div class="item">
				        <img src="img/Home3.png" alt="กิจกรรม" width="1200" height="700">

				        <div class="carousel-caption">
				          <h3>กิจกรรม</h3>
				          <p>กิจกรรมที่จัดขึ้นในมหาลัย</p>
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
			 	</div>
			</div>

			<br><br>

				<div class="row">
			 		<div class="container" >

			 			<div class="col-md-3">
			 				<div class="panel panel-default" >
		          		  		<div class="panel-heading">ข้อมูลผู้ใช้ระบบ</div>
		          		  			<div class="panel-body">
						 					<a href="" >
						 						<img src="img/personal.png" class="img-circle person" width="100px">
						 					</a>
						 					<p >
						 				  <?php 
						 				  echo "<br>";
						 				  echo "ชื่อผู้ใช้ :".$_SESSION["user"]."<br>";
						 				  echo "สถานะ    :".$_SESSION["status"];
						 				  ?>

						 				</p>
			 						</div>
			 				</div>
			 			</div>

			 			<div class="col-md-9">
			 				<div class="panel panel-default">
		          		  		<div class="panel-heading">ประวัติความเป็นมาของมหาวิทยาลัยเอเชียอาคเนย์</div>
		          		  			<div class="panel-body">
						 			   <p>
							             test

							          </p>
			 						</div>
			 				</div>
			 			</div>

						
			 		</div>
			 </div>
			 	
		</div>


</body>
</html>
