<?
include("../mysql.php");

$pass = $_GET['pass'];
$user = $_GET['user'];

echo $pass;
echo'<br>';

echo $user;
echo'<br>';

$sql_user = "SELECT * FROM user_authority
		WHERE	userid = '$user'";
$result = mysql_query($sql_user);
$row = mysql_fetch_array($result);

if($row['pass_ran'] == $pass)
	{ $sql = " UPDATE user_authority SET authority = '2'  WHERE userid = '$user' " ;
	  mysql_query($sql);}

if(mysql_query($sql)){
	  echo ' 二階激活成功!';
	  //echo' <meta http-equiv="refresh" content="2;url=../member/member_page.php"> ';
	}

else{echo '激活失敗QQQQ';
	 //echo' <meta http-equiv="refresh" content="2;url=../member/member_page.php">';
	 }



?>