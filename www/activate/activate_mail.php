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
//echo $pass;

$sql = "UPDATE user_authority SET pass_ran = '$pass' WHERE userid = '$user' ";
mysql_query($sql);

if(!mysql_query($sql)){echo 'oops<br>';}

$sql_email = "SELECT * from user WHERE userid = '$user' ";
$result = mysql_query($sql_email);
while($row = mysql_fetch_array($result)){
$useremail = (string)$row['email'];
}

//寄信
require("../../phpMailer/class.phpmailer.php");
mb_internal_encoding('UTF-8');   

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; // turn on SMTP authentication
//這幾行是必須的

$mail->Username = "tri613@gmail.com";
$mail->Password = "613811226";
//這邊是你的gmail帳號和密碼

$mail->FromName = "BuddyTrip";
// 寄件者名稱(你自己要顯示的名稱)
$webmaster_email =  
//回覆信件至此信箱


$email= $useremail;
// 收件者信箱
$name= $user;
// 收件者的名稱or暱稱
$mail->From = $webmaster_email;


$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Squall.f");
//這不用改

$mail->WordWrap = 50;
//每50行斷一次行

//$mail->AddAttachment("/XXX.rar");
// 附加檔案可以用這種語法(記得把上一行的//去掉)

$mail->IsHTML(true); // send as HTML

$mail->Subject = "Activate mail from BuddyTrip"; 
// 信件標題
$mail->Body = 
' <a href="http://192.168.137.1:1337/project/activate/mail_activate_backend.php?user='. $user .'&pass='. $pass  . ' "> Click me to activate your account. </a> ' ;

//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
$mail->AltBody = ' http://192.168.137.1:1337/project/activate/mail_activate_backend.php?user='. $user .'&pass='. $pass .
'/n請至此連結進行驗證'; 
//信件內容(純文字版)

if(!$mail->Send()){
echo "寄信發生錯誤：" . $mail->ErrorInfo;
//如果有錯誤會印出原因
}
else{ 
echo "驗證信已發送成功，請至信箱收信!" ; 
echo' <meta http-equiv="refresh" content="1;url=http://localhost:1337/project/index.php"> ';
}

?>

</body>
</html>