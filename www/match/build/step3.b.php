<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>step3.b.php</title>
</head>

<body>
<?php	

		setcookie("description",$_POST["description"],time()+3600);	//描述
		
		if(isset($_POST['hide']))
		{
			setcookie("hide","*",time()+3600);
		}
		else
		{
			setcookie("hide","",time()+3600);
		}		
				
		echo '<meta http-equiv="refresh" content="0;url=invite.php">'; 
?>
</body>
</html>