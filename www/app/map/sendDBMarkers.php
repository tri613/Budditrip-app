<?php

include("../mysql.php");

$DBmarkers = array();

$sql = "SELECT * FROM app_markers" ;
$result = mysql_query($sql);
$j=0;
while ($row = mysql_fetch_array($result)) {
		$DBmarkers[$j]	= array($row['K'],$row['B'],$row['marker_info']);
		$j=$j+1;
	};

//print_r($DBmarkers);

echo json_encode($DBmarkers);

?>