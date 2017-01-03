<? session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-mail</title>
</head>

<body>
<?

include("../mysql.php");

if (isset($_SESSION['user'])){
	$user = $_SESSION['user'];
	}


function Pass($i=8) { 
	    srand((double)microtime()*1000000); 
	    return strtoupper(substr(md5(uniqid(rand())),rand(0,32-$i),$i)); 
	} 
	 
	//echo Pass()."<br>"; // 丟出8碼 
	//echo Pass(3)."<br>"; // 丟出3碼 
	//echo Pass(40); // 最大只有32碼 
	
$pass = Pass();
echo $pass;
echo ' <a href="mobile_activate_backend.php?user='.$user .'&pass='. $pass  . ' ">點我逆</a> ';
echo '<br>';
echo 'http://localhost/project/register/getrandom.php?user=' .$user .'&pass='. $pass ;

$sql = "UPDATE user_authority SET pass_ran = '$pass' WHERE userid = '$user' ";
mysql_query($sql);

if(mysql_query($sql)){echo 'yeahhhh';}
else {echo 'QQ' ;}

	
?>

</body>
</html>