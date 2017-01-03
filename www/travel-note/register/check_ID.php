<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check ID</title>
</head>

<body>


<?php
include("../connect_db.php");

$q = $_GET["q"];

$sql = "SELECT * from user WHERE userid = '$q'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
echo $row['userid'];
}

mysql_close();
?>

</body>
