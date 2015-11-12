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
  <title>Admin || Program Manage Activity</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

  <script type="text/javascript" src="jsp/jquery.min.js"></script>
  <script type="text/javascript" src="jsp/bootstrap.js"></script>
  <link rel="stylesheet" type="text/css" href="css/listInsert.css">

  <script type="text/javascript">
    $(document).ready(function () {
       $("#act").change(function () {
      
          	
          	 var id = $(this).val();

          	 console.log('Activity', id);

          	$.ajax({
			      url: "getActivity.php",
			      type: 'POST',
			      data: { activityId: id } //activityId ชื่อค่า : id value ค่า
			}).done(function(result) {
			   activity = (JSON.parse(result));
         $("#room").val("");
			   $("#activity_name").html(activity.Activity_Name);
			   $("#activity_quan").val(activity.Activity_Quantity);
			   $('#activity_hour').val(activity.Activity_Hour);
			   $("#activity_date").val(activity.Activity_Date);
			   $('#startActivity').val(activity.Activity_StartTime);
         $('#endActivity').val(activity.Activity_StartTime);

         console.log(activity.Activity_Hour + activity.Activity_StartTime)

        var hour = parseInt($('#endActivity').val()) + parseInt($('#activity_hour').val())
        $('#endActivity').val(hour);

			}).error(function(){
				console.log("ERROR");
			});

			
        });
    });
</script>


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
          if (isset($_GET['u']) == 'home') {
          
              echo "<li class='active'>";
            }else{
              echo "<li>";
          }?>

            <a href="Home.php">หน้าแรก</a>
          </li>
            

          <?php if($_SESSION['status'] == "Admin"){ ?>

            <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
          aria-expanded="false">Program Admin <span class="caret"></span></a>  

                  <ul class="dropdown-menu">

          
              <li><a href="actList.php">ลงกิจกรรม</a></li>

                      <li><a href="manageActivity.php">จัดการเวลาให้ตรงกับห้อง</a></li>

                      <li><a href="Home.php">ออกใบรายงาน</a></li>
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
          <a href="Home.php?u=personal">ประวัติส่วนตัว</a></li>

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
          <a href="Home.php?u=register">ลงทะเบียนเข้ากิจกรรม</a></li>

        <?}?>

            <li><a href="logout.php">ออกจากระบบ</a></li>


        
        </ul>
      </nav>
</div>

<!-- โค๊ดเมนู nav -->



<div class="container">

  <form method="post" action="manage.php" class="basic-grey">
      <?php
        include("connect.php");
      	// $sql = mysql_query("SELECT * FROM Activity WHERE Activity_ID");
      	// $reuslt = mysql_fetch_assoc($sql);
        $sql = "SELECT * from Activity";
        $query = mysql_query($sql)or die ("Error in query: . ".mysql_error());; //query ข้อมูล
      ?>

      <!-- <h1 id="activity_name" value="">กิจกรรม</h1> -->
      <h1> จัดการกิจกรรมให้ตรงห้องต่างๆ</h1>
        <select name='activity' id="act" >;
        <option value=''><--กรุณาเลือกกิจกรรม--></option>";

        <?php 
          while($row = mysql_fetch_assoc($query)){
      	  echo "<option value='" . $row['Activity_ID'] . "'>" . $row['Activity_Name'] . "</option>";
        }?>

        </select>

        <label>จำนวนที่เปิดรับ</label><input type="text" value="" name="activity_quan" id="activity_quan"/><br>
        <label>จำนวนชั่วโมงกิจกรรม</label><input type="text" value="" name="activity_hour" id="activity_hour" /><br>
        <label​>ห้องจัดกิจกรรม</label​><br>

           <select name="room" id="room"><option value=''><--กรุณาเลือกห้อง--></option>;
              <?php
                $sql = "SELECT * from Room";
                $query = mysql_query($sql)or die ("Error in query: . ".mysql_error());; //query ข้อมูล
              ?>

              <?php while($row = mysql_fetch_assoc($query)){
   	              echo "<option value='" . $row['Room_ID'] . "'>" .$row['room_name'] ."</option>";
              }?>
            </select><br>
        <label>วันที่จัดกิจกรรม</label><input type="date" value="" name="activity_date" id="activity_date"/><br><br>
        <label>เริ่มจัดกิจกรรม</label>

           <select name="startActivity" id="startActivity">
           <option value=''><-เริ่ม-></option>

               <?php
                  $sql = "SELECT * from Time";
                  $query = mysql_query($sql)or die ("Error in query: . ".mysql_error());; //query ข้อมูล
                  while($row = mysql_fetch_assoc($query)){
                        echo "<option value='" . $row['Time_ID'] . "'>" .$row['Time_Name'] ."</option>";
                }?>

           </select> 

        <label>ถึง</label>
            <select name="endActivity" id="endActivity">
            <option value=''><-จบ-></option>

                <?php
                    $sql = "SELECT * from Time";
                    $query = mysql_query($sql)or die ("Error in query: . ".mysql_error());; //query ข้อมูล
                    while($row = mysql_fetch_assoc($query)){
                         echo "<option value='" . $row['Time_ID'] . "'>" .$row['Time_Name'] ."</option>";
                }?>

            </select><br>
       <input type="submit" name="send" class="btn btn-success"value="ยืนยัน">  <input type="reset" class="btn btn-danger" value="คืนค่า">
</form>
</body>
</html>
