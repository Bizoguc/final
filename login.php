<?php session_start(); ob_start();

?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/login.css">
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
					// var_dump($row);
					// exit();	
			if($num > 0){

				$query = "SELECT * FROM Login WHERE Student_Username = '".$user."' ";	
				$query = mysql_query($query);
				$num = mysql_num_rows($query);

						if($num > 0 ){
							// mysql_query("DELETE FROM Login WHERE unix_timestamp( ) - Logtime > 60 ");
							echo "มีการ Login ซ้ำ";
						}else{
							$sql = "INSERT INTO Login(Student_Username,Logtime) VALUES('".$user."',NOW())";
							$query = mysql_query($sql);
								if($query){

									$_SESSION['user'] = $user;
									header("Location: index.php");							
								}
						}
				}else{
					echo "ไม่มีชื่อผู้ใช้นี้";
				}
		}
	}

	?>

<div id="wrapper">

<form name="login-form" class="login-form" method="post" action="">
	<div class="header">

	<h1>เข้าสู่ระบบ</h1>
	<span>เพื่อลงทะเบียนกิจกรรมต่างๆของมหาวิทยาลัยเอเชียอาคเนย์</span>
	</div>
	<div class="content">
	

		<input type="text" id="user" name="user" class="input username" placeholder="รหัสนักศึกษา"/>
   		<div class="user-icon"></div>
		
	
		<input type="password" id="pass" name="pass" class="input password" placeholder="รหัสบัตรประชาชน"/>
		<div class="pass-icon"></div>		
		</div>

   		 <div class="footer">
   		 <input type="submit" name="send" class="button" value="เข้าสู่ระบบ..."/>
   	
   		 </form>
   		 </div>
   		 <div class="gradient"></div>
</body>
</html>