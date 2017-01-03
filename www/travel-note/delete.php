<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php session_start();

include( "../mysql.php" );


$no = $_GET['no'];
$url = "backstage.php";

$deleteSQL ="Delete From travelnote WHERE note_no = '$no'";
$result = mysql_query($deleteSQL)or die(mysql_error());

echo "<script>alert('刪除成功! 請等待頁面跳轉')</script>";
echo "<script>window.location.href='$url'</script>";



?>
