<?php session_start() ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Budditrip - 更多跟團</title>
</head>

<body>
<?php
		include("../mysql.php");
		
		if($_SERVER['QUERY_STRING'])
		{
			$var = $_SERVER['QUERY_STRING'];
		}else
		{
			$var = 1;
		}

		$w = ( $var - 1 ) * 16 ;
		
		echo '<h1>最新跟團</h1>';
		
		$sql = "SELECT * FROM `group`
				ORDER BY id DESC
				LIMIT ".$w.",16";
		$result = mysql_query($sql);
		
		while($row = mysql_fetch_array($result))
		{
			$url = "/match/g.info.php?".$row['id'];
			
			echo '<a href="'.$url.'">'.$row['groupname']."</a><br>";
			echo $row['date']."<br>";
			echo $row['time']."<br>";
			echo $row['location']."<br>";
			echo $row['type']."<br>";
			
			echo "<hr>";
		}
		
		$c = "SELECT COUNT(*) FROM `group`";
		
		$cc = mysql_query($c);
		
		$ccc = mysql_fetch_array($cc);
		
		$page = $ccc['COUNT(*)']/16;
		
		for($k=1;$k<=($page+1);$k++)
		{
			$_url = "/match/g.more.php?".$k;
			
			echo '<a href="'.$_url.'">'.$k.'&nbsp&nbsp&nbsp&nbsp</a>';
		}
		
		echo '<input type="button" value="回「我要跟團」" onClick="GoBack()">';
?>
	<script>
	
		function GoBack()
		{
			document.location.href = "/match/group.php";
		}
	
	</script>
</body>
</html>