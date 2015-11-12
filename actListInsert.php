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









<!-- โค๊ดเมนู nav -->
<div class="container">
<?php
	include("connect.php");




?>

	<div class="tab-content">
	<div class="tab-pane fade active in" id="basic-grey-demo">
	<form action="ActInsert.php" method="post" class="basic-grey">
		<h1>ใบกิจกรรม<span>ลงรายละเอียดกิจกรรมมหาวิทยาลัยเอเชียอาคเนย์</span></h1>
		<p><label>ชื่อกิจกรรม:</label><input name="Name" type="text" id="Name" maxlength="60" 
			/><br>
		<label>รายละเอียดกิจกรรม:</label><textarea name="Detail" row="5" cols="50"></textarea><br></p>
		<label>วันที่:</label><input name="Date" type="date" id="Date" value=""/><br><br>
		 <label>เริ่มจัดกิจกรรม</label>
			   <select name="startActivity" id="startActivity">
			   <option value=''>-เริ่ม-</option>
			        <?php

			        $sql = "SELECT * from Time";
			        $query = mysql_query($sql)or die ("Error in query: . ".mysql_error());; //query ข้อมูล
			        
			          while($row = mysql_fetch_assoc($query)){
			          echo "<option value='" . $row['Time_ID'] . "'>" .$row['Time_Name'] ."</option>";
			        }?>

   </select> 
		<label>ชั่วโมง:</label><input name="Hour" type="text" id="Hour"/><br>
		<label>จำนวนที่รับ:</label><input name="Quan" type="text" id="Quan" /><br>
		
    <label>จัดให้คณะ</label>
    <select name="facultyActivity" id="facultyActivity">
      <option value=''>-คณะ-</option>
      <?php
        $sql = "SELECT * FROM Faculty";
        $query = mysql_query($sql);
          while($row=mysql_fetch_assoc($query)){
            echo "<option value='" . $row['Faculty_ID'] . "'>" .$row['Faculty_Name'] ."</option>";
          }
      ?>
    </select>

			<label>ประเภทกิจกรรม:</label>   
				<select name="typeActivity" id="typeActivity">
			    <option value=''>-ประเภท-</option>
			        <?php

			        $sql = "SELECT * from Type";
			        $query = mysql_query($sql)or die ("Error in query: . ".mysql_error());; //query ข้อมูล
			        
			          while($row = mysql_fetch_assoc($query)){
			          echo "<option value='" . $row['Type_ID'] . "'>" .$row['Type_Name'] ."</option>";
			        }?>
  				 </select><br>

		<span><input type="Submit" value="ลงกิจกรรม" class="btn btn-success"/> <input type="Reset" value="คืนค่า" class="btn btn-danger" /></span>
	</form>
	</div>
</body>