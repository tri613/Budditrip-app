<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/backend.css" type="text/css">
<title>Budditrip - 歡迎</title>
</head>

<body>
<div class="leftBlock">
<?php
	include("../mysql.php");
	
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	$mail = $_POST['email'];
	$nickname = $_POST['nickname'];

	//$userpw_code = md5($password);
	
	if($password != "")
	{
	$sql = "INSERT INTO user
			(username, password,email,nickname) VALUES				
			('$userid','$password','$mail','$nickname')";
	//$sql2 =	"INSERT INTO user_info(username) VALUES ('$userid')" ;
	$sql3 =	"INSERT INTO user_authority(username) VALUES ('$userid')" ;
	}

	//mysql_query($sql);
	//mysql_query($sql2);
	mysql_query($sql3);

	$_SESSION['user']=$userid;
	
	//新增驗證碼
	function Pass($i=8) { 
	    srand((double)microtime()*1000000); 
	    return strtoupper(substr(md5(uniqid(rand())),rand(0,32-$i),$i)); 
	} 
	$pass = Pass();
	//echo $pass;
	mysql_query(" UPDATE user_authority SET pass_ran = '$pass' WHERE username = '$userid' "); 
	
	
	
	//自動新增點擊記錄表
	$sql_click_buddy = "INSERT INTO click_buddy_sample VALUES 
						('$userid','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0')";
	mysql_query($sql_click_buddy);
	
	$sql_click_group = "INSERT INTO click_group_sample VALUES 
						('$userid','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0','0')";
	mysql_query($sql_click_group);
	
	//自動新增媒合記錄表
	$sql_match_buddy = "INSERT INTO match_buddy_sample VALUES 
						('$userid','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0')";
	mysql_query($sql_match_buddy);
	
	$sql_match_group = "INSERT INTO match_group_sample VALUES 
						('$userid','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0','0',
						'0','0','0','0','0','0','0','0','0','0','0')";
	mysql_query($sql_match_group);
	

//寄信
/*
$useremail = (string)$mail;

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
' <a href="http://192.168.137.1:1337/budditrip/activate/mail_activate_backend.php?user='. $userid .'&pass='. $pass  . ' "> Click me to activate your account. </a> ' ;
$mail->AltBody = ' http://192.168.137.1:1337/budditrip/activate/mail_activate_backend.php?user='. $userid .'&pass='. $pass .
'/n請至此連結進行驗證'; 
if(!$mail->Send()){
echo "寄信發生錯誤：" . $mail->ErrorInfo;
}
*/

if(mysql_query($sql)){
echo $_SESSION['user']."　";
echo "歡迎光臨Budditrip！驗證信已發送！進入首頁中，請稍後";
echo "<meta http-equiv=\"refresh\" content=\"2;url=../index.php\">";
}else{
echo "新增不成功ㄛ";
echo "<meta http-equiv=\"refresh\" content=\"2;url=../index.php\">";
}

?>
</div>
</body>