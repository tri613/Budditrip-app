<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<?php session_start();

include( "../mysql.php" );

if (isset($_SESSION['user'])){
	
	$userid = $_SESSION['user'];
	
	}
else {
	echo "nothing";
	}

$no2 = $_GET['no2'];

$userid = $_SESSION['user'];

$name = $_POST["note_name"];
$buddy = $_POST["note_buddy"];
$cost = $_POST["cost"];
$theme = $_POST["note_cate"];
$content = $_POST["editor"];

$datefrom = mysql_real_escape_string($_POST['datefrom']);
$dateto = mysql_real_escape_string($_POST['dateto']);

$date1 = date('y-m-d', strtotime($datefrom));
$date2 = date('y-m-d', strtotime($dateto));

$updateSQL ="Update travelnote Set note_name='$name', datefrom='$date1', dateto='$date2', note_buddy='$buddy', cost='$cost', note_cate='$theme', note_content='$content' WHERE note_no = '$no2'";

$Result = mysql_query($updateSQL)or die(mysql_error());

$url = "backstage.php";

echo "<script>alert('修改成功! 請等待頁面跳轉')</script>";
echo "<script>window.location.href='$url'</script>";

?>