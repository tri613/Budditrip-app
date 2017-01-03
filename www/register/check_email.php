<?php
include("../mysql.php");

$e = $_GET["e"];

$sql = "SELECT * from user WHERE email = '$e'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	echo $row['email'];
}
mysql_close();
?>