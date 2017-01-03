<? session_start(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check if logined</title>
</head>

<body>

<? 
include("connect_db.php");

if (isset($_SESSION['user'])){
	$userid = $_SESSION['user'];
	}
else {echo "nothing" ;}

echo $userid;

$sql = "SELECT * FROM user_authority WHERE userid = '$userid' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$auth = $row['authority'];
echo "<br>";
echo "目前權限：".$auth;
echo "<br>";
if($auth == 0){echo"你還沒驗證";}
if($auth == 1){echo"一階驗證過了";}
if($auth == 2){echo"二階驗證過了";}
?>
<br>
<a href="index.php">TOP</a>

</body>
