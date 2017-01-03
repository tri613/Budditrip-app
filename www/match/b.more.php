<?php session_start() ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Budditrip - 更多旅伴</title>
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
		
		echo '<h1>最新旅伴</h1>';
		
		$sql = "SELECT * FROM `user`
				ORDER BY id DESC
				LIMIT ".$w.",16";
		$result = mysql_query($sql);
		
		while($row = mysql_fetch_array($result))
		{
			$url = "/match/b.info.php?".$row['id'];
			$age = floor((time()-strtotime($row['birthday']))/31556926);
			
			echo '<a href="'.$url.'">'.$row['nickname']."</a><br>";
			echo $row['gender']."<br>";
			echo $age."<br>";
			echo $row['interest']."<br>";
			
			echo "<hr>";
		}
		
		$c = "SELECT COUNT(*) FROM `user`";
		
		$cc = mysql_query($c);
		
		$ccc = mysql_fetch_array($cc);
		
		$page = $ccc['COUNT(*)']/16;
		
		for($k=1;$k<=($page+1);$k++)
		{
			$_url = "/match/b.more.php?".$k;
			
			echo '<a href="'.$_url.'">'.$k.'&nbsp&nbsp&nbsp&nbsp</a>';
		}
		
		echo '<input type="button" value="回「旅伴配對」" onClick="GoBack()">';
?>
	<script>
	
		function GoBack()
		{
			document.location.href = "/match/buddy.php";
		}
	
	</script>
</body>
</html>