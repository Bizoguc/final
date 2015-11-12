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
	<link rel="stylesheet" type="text/css" href="css/listInsert.css">
<title></title>
</head>

<body>

<!-- โค๊ดเมนู nav -->
<div class="container">
      <nav class="navbar navbar-default">
        <a class="navbar-brand" href="#">Southeast Asia University</a>
        <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
       
     <li>
            <a href="Home.php">หน้าแรก</a>
          </li>
            

          <?php if($_SESSION['status'] == "Admin"){ ?>

            <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Program Admin <span class="caret"></span></a>  

                  <ul class="dropdown-menu">

          
              <li><a href="actList.php">โปรแกรมลงกิจกรรม</a></li>

                      <li><a href="manageActivity.php">โปรแกรมจัดการเวลากิจกรรม</a></li>

                      <li><a href="Home.php">ออกรายงาน</a></li>
                  </ul>
                </li>
        

          <? }else{?>
         
         <li class='active'><a href="Home.php?u=personal">ประวัติส่วนตัว</a></li>
		 <li><a href="Home.php?u=register">โปรแกรมลงกิจกรรม</a></li>

        <?}?>

            <li><a href="logout.php">Logout</a></li>


        
        </ul>
      </nav>
</div>

<!-- โค๊ดเมนู nav -->
<div class="container">

<?php
	include("connect.php");


$sql = mysql_query("SELECT * FROM Activity INNER JOIN Type ON Activity.Type_ID = Type.Type_ID WHERE Activity_ID='".$_GET["u"]."' ");
$row = mysql_fetch_assoc($sql);
	//var_dump($row);
	

?>


	<form action="ActUpdate.php?u=<?=$row["Activity_ID"]?>" method="post" class="basic-grey">

		<h1>ใบกิจกรรม<span>แก้ไขรายละเอียดกิจกรรมมหาวิทยาลัยเอเชียอาคเนย์</span></h1>

		<label>ชื่อกิจกรรม:</label><input name="Name" type="text" id="Name" maxlength="60" 
		value="<?=$row['Activity_Name']?>"/><br>
		
		<label>รายละเอียดกิจกรรม:</label><textarea name="Detail" row="5" cols="50" 
		value="<?=$row['Activity_Detail']?>"></textarea><br>
		
		<label>วันที่:</label><input name="Date" type="date" id="Date" 
		value="<?=$row['Activity_Date']?>"/><br><br>
		
	
		<label>ชั่วโมง:</label><input name="Hour" type="text"  id="Hour" 
		value="<?=$row['Activity_Hour']?>"/><br>

		<label>จำนวนที่รับ:</label><input name="Quan" type="text" id="Quan" 
		value="<?=$row['Activity_Quantity']?>"/><br>


		<label>ประเภทกิจกรรม:</label>   
				<select name="typeActivity" id="typeActivity">
				 <option value='<?=$row['Type_ID']?>'><?echo$row['Type_Name']?>(ข้อมูลเดิม)</option>
			        <?php

			        $sql = "SELECT * from Type";
			        $query = mysql_query($sql)or die ("Error in query: . ".mysql_error()); //query ข้อมูล
			        
			          while($row = mysql_fetch_assoc($query)){
			          echo "<option value='" . $row['Type_ID'] . "'>" .$row['Type_Name'] ."</option>";
			        }?>
  				 </select>

		<label>เริ่มจัดกิจกรรม</label>
			<select name="startActivity" id="startActivity">
			 <option value=''>-กรุณาเลือกเวลาเริ่มกิจกรรมใหม่-</option>
			    <?php
			        $sql = "SELECT * from Time";
			        $query = mysql_query($sql)or die ("Error in query: . ".mysql_error());; //query ข้อมูล
			        	
			          while($row = mysql_fetch_assoc($query)){
			          echo "<option value='" . $row['Time_ID'] . "'>" .$row['Time_Name'] ."</option>";
			        }?>
  				 </select> 
		

  		<label>จัดเฉพาะคณะ</label>
  				<select name="facultyActivity" id="facultyActivity">
  					<option value=''>-กรุณาเลือกคณะใหม่-</option>
  						<?php
  							$sql="SELECT * FROM Faculty";
  							$query= mysql_query($sql) or die("Error in query: . ".mysql_error());
  								while ($row = mysql_fetch_assoc($query)) {
  									echo "<option value='". $row['Faculty_ID'] ."'>" .$row['Faculty_Name']."</option>";
  								}

  						?>
  				</select>

  				 <br>
		<span><input type="Submit" value="ยืนยัน" class="btn btn-success"/> <input type="Reset" value="คืนค่า" class="btn btn-danger" /></span>
	</form>
	</div>





</body>