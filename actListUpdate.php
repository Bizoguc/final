<?php
 require 'checkAdminLogin.php';
?>



<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<title> Edit : Activity</title>

		<script type="text/javascript">
			<? require('checkValidateTextbox.js') ?>
		</script>
	</head>


	<body>
		<?php include('css/nav.css');?>

			<?php
			 	$id = $_GET['id'];
				include("connect.php");
				$result = $conn->query("SELECT * FROM Activity INNER JOIN Faculty ON Activity.Faculty_ID = Faculty.Faculty_ID INNER JOIN Type ON Activity.Type_ID = Type.Type_ID WHERE Activity_ID='".$_GET["id"]."' ");
				$row = $result->fetch_assoc();
				//var_dump($row);
			?>

			
   			   <div class="container">
     			   <div class="col-md-4">
      				    <div class="panel panel-default">
        				    <div class="panel-heading">
             				  <h4>กิจกรรม</h4><small>แก้ไขรายละเอียดกิจกรรมมหาวิทยาลัยเอเชียอาคเนย์</small>
            				</div>

            				 <div class="panel-body">

								<form action="ActUpdate.php?u=<?=$row["Activity_ID"]?>" method="post">

									<div class="form-group">
										<label>ชื่อกิจกรรม:</label>
										<input class="form-control" name="Name" type="text" id="Name" maxlength="60" value="<?=$row['Activity_Name']?>">
									</div>	

									<div class="form-group">
										<label>รายละเอียดกิจกรรม:</label>
										<textarea class="form-control" name="Detail" id="Detail" row="5" maxlength="80" cols="50"><?=$row['Activity_Detail']?></textarea>
									</div>

									<div class="form-group">	
										<label>วันที่:</label>
										<input class="form-control" name="Date" type="date" id="Date" value="<?=$row['Activity_Date']?>"/>
									</div>	
									
									<div class="form-group">
										<label>ชั่วโมงที่ร่วมกิจกรรม:</label>
										<!-- <input class="form-control" name="Hour" type="text"  id="Hour" value="<?=$row['Activity_Hour']?>"/> -->
											<select class="form-control" name="Hour" id="Hour">
												<option value="<?=$row['Activity_Hour']?>"><?=$row['Activity_Hour']?>ชั่วโมง (ข้อมูลเก่า)</option>
												<option value="1">1 ชั่วโมง</option>
												<option value="2">2 ชั่วโมง</option>
												<option value="3">3 ชั่วโมง</option>
												<option value="4">4 ชั่วโมง</option>
												<option value="4">5 ชั่วโมง</option>
												

											</select>
									</div>

									<div class="form-group">
										<label>จำนวนที่รับ:</label>
										<input class="form-control" name="Quan" maxlenght="2" type="number" id="Quan" value="<?=$row['Activity_Quantity']?>"/>
									</div>

									<div class="form-group">
										<label>ประเภทกิจกรรม:</label>   
												<select class="form-control" name="typeActivity" id="typeActivity">
												 <option value='<?=$row['Type_ID']?>'><?echo$row['Type_Name']?> (ข้อมูลเก่า)</option>
											        <?php

											        $sql = "SELECT * from Type";
											        $query = $conn->query($sql)or printf("ERROR : %s\n",$conn->error); //query ข้อมูล
											        
											          while($rowType = $query->fetch_assoc()){
											          echo "<option value='" . $rowType['Type_ID'] . "'>" .$rowType['Type_Name'] ."</option>";
											        }?>
								  				 </select>
								  	</div>

								  	<div class="form-group">
										<label>เริ่มจัดกิจกรรม</label>
										  <select class="form-control" name="startActivity" id="startActivity">
											     <option value='<?=$row['Activity_StartTime']?>'><?=$row['Activity_StartTime']?>.00 (ข้อมูลเก่า)</option>
										
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
								  		<label>จัดเฉพาะคณะ</label>
								  				<select class="form-control" name="facultyActivity" id="facultyActivity">
								  					<option value="<?=$row['Faculty_ID']?>"><?echo$row['Faculty_Name']?> (ข้อมูลเก่า)</option>
								  						<?php
								  							$sql="SELECT * FROM Faculty";
								  							$query= $conn->query($sql) or printf("Error in query: %s\n",$conn->error);
								  								while ($rowFaculty = $query->fetch_assoc()) {

								  						?>
								  								<option value="<?=$rowFaculty['Faculty_ID']?>"><?=$rowFaculty['Faculty_Name']?></option>;
								  						<?php } ?>
								  				</select>
								  	</div>
							  		

									<input type="Submit" id="sendActivity" value="ยืนยัน" class="btn btn-success"/> <input type="Reset" value="คืนค่า" class="btn btn-danger">
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
		
<? $conn->close() ?>
</body>