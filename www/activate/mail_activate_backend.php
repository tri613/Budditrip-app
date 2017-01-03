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
$sql = " UPDATE user_authority SET authority = '1'  WHERE userid = '$user' " ;

if($row['pass_ran'] == $pass)
	 {mysql_query($sql);}

if(mysql_query($sql)){
	  echo ' 一階激活成功!';
	  echo' <meta http-equiv="refresh" content="1;url=http://localhost:1337/project/index.php"> ';
	}

else{
	  echo '激活失敗QQQQ';
	  //echo' <meta http-equiv="refresh" content="5;url=../index.php">';
	 }



?>