<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Budditrip - 歡迎</title>
</head>

<body>
<?php
	include("../connect_db.php");
	
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	$mail = $_POST['email'];

	$userpw_code = md5($password);
	
	if($password != "")
	{
	$sql = "INSERT INTO user
			(userid, password,
			 email) VALUES				
			('$userid','$userpw_code','$mail')";
	$sql2 =	"INSERT INTO user_info(userid) VALUES ('$userid')" ;
	$sql3 =	"INSERT INTO user_authority(userid) VALUES ('$userid')" ;
	
	$_SESSION['user']=$userid;
	
	//新增驗證
	
	function Pass($i=8) { 
	    srand((double)microtime()*1000000); 
	    return strtoupper(substr(md5(uniqid(rand())),rand(0,32-$i),$i)); 
	} 
	$pass = Pass();
	mysql_query("UPDATE user_authority SET pass_ran = '$pass' WHERE userid = '$userid' "); 
	$useremail = (string)$mail;

	//寄信
/*
require("../../phpMailer/class.phpmailer.php");
mb_internal_encoding('UTF-8');   

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true; // turn on SMTP authentication

$mail->Username = "tri613@gmail.com";
$mail->Password = "613811226";

$mail->FromName = "BuddyTrip";
$webmaster_email =  

$email= $useremail;
$name= $userid;
$mail->From = $webmaster_email;


$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Squall.f");
$mail->WordWrap = 50;
$mail->IsHTML(true); // send as HTML

$mail->Subject = "Activate mail from BuddyTrip"; 
$mail->Body = 
' <a href="http://192.168.137.1:1337/project/activate/mail_activate_backend.php?user='. $userid .'&pass='. $pass  . ' "> Click me to activate your account. </a> ' ;
$mail->AltBody = ' http://192.168.137.1:1337/project/activate/mail_activate_backend.php?user='. $userid .'&pass='. $pass .
'/n請至此連結進行驗證'; 
if(!$mail->Send()){
echo "寄信發生錯誤：" . $mail->ErrorInfo;
}
*/

if(mysql_query($sql)&& mysql_query($sql2) && mysql_query($sql3)){
echo $_SESSION['user']."　";
	
echo "歡迎光臨Budditrip！驗證信已發送！進入首頁中，請稍後";
//echo "<meta http-equiv=\"refresh\" content=\"1;url=../index.php\">";
}
else{
echo "新增不成功ㄛ" ;}
}
?>
</body>