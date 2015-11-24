<?php
session_start();
ob_start();


if ($_SESSION['status'] == 'User') {
    header("Location: index.php");
    exit;
} else if ($_SESSION['status'] == null) {
    header("Location: login.php");
    exit;
}

?>


<?php
include("connect.php");
if (isset($_POST['send']) != null) {
    
    $room  = $_POST['room'];
    $start = $_POST['startActivity'];
    $end   = $_POST['endActivity'];
    $date  = $_POST['activity_date'];
    
    if ($room == null || $start == null || $end == null) {
        echo "กรุณากรอกข้อมูล";
        
    } else if($start>$end || $start==$end){
    	echo "กรอกใหม่"."<br>";
        var_dump($date, $room, $start, $end);
        }else{
        var_dump($date, $room, $start, $end);
        

  
        $showTimes = mysql_query("SELECT * FROM  Showtime where DateShowtime ='" . $date . "' And Room_ID ='" . $room . "'");

        echo '<hr>';

        if ($showTimes) {
             
            // check start time of activity     
            while ($showTime = mysql_fetch_array($showTimes)) {
                   // if ($start >= $showTime['StartTimeID'] && $start < $showTime['EndTimeID']) {
                  
                if ($start >= $showTime['StartTimeID'] && $start <= $showTime['EndTimeID']) {
                    echo 'start Room busy';
                    exit();
                } 
                    // if ($end > $showTime['StartTimeID'] && $end <= $showTime['EndTimeID']) {
                
                if ($end >= $showTime['StartTimeID'] && $end <= $showTime['EndTimeID']) {
                    echo 'end Room busy';
                    exit();
                } 

                 if ($start < $showTime['StartTimeID'] && $end > $showTime['EndTimeID']) {
                    echo 'test Room busy';
                    exit();
                } 

                // if ($start == $showTime['StartTimeID'] && $end == $showTime['EndTimeID']) {
                //     echo 'Room busy';
                //     exit();
                // } 

                
            }
 

        }  


           
            
            
            $RegisDate = new DateTime();
            mysql_query("SET NAMES 'utf8'");
            
            $result = mysql_query("INSERT INTO Showtime(Activity_ID,Room_ID,StartTimeID,EndTimeID,DateShowtime,Hour,Quantity,createdOn,Student_User)
				values('" . $_POST["activity"] . "','" . $_POST["room"] . "','" . $_POST["startActivity"] . "','" . $_POST["endActivity"] . "','" . $_POST["activity_date"] . "',
					   '" . $_POST["activity_hour"] . "','" . $_POST["activity_quan"] . "','" . $RegisDate->format('Y-m-d H:i:s') . "','" . $_SESSION["user"] . "')") or die(mysql_error());
            ;
            
            mysql_close($conn);

             echo "บันทึกเรียบร้อย";
        //}
    }
}
?>