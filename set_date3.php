<?
 include("connecttest.php");
$dt=("INSERT INTO `test`.`tqlf_3` (`date_line`) VALUES ('".$_POST["dateline"]."');");
$date = mysql_query($dt);
var_dump($_POST["dateline"]);
if($date)
{
	echo "จัดเก็บเรียบร้อย";
}
else
{
echo "error"; 	
}

?>	
