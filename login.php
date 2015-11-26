<?php session_start(); ob_start();

?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title> Login</title>
</head>
<body >

<?php 
	include 'connect.php';
	
	if(isset($_POST['send']) != null){
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		if($user == null || $pass == null){
			echo "กรุณากรอกข้อมูล";
		}else{ 
			$sql = "SELECT * FROM Student where Student_Username ='".$user."' And Student_Password ='".$pass."'  ";
			$query = mysql_query($sql);
			$num = mysql_num_rows($query);
			$row = mysql_fetch_array($query);
					
			if($row['Status'] == "1"){

				$_SESSION['status'] = "Admin";
				}else if ($row['Status'] == "0"){
				$_SESSION['status'] = "User"; 
			}
					
			if($num > 0){

				$sql = "SELECT * FROM Student WHERE Student_Username = '".$user."' ";	
				$query = mysql_query($sql);
				$row = mysql_fetch_array($query);
				

						if($row['LogIn'] == "1" ){
							// mysql_query("DELETE FROM Login WHERE unix_timestamp( ) - Logtime > 60 ");
							echo "มีการ Login ซ้ำ";
						
						}else{

							$sql = "UPDATE Student SET LogIn='1',LogTime=now() WHERE Student_Username='".$user."'";
							$query = mysql_query($sql);
								if($query){

									$_SESSION['user'] = $user;
									header("Location: index.php");							
								}
						}
				}else{
					echo "กรุณาตรวจสอบไอดีผู้ใช้ใหม่";
				}
		}
	}

	?>

<div class="container">

<form method="post" action="">
	<div class="header">

	<h1>เข้าสู่ระบบ</h1>
	<span>เพื่อลงทะเบียนกิจกรรมต่างๆของมหาวิทยาลัยเอเชียอาคเนย์</span>
	</div>

	<div class="content">
	

		<input type="text" id="user" name="user" class="input username" placeholder="รหัสนักศึกษา"/>
   		<div class="user-icon"></div>
		
	
		<input type="password" id="pass" name="pass" class="input password" placeholder="รหัสบัตรประชาชน"/>
		<div class="pass-icon"></div><br>
		</div>

   		 <div class="footer">
   		 <input type="submit" name="send" class="btn btn-default" value="เข้าสู่ระบบ..."/>
   	
</form>
   		
   		 
</body>
</html>