<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>connect</title>
</head>

<body>
<?php

include("../../mysql.php");

$name = $_POST["off_name"];
$area = $_POST["off_area"];
$cate = $_POST["off_cate"];
$content = $_POST["editor2"];
$content=str_replace(' ', '&nbsp', $content);

$date = mysql_real_escape_string($_POST['off_date']);

$date1 = date('y-m-d', strtotime($date));

$insertSQL ="INSERT INTO official (off_name, off_date, off_area, off_cate, off_content) VALUES ('$name','$date1', '$area', '$cate','$content')";
$Result = mysql_query($insertSQL)or die(mysql_error());


$url = "../notehome.php";

echo "<script>alert('新增成功! 請等待頁面跳轉')</script>";
echo "<script>window.location.href='$url'</script>";

?>

</body>
</html>