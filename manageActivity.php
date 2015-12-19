<?php require('checkAdminLogin.php');?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">  
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <title>Admin || Program Manage Activity</title>

  <script type="text/javascript">
    <?php require('js/manageActivity.js');?>

      $(document).ready(function(){
        $('#activity_quan').keyup(function(){
            if ($(this).val() >= 60){
              alert('สูงสุด 60 ที่นั่ง');
              $(this).val('60');
            }
          });
        });

  </script>
  
</head>

  <?php include('css/nav.css');?>

  <div class="container-fluid">
      <div class="container">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <!-- <h1 id="activity_name" value="">กิจกรรม</h1> -->
              <h4>ห้องกิจกรรม</h4> <small>เลือกกิจกรรมให้ตรงกับห้องที่ต้องการ</small>
            </div>

            <div class="panel-body">

            <form method="post" action="manage.php">
                <?php
                  include("connect.php");
                	// $sql = mysql_query("SELECT * FROM Activity WHERE Activity_ID");
                	// $reuslt = mysql_fetch_assoc($sql);
                  $sql = "SELECT * from Activity";
                  $query = $conn->query($sql)or printf ("Error in query:%s\n",$conn->error); //query ข้อมูล
                ?>

              <div class="form-group">
                <label>กิจกรรม:</label>
                <select class="form-control" name='activity' id="activity" >;
                  <option value=''>-กรุณาเลือกกิจกรรม-</option>";
                    <?php 
                      while($row = $query->fetch_assoc()){
                  	  echo "<option value='" . $row['Activity_ID'] . "'>" . $row['Activity_Name'] . "</option>";
                    }?>

                </select>
              </div>

              <div class="form-group">
                <label>จำนวนที่รับ</label>
                <input class="form-control" placeholder="เปิดรับ" type="text" value="" name="activity_quan" id="activity_quan"/>
              </div>
      
              <div class="form-group">
                <label>ห้องจัดกิจกรรม</label>
                   <select class="form-control" name="room" id="room"><option value=''><--กรุณาเลือกห้อง--></option>;
                      <?php
                        $sql = "SELECT * from Room";
                        $query = $conn->query($sql)or printf ("Error in query:  ",$conn->error); //query ข้อมูล
                      ?>

                      <?php while($row = $query->fetch_assoc()){
           	              echo "<option value='" . $row['Room_ID'] . "'>" .$row['room_name'] ."</option>";
                      }?>
                    </select>
              </div>

              <div class="form-group">
                <label>วันที่จัดกิจกรรม</label>
                <input class="form-control" type="date" value="" name="activity_date" id="activity_date"/>
              </div>

              <div class="form-group">
                <label>เริ่มจัดกิจกรรม</label>

                 <select class="form-control" name="startActivity" id="startActivity">
                  <option value=''>-เริ่ม-</option>
                     <option value='8'>08:00</option>
                     <option value='9'>09:00</option>
                     <option value='10'>10:00</option>
                     <option value='11'>11:00</option>
                     <option value='12'>12:00</option>
                     <option value='13'>13:00</option>
                     <option value='14'>14:00</option>
                     <option value='15'>15:00</option>
                     <option value='16'>16:00</option>
                     <option value='17'>17:00</option>
                
                 
                 </select> 

                <label>ถึง</label>
                   <select class="form-control" name="endActivity" id="endActivity">
                   <option value=''>-จบ-</option>
                    <option value='8'>08:00</option>
                     <option value='9'>09:00</option>
                     <option value='10'>10:00</option>
                     <option value='11'>11:00</option>
                     <option value='12'>12:00</option>
                     <option value='13'>13:00</option>
                     <option value='14'>14:00</option>
                     <option value='15'>15:00</option>
                     <option value='16'>16:00</option>
                     <option value='17'>17:00</option>
                     <option value='18'>18:00</option>
                  
                 </select>
                </div>
               <input type="submit" name="send" class="btn btn-success"value="ยืนยัน">  <input type="reset" class="btn btn-danger" value="คืนค่า">
        </form>

      </div>
    </div>
  </div>

              <div class="col-md-6"> 
              <div class="panel panel-default">
               <div class="panel-heading"><h3>ขั้นตอนการเพิ่มห้องกิจกรรม </h3></div>
                  <div class="panel-body">
                    <p>1.เลือกกิจกรรมที่ต้องการจัด</p>
                       
                    <p>2.กรอกข้อมูลให้ครบถ้วน</p>
                    <p>3.กดปุ่มยืนยัน</p>
                    
                    </p>
                  </div>
               </div>
            </div>
            </div>
</div>

<? $conn->close()?>
</body>
</html>
