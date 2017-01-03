<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/backend.css" type="text/css">
<title>login_backend</title>
</head>
<body>
<div class="leftBlock">
<?php
	include("../mysql.php");
	$userid = $_POST['username'];
	$password = $_POST['password'];
	
	//$userpw_code = md5($password);
	
	$sql = "SELECT * FROM  user
			WHERE	username = '$userid'";
	$result = mysql_query($sql);
	$row = @mysql_fetch_array($result);
	
	if($row['username'] == $userid && $row['password'] == $password)
	{
		$_SESSION['user'] = $userid;
		
		echo $_SESSION['user'] . '登入成功! 將自動跳轉回首頁!';
  		echo '<meta http-equiv="refresh" content="1;url=../index.php">';     
	}else
	{
		echo "登入失敗!";
		echo '<meta http-equiv="refresh" content="2;url=login.php">';
	}
	
?>
</div>
</body>
