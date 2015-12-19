

<!doctype html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<title> Success : Activity</title>
	</head>

<body>
	<?php include("css/nav.css");?>

		<section class="container">

			<?php	
				include("connect.php");
				date_default_timezone_set('Asia/Bangkok');
				$RegisDate = new DateTime();

				// $_POST['Detail'];
				// $_POST['Date'];
				// $_POST['startActivity'];


			//(date_format($now, 'Y-m-d'));
			//var_dump($now);
			//exit();
			//var_dump($now->format('Y-m-d'));

			//exit();
				



				$conn->query("SET NAMES 'utf8'");
				$result=$conn->query("INSERT INTO Activity(Activity_Name,Activity_Detail,Activity_Date,Activity_StartTime,Activity_Hour,Activity_Quantity,Faculty_ID,Type_ID,RegisDate)
				values('".$_POST['Name']."','".$_POST["Detail"]."','".$_POST['Date']."','".$_POST["startActivity"]."','".$_POST["Hour"]."','".$_POST["Quan"]."','".$_POST["facultyActivity"]."',
					'".$_POST["typeActivity"]."','".$RegisDate->format('Y-m-d H:i:s')."')") or printf("ERROR %s\n",$conn->error);


				if($result){
					echo "ใส่ข้อมูลเรียบร้อย<br>";
					echo "<a href=ActList.php> กลับ </a>";
				}else{
					echo "Error!";
				}
				$conn->close();
			?>

		</section>

</body>

