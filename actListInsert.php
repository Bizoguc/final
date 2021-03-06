<?php
 require 'checkAdminLogin.php';
?>


<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add | Activity</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">  
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>


  
    <script type="text/javascript">
        <?php 
            require('js/activeNav.js');
            require('js/checkValidateTextbox.js')
        ?>


      </script>

  </head>

<body>
    
  <?php
    include("css/nav.css");
  	include("connect.php");

   
  ?>

    <div class="container-fluid">
      <div class="container">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
               <h4>กิจกรรม</h4><small>ลงรายละเอียดกิจกรรมมหาวิทยาลัยเอเชียอาคเนย์</small>
            </div>
                  
              <div class="panel-body">
        	       
                  <form action="ActInsert.php" method="post" >

                    <div class="form-group">
                		   <label>ชื่อกิจกรรม</label>
                       <input class="form-control" name="Name" type="text" id="Name" placeholder="กิจกรรม" maxlength="40">       
                    </div>

                    <div class="form-group">
                		  <label>รายละเอียดกิจกรรม</label>
                      <textarea class="form-control" name="Detail" id="Detail" row="5" cols="50" placeholder="รายละเอียด" maxlength="80"></textarea>
                    </div>
                		
                    <div class="form-group">
                      <label>วันที่</label>
                      <input class="form-control" name="Date" type="date" id="Date" value="">
                		</div>

                     <div class="form-group">
                      <label>เริ่มจัดกิจกรรม</label><!-- <input type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" id="Time" name="Time" />  -->
                  			 <select  class="form-control" name="startActivity" id="startActivity">
                  		   <option value=>-เริ่ม-</option>
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
                		
                    <div class="form-group">
                		  <label>ระยะเวลากิจกรรม </label>
                       <select  class="form-control" name="Hour" id="Hour">
                         <option value=>-ชั่วโมง-</option>
                               <option value='1'>1 ชั่วโมง</option>
                               <option value='2'>2 ชั่วโมง</option>
                               <option value='3'>3 ชั่วโมง</option>
                               <option value='4'>4 ชั่วโมง</option>
                               <option value='5'>5 ชั่วโมง</option>
                           </select> 
                    </div>

                    <div class="form-group">
                		  <label>จำนวนที่รับ</label>
                      <input type="number"  maxlenght="2" class="form-control" name="Quan" id="Quan" placeholder="เปิดรับ">
                		</div>

                    <div class="form-group">
                      <label>จัดให้คณะ</label>
                        <select class="form-control" name="facultyActivity" id="facultyActivity">
                             <option value=''>-คณะ-</option>
                            <?php
                              $sql = "SELECT * FROM Faculty";
                              $query = $conn->query($sql) or printf("Error in query: %s\n",$conn->error);
                                while($row=$query->fetch_assoc()){
                                  echo "<option value='" . $row['Faculty_ID'] . "'>" .$row['Faculty_Name'] ."</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                			<label>ประเภทกิจกรรม</label>   
                				<select class="form-control" name="typeActivity" id="typeActivity">
                			    <option value=''>-ประเภท-</option>
                			        <?php

                			        $sql = "SELECT * from Type";
                			        $query = $conn->query($sql)or printf ("Error in query:  %s\n ",$conn->error); //query ข้อมูล
                			        
                			          while($row = $query->fetch_assoc()){
                			          echo "<option value='" . $row['Type_ID'] . "'>" .$row['Type_Name'] ."</option>";
                			        }?>
                  				 </select>
                    </div>

                    <div class="form-group">
                		  <input type="Submit" value="ลงกิจกรรม" id="sendActivity" class="btn btn-success"> 
                      <input type="Reset" value="คืนค่า" class="btn btn-danger">
                    </div>
                 </form>
             </div>
        </div>
      </div>

    <div class="col-md-8"> 
    <div class="panel panel-default">
     <div class="panel-heading"><h2>ประโยชน์ของกิจกรรม </h2></div>
        <div class="panel-body">
          <p>1. เพื่อพัฒนาด้านสุขภาพ (Health Development)
              <p>&nbsp;&nbsp;&nbsp;&nbsp;- ทำให้ร่างกายมีการเคลื่อนไหว ซึ่งถือเป็นการออกกำลังกายอย่างหนึ่ง</p>

             2. เพื่อพัฒนาด้านมนุษยสัมพันธ์ (Human Relationship)
              <p>&nbsp;&nbsp;&nbsp;&nbsp;- ก่อให้เกิดความสามัคคี รักใคร่กลมเกลียวกันในหมู่คณะส่งเสริมมนุษยสัมพันธ์และการทำงานเป็นทีม</p>
            3. เพื่อพัฒนาการเป็นพลเมืองดี (Civic Development)
              <p>&nbsp;&nbsp;&nbsp;&nbsp;- ส่งเสริมความเป็นพลเมืองดี ลดปัญหาการประพฤติผิดศีลธรรม หรือปัญหาอาชญากรรม โดยใช้เวลาให้เกิดประโยชน์ </p>
            4. เพื่อพัฒนาตนเอง (Self Development)
              <p>&nbsp;&nbsp;&nbsp;&nbsp;- ประโยชน์ต่อตนเอง ทำให้มีสุขภาพดีทั้งกายและใจ พักผ่อนคลายความตึงเครียด </p>


          </p>
      </div>

    </div>
  </div>

</div>
</div>





</body>


</html>
       