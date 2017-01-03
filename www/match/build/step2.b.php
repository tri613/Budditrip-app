<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>hold2.b.php</title>
</head>

<body>
<?php
		if($_POST["gender"]!=null)
		{
			setcookie("gender",$_POST["gender"],time()+3600);
		}
		else
		{
			setcookie("gender","均可",time()+3600);
		}
		
		//record age min
		if($_POST["age_min"]!=null)
		{
			setcookie("age_min",$_POST["age_min"],time()+3600);
		}
		else
		{
			setcookie("age_min","0",time()+3600);
		}
		
		//record old max
		if($_POST["age_max"]!=null)
		{
			setcookie("age_max",$_POST["age_max"],time()+3600);
		}
		else
		{
			setcookie("age_max","100",time()+3600);
		}
		
		//reocord number min
		if($_POST["number_min"]!=null)
		{
			setcookie("number_min",$_POST["number_min"],time()+3600);
		}
		else
		{
			setcookie("number_min","0",time()+3600);
		}
		
		//record number max
		if($_POST["number_max"]!=null)
		{
			setcookie("number_max",$_POST["number_max"],time()+3600);
		}
		else
		{
			setcookie("number_max","1000",time()+3600);
		}
		
		//record budget min
		if($_POST["budget_min"]!=null)
		{
			setcookie("budget_min",$_POST["budget_min"],time()+3600);
		}
		else
		{
			setcookie("budget_min","0",time()+3600);
		}
		
		//record budget max
		if($_POST["budget_max"]!=null)
		{
			setcookie("budget_max",$_POST["budget_max"],time()+3600);
		}
		else
		{
			setcookie("budget_max","10000",time()+3600);
		}
		
		echo '<meta http-equiv="refresh" content="0;url=step3.php">';
?>
</body>
</html>