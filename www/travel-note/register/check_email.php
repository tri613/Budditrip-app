<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check ID</title>
</head>

<body>


<?
include("../connect_db.php");

$e = $_GET["e"];

$sql = "SELECT * from user WHERE email = '$e'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	echo $row['email'];
}
mysql_close();
?>

</body>
