<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>step1.b.php</title>
</head>

<body>
<?php	
		setcookie("groupname",$_POST["groupname"],time()+3600);	//團名
		
		setcookie("date",$_POST["date"],time()+3600);	//日期
		
		setcookie("time",$_POST["time"],time()+3600);	//時間
				
		setcookie("location",$_POST["location"],time()+3600);	//地點
		
		echo $_POST['location'];
		
		$type = implode(",",$_POST["type"]);
		setcookie("type",$type,time()+3600);	//類型
				
		echo '<meta http-equiv="refresh" content="0;url=step2.php">';
?>		
</body>
</html>