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
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

		<script type="text/javascript">
				<?php 
					  require('js/activeNav.js');
				?>
		</script>
	<title> Import : Student</title>
</head>

<body>

<?php include('css/nav.css');?>




<div id="content" class="container">


<form action="excel.php" method="post" enctype="multipart/form-data" name="form1">
  <h3> เพิ่มไฟล์รายชื่อนักศึกษา </h3><br>
  <span class="file-input btn btn-primary btn-file"> <input name="fileCSV" id="fileCSV" type="file" ></span>
  <br><br><br><input name="btnSubmit" class="btn btn-warning btn-modify" type="submit"  value="ยืนยัน">
</form>
</section>
</body>
</html>