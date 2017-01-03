<?php 	session_start();

include ("../mysql.php");

$username = $_SESSION['user'];

$friend = $_POST['friend'];


//friendship 的狀態分為三種:

//a:邀請對方中

//b:被對方邀請中

//c:互為好友

//雙方皆未曾發出邀請的話，資料庫內勢必沒有資料 所以要用INSERT INTO
$sql = "INSERT INTO `friendship`(`username`,`friend`,`friendship`)	
VALUES ('$username','$friend','a')";		//記錄使用者已發出邀請

mysql_query($sql);


$ans = "INSERT INTO `friendship`(`username`,`friend`,`friendship`)
VALUES ('$friend','$username','b')";		//記錄他方使用者收到邀請

mysql_query($ans);


header('Location: '.$_POST["url"].'');	//轉址
 exit;
?>
