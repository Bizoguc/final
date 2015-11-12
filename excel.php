


<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=tis620" />
<title>import Excel to Sql</title>
</head>
<body>
<?php

iconv_set_encoding("internal_encoding", "UTF-8");


// move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV

include("connect.php");

$objCSV = fopen($_FILES["fileCSV"]["tmp_name"], "r");

 
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
 

 $strSQL = "INSERT INTO Student ";
 $strSQL .="(Student_Username,Student_Password,Student_Name,Student_Lastname,Student_Email,Student_Tel,Class_ID) ";
 $strSQL .="VALUES ";
	$strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."' ";
	$strSQL .=",'".$objArr[3]."','".$objArr[4]."','".$objArr[5]."','".$objArr[6]."') ";
	$objQuery = mysql_query($strSQL);
	// mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
	mysql_query("SET NAMES 'utf8'");
}
fclose($objCSV);

echo "Upload & Import Done.";
?>
</table>
</body>
</html>
