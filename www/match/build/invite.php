<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../css/content-4.css" type="text/css">    
<link rel="stylesheet" href="../../css/navigators-match.css" type="text/css">
<link rel="stylesheet" href="../../css/slider.css" type="text/css">
<title>Budditrip - 推薦</title>

</head>

<div class="header">

<div class="topNav">
<span class="topNavText"><a href="../../index.php">BuddiTrip</a></span>

<?php

include("../../mysql.php");

if(isset($_SESSION['user'])){
echo '<script>';
echo ' window.onload = function() {document.getElementById("loggedIn").style.display="";
								   document.getElementById("loggedIn-nav").style.display=""} ;';
echo ' </script> ';}

else{
echo '<script>';
echo ' window.onload = function() {document.getElementById("unloggedIn").style.display="";} ;';
echo ' </script> ';}
?>

<span id="unloggedIn" style="display:none" class="topButton">
<a href="../../register/register.php">註冊</a>    
<a href="../../login/login.php">登入</a>
</span>
<span id="loggedIn" style="display:none" class="topButton">
<a href="../../login/logout.php">登出</a>
<a href="../../member/member_page.php">會員中心</a>    
</span>
</div>

<div class="banner">
<div class="fadein">
<img src="../../homeimg/banner.png" />
</div>
</div>


<div class="nav">
<div class="nav_bg">
<ul>
<li><a href="../../about.php">關於我們</a></li>
<li><a href="../../travel-note/notehome.php">遊記分享</a></li>
<li><a href="step1.php">我要揪團</a></li>
<li><a href="../group.php">我要跟團</a></li>
<li><a href="../buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>

<body>
	        <div class="centerBlock">

