<?php
include("../mysql.php");

$q = $_GET["q"];

$sql = "SELECT * from user WHERE username = '$q'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
echo $row['username'];
}

mysql_close();
?>