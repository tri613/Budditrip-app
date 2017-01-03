<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>connect</title>
</head>

<body>
<?php

include ("../../mysql.php");

$userid = $_SESSION['user'];

$name = $_POST["note_name"];
$buddy = $_POST["note_buddy"];
$cost = $_POST["cost"];
$theme = implode(",",$_POST["note_cate"]);
$content = $_POST["editor"];
$area = $_POST["note_area"];

$datefrom = mysql_real_escape_string($_POST['datefrom']);
$dateto = mysql_real_escape_string($_POST['dateto']);

$date1 = date('y-m-d', strtotime($datefrom));
$date2 = date('y-m-d', strtotime($dateto));

$today = date("Y-m-d H:i:s");

$insertSQL ="INSERT INTO travelnote (userid, note_name, datefrom, dateto, time, note_buddy, cost, note_cate, note_content, note_area) VALUES ('$userid','$name','$date1', '$date2', '$today', '$buddy','$cost', '$theme', '$content', '$area')";
$result = mysql_query($insertSQL)or die(mysql_error());




$url = "../notehome.php";

echo "<script>alert('新增成功! 請等待頁面跳轉')</script>";
echo "<script>window.location.href='$url'</script>";

?>

</body>
</html>