<?php 
		include("../../mysql.php");
		
		@$sql ="INSERT INTO `group` (`username`, `groupname`, `date`, `time`, `location`, `type`,
			   						`gender`, `age_min`, `age_max`, `number_min`, `number_max`, `budget_min`, `budget_max`, `description`, `hide`)
			   VALUES('".$_SESSION['user']."','".$_COOKIE['groupname']."','".$_COOKIE['date']."',
					  '".$_COOKIE['time']."','".$_COOKIE['location']."','".$_COOKIE['type']."','".$_COOKIE['gender']."',
					  '".$_COOKIE['age_min']."','".$_COOKIE['age_max']."','".$_COOKIE['number_min']."','".$_COOKIE['number_max']."',
					  '".$_COOKIE['budget_min']."','".$_COOKIE['budget_max']."','".$_COOKIE['description']."','".$_COOKIE['hide']."')";
						
		$query = mysql_query($sql);
		
		$sql_member = "INSERT INTO `member` (`groupname`,`username`,`mark`)
				VALUES ('".$_COOKIE['groupname']."','".$_SESSION['user']."','*')";
				
		$query_member = mysql_query($sql_member);	//將發起人加入跟團名單內
		
		//----------------
		
		$__sql = "SELECT * FROM `user`
				  WHERE username != '".$_SESSION['user']."'";
		
		if($_COOKIE['gender'] == '均可')
		{
			$__sql.="AND gender IS NOT NULL";
		}
		else
		{
			$__sql.="AND gender = '".$_COOKIE['gender']."'";
		}
		
		//echo $__sql;
		
		if(!empty($_COOKIE['age_min']))
		{
			$date_max = date('Y') - $_COOKIE['age_min']."-".date('m')."-".date('d');
		}else
		{
			$date_max = (date('Y') - 0)."-".date('m')."-".date('d');
		}
				
		if(!empty($_COOKIE['age_max']))
		{
			$date_min = date('Y') - $_COOKIE['age_max']."-".date('m')."-".date('d');
		}else
		{
			$date_min = (date('Y') - 100)."-".date('m')."-".date('d');
		} 
		
		$__sql.=" AND birthday BETWEEN '$date_min' AND '$date_max'";
		
		//echo $__sql."<br>";
		
		//以上篩選完畢
		
		$__result = mysql_query($__sql);
		
		$total = 0;
		
		while($__row = mysql_fetch_array($__result))
		{
			$sql_a = "SELECT * FROM `click_group_sample`
					  WHERE username = '".$__row['username']."'";
			$sql_b = "SELECT * FROM `match_group_sample`
					  WHERE username = '".$__row['username']."'";
					  
			$result_a = mysql_query($sql_a);
			$result_b = mysql_query($sql_b);
			
			$a = mysql_fetch_array($result_a);
			$b = mysql_fetch_array($result_b);
			
			$under_1 = $a[1]+$a[2]+$a[3]+$a[4]+$b[1]+$b[2]+$b[3]+$b[4];
			
			if($under_1 != 0)
			{
				switch($_COOKIE['time'])
				{
					case '凌晨00-06';
						$__time = round(($a[1]+$b[1])/$under_1,2);
						break;
					case '上午06-12';
						$__time = round(($a[2]+$b[2])/$under_1,2);
						break;
					case '下午12-18';
						$__time = round(($a[3]+$b[3])/$under_1,2);
						break;
					case '夜晚18-24';
						$__time = round(($a[4]+$b[4])/$under_1,2);
						break;
					default;
						$__time = 1; 	//任何時間
						break;
				}
			}else
			{
				$__time = 0;	//沒有點擊和媒合記錄
			}
			
			$under_2 = $a[5]+$a[6]+$a[7]+$a[8]+$a[9]+$a[10]+$a[11]+$a[12]+$a[13]+$a[14]
					  +$a[15]+$a[16]+$a[17]+$a[18]+$a[19]+$a[20]+$a[21]+$a[22]+$a[23]+$a[24]
					  +$b[5]+$b[6]+$b[7]+$b[8]+$b[9]+$b[10]+$b[11]+$b[12]+$b[13]+$b[14]
					  +$b[15]+$b[16]+$b[17]+$b[18]+$b[19]+$b[20]+$b[21]+$b[22]+$b[23]+$b[24];
			
			$location = $_COOKIE['location'];
			
			if($under_2 != 0)
			{
				$__location = round(($a[$location]+$b[$location])/$under_2,2);
			}else
			{
				$__location = 0;
			}
			
			//echo $__time."<br>";
			//echo $__location."<br>";
			//echo "--------------------<br>";
			
			$point = $__time*2600 + $__location*3800;
			
			$data[$total]['username'] = $__row['username'];
			$data[$total]['point'] = $point;
			
			$total++;
		}
		
		
		
		//氣體排序法
		
		for($i=0;$i<$total;$i++)	//氣泡排序法
		{
			for($j=$i;$j<$total;$j++)
			{
				if($data[$j]['point']>$data[$i]['point'])
				{
					$temp_username = $data[$j]['username'];
					$data[$j]['username'] = $data[$i]['username'];
					$data[$i]['username'] = $temp_username;
						
					$temp_point = $data[$j]['point'];
					$data[$j]['point'] = $data[$i]['point'];
					$data[$i]['point'] = $temp_point;
				}
			}
		}
		
		echo '<form name="invite" method="post" action="invite.b.php">';
		
		if($_COOKIE['number_max'] != 1000)
		{
			for($z=0;$z<$_COOKIE['number_max'];$z++)//最終結果
			{
				$iii = "SELECT * FROM `user`
						  WHERE username = '".$data[$z]['username']."'";
				$jjj = mysql_query($iii);
				$kkk = mysql_fetch_array($jjj);		//三步驟
				
				echo '<input type="checkbox" name="invite[]" value="'.$kkk['username'].'">暱稱：'.$kkk['nickname'];
				echo '<br><br>';
			}
		}else
		{
			for($z=0;$z<5;$z++)
			{
				$iii = "SELECT * FROM `user`
						  WHERE username = '".$data[$z]['username']."'";
				$jjj = mysql_query($iii);
				$kkk = mysql_fetch_array($jjj);
				
				echo '<input type="checkbox" name="invite[]" value="'.$kkk['username'].'">暱稱：'.$kkk['nickname'];
				echo '<br><br>';
			}
		}
		
		echo '<input type="hidden" value="'.$_COOKIE['groupname'].'">';
		echo '<input type="submit" value="發送邀請"> &nbsp';
		echo '<input type="button" value="返回首頁" onClick="GoBack()">';
		echo '</form>';
?>
		<script>
			
		function GoBack()
		{
			window.location.href = "../../index.php";
		}
		
		</script>
		
		</div>
</body>
</html>