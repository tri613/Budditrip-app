<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/content-5.css" type="text/css">    
<link rel="stylesheet" href="../css/navigators-match.css" type="text/css">
<link rel="stylesheet" href="../css/slider.css" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<title>Budditrip - 跟團</title>

<style type="text/css">

/*#header{
	text-align:center;
	font-family:"微軟正黑體";
	font-size:18px;
	background-color:#FF9;		
}

#column{
		font-family:"微軟正黑體";
	}
*/
</style>
</head>
<body>
<div class="header">
<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddiTrip</a></span>

<?php

include("../mysql.php");

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
<a href="../register/register.php">註冊</a>    
<a href="../login/login.php">登入</a>
</span>
<span id="loggedIn" style="display:none" class="topButton">
<a href="../login/logout.php">登出</a>
<a href="../member/member_page.php">會員中心</a>    
</span>
</div>

<div class="banner">
<div class="fadein">
<img src="../homeimg/banner.png" />
</div>
</div>

<div class="nav">
<div class="nav_bg">
<ul>
<li><a href="../about.php">關於我們</a></li>
<li><a href="../travel-note/notehome.php">遊記分享</a></li>
<li><a href="build/step1.php">我要揪團</a></li>
<li><a href="group.php">我要跟團</a></li>
<li><a href="buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>
<br />
<br />
<br />
<br />

        <div class="centerBlock">

		<form id="_match" name="_match" action="g.result.php" method="post">
        	<h3>搜索您喜歡的旅行團</h3>
            
            日期：
            <input type="date" id="date_1" name="date_1">&nbsp;&nbsp;至&nbsp;&nbsp;<input type="date" id="date_2" name="date_2">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            時間：
            <select id="time" name="time">
            	<optgroup label="整天">
                	<option value="任何時間" selected>任何時間</option>
                </optgroup>
                
                <optgroup label="區間">
                	<option value="凌晨00-06">凌晨00-06</option>
                    <option value="上午06-12">上午06-12</option>
                    <option value="下午12-18">下午12-18</option>
                    <option value="夜晚18-24">夜晚18-24</option>
                </optgroup>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            地點：
            <select name="area" id="area" onChange="Sub(this.selectedIndex)">
            	<option value="">請選擇</option>
                <option value="北北基">北北基</option>
                <option value="桃竹苗">桃竹苗</option>
                <option value="中彰投">中彰投</option>
                <option value="雲嘉南">雲嘉南</option>
                <option value="高屏">高屏</option>
                <option value="宜花東">宜花東</option>
                <option value="澎金馬">澎金馬</option>
            </select>
            <select name="location" id="location">
            	<option value="">請選擇</option>
            </select>
           <br />
           <p>
            旅遊類型：
            <input type="checkbox" name="type[]" value="自然生態">自然生態
            <input type="checkbox" name="type[]" value="娛樂節慶">娛樂節慶
            <input type="checkbox" name="type[]" value="社會藝文">社會藝文
            <input type="checkbox" name="type[]" value="美食饗宴">美食饗宴
            <input type="checkbox" name="type[]" value="健康運動">健康運動
            <input type="checkbox" name="type[]" value="產業觀光">產業觀光
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </p><input type="submit" name="match" value="跟團">
        
        </form>
        </br>
		<hr>
<?php
		include("../mysql.php");				
		if(isset($_SESSION['user']))
		{
		?>
        <div class="b">
        <img src="img/group1.png" />
        </div>
        <?php
			
			$total=0;
			
			$sql = "SELECT * FROM `group`
					WHERE username != '".$_SESSION['user']."'
					AND hide != '*'";
					
			$result = mysql_query($sql);
		
			while($row = mysql_fetch_array($result))
			{
				$data[$total]['username'] = $row['username'];
				$data[$total]['groupname'] = $row['groupname'];
				$data[$total]['point'] = 0;
				$total++;
			}
			
			//第一階段結束
			
			for($num=0;$num<$total;$num++)
			{
				if(@count($_POST['type']))
				{
					$sql_group_type = "SELECT * FROM `group`
									   WHERE username = '".$data[$num]['username']."'
									   AND groupname = '".$data[$num]['groupname']."'";
					
					$result_group_type = mysql_query($sql_group_type);
				
					$row_group_type = mysql_fetch_array($result_group_type);
				
					$type = array_intersect($_POST['type'],explode(",",$row_group_type['type']));
				
					$data[$num]['weight'] = count($type) / count($_POST['type']);
				}
				else
				{
					$data[$num]['weight'] = 1;
				}
			}
			
			//第二階段開始
			
			$sql_click_user = "SELECT * FROM `click_group_sample`
								WHERE username = '".$_SESSION['user']."'";
								
			$result_click_user = mysql_query($sql_click_user);
			
			$x = mysql_fetch_array($result_click_user);
			
			//print_r($x);
			
			$a = round(($x[1]+$x[2]+$x[3]+$x[4])/4,2);
			$c = round(($x[5]+$x[6]+$x[7]+$x[8]+$x[9]+$x[10]+$x[11]+$x[12]+$x[13]+$x[14]+$x[15]
					   +$x[16]+$x[17]+$x[18]+$x[19]+$x[20]+$x[21]+$x[22]+$x[23]+$x[24])/20,2);
			$e = round(($x[25]+$x[26]+$x[27]+$x[28]+$x[29]+$x[30])/6,2);
			
			for($num=0;$num<$total;$num++)
			{
				$sql_click_buddy = "SELECT * FROM `click_group_sample`
									WHERE username = '".$data[$num]['username']."'";
				
				$result_click_buddy = mysql_query($sql_click_buddy);
				
				$y = mysql_fetch_array($result_click_buddy);
				
				$b = round(($y[1]+$y[2]+$y[3]+$y[4])/4,2);
				
				$d = round(($y[5]+$y[6]+$y[7]+$y[8]+$y[9]+$y[10]+$y[11]+$y[12]+$y[13]+$y[14]+$y[15]
						   +$y[16]+$y[17]+$y[18]+$y[19]+$y[20]+$y[21]+$y[22]+$y[23]+$y[24])/20,2);
				$f = round(($y[25]+$y[26]+$y[27]+$y[28]+$y[29]+$y[30])/6,2);
						   
				$ab = round(($x[1]-$a)*($y[1]-$b)+($x[2]-$a)*($y[2]-$b)+($x[3]-$a)*($y[3]-$b)+($x[4]-$a)*($y[4]-$b),2);
				$aa = round(($x[1]-$a)*($x[1]-$a)+($x[2]-$a)*($x[2]-$a)+($x[3]-$a)*($x[3]-$a)+($x[4]-$a)*($x[4]-$a),2);
				$bb = round(($y[1]-$b)*($y[1]-$b)+($y[2]-$b)*($y[2]-$b)+($y[3]-$b)*($y[3]-$b)+($y[4]-$b)*($y[4]-$b),2);
				
				if($aa*$bb == 0)
				{
					$aabb = 0;
				}else
				{
					$aabb = round($ab/sqrt($aa*$bb),2);
				}
				
				$cd = round(($x[5]-$c)*($y[5]-$d)+($x[6]-$c)*($y[6]-$d)+($x[7]-$c)*($y[7]-$d)+($x[8]-$c)*($y[8]-$d)+($x[9]-$c)*($y[9]-$d)
						   +($x[10]-$c)*($y[10]-$d)+($x[11]-$c)*($y[11]-$d)+($x[12]-$c)*($y[12]-$d)+($x[13]-$c)*($y[13]-$d)+($x[14]-$c)*($y[14]-$d)
						   +($x[15]-$c)*($y[15]-$d)+($x[16]-$c)*($y[16]-$d)+($x[17]-$c)*($y[17]-$d)+($x[18]-$c)*($y[18]-$d)+($x[19]-$c)*($y[19]-$d)
						   +($x[20]-$c)*($y[20]-$d)+($x[21]-$c)*($y[21]-$d)+($x[22]-$c)*($y[22]-$d)+($x[23]-$c)*($y[23]-$d)+($x[24]-$c)*($y[24]-$d),2);
				$cc = round(($x[5]-$c)*($x[5]-$c)+($x[6]-$c)*($x[6]-$c)+($x[7]-$c)*($x[7]-$c)+($x[8]-$c)*($x[8]-$c)+($x[9]-$c)*($x[9]-$c)
						   +($x[10]-$c)*($x[10]-$c)+($x[11]-$c)*($x[11]-$c)+($x[12]-$c)*($x[12]-$c)+($x[13]-$c)*($x[13]-$c)+($x[14]-$c)*($x[14]-$c)
						   +($x[15]-$c)*($x[15]-$c)+($x[16]-$c)*($x[16]-$c)+($x[17]-$c)*($x[17]-$c)+($x[18]-$c)*($x[18]-$c)+($x[19]-$c)*($x[19]-$c)
						   +($x[20]-$c)*($x[20]-$c)+($x[21]-$c)*($x[21]-$c)+($x[22]-$c)*($x[22]-$c)+($x[23]-$c)*($x[23]-$c)+($x[24]-$c)*($x[24]-$c),2);
				$dd = round(($y[5]-$d)*($y[5]-$d)+($y[6]-$d)*($y[6]-$d)+($y[7]-$d)*($y[7]-$d)+($y[8]-$d)*($y[8]-$d)+($y[9]-$d)*($y[9]-$d)
						   +($y[10]-$d)*($y[10]-$d)+($y[11]-$d)*($y[11]-$d)+($y[12]-$d)*($y[12]-$d)+($y[13]-$d)*($y[13]-$d)+($y[14]-$d)*($y[14]-$d)
						   +($y[15]-$d)*($y[15]-$d)+($y[16]-$d)*($y[16]-$d)+($y[17]-$d)*($y[17]-$d)+($y[18]-$d)*($y[18]-$d)+($y[19]-$d)*($y[19]-$d)
						   +($y[20]-$d)*($y[20]-$d)+($y[21]-$d)*($y[21]-$d)+($y[22]-$d)*($y[22]-$d)+($y[23]-$d)*($y[23]-$d)+($y[24]-$d)*($y[24]-$d),2);
				
				if($cc*$dd == 0)
				{
					$ccdd = 0;
				}else
				{
					$ccdd = round($cd/sqrt($cc*$dd),2);
				}
				
				$ef = round(($x[25]-$e)*($y[25]-$f)+($x[26]-$e)*($y[26]-$f)+($x[27]-$e)*($y[27]-$f)
						   +($x[28]-$e)*($y[28]-$f)+($x[29]-$e)*($y[29]-$f)+($x[30]-$e)*($y[30]-$f),2);
				$ee = round(($x[25]-$e)*($x[25]-$e)+($x[26]-$e)*($x[26]-$e)+($x[27]-$e)*($x[27]-$e)
						   +($x[28]-$e)*($x[28]-$e)+($x[29]-$e)*($x[29]-$e)+($x[30]-$e)*($x[30]-$e),2);
				$ff = round(($y[25]-$f)*($y[25]-$f)+($y[26]-$f)*($y[26]-$f)+($y[27]-$f)*($y[27]-$f)
						   +($y[28]-$f)*($y[28]-$f)+($y[29]-$f)*($y[29]-$f)+($y[30]-$f)*($y[30]-$f),2);
				
				if($ee*$ff == 0)
				{
					$eeff = 0;
				}
				else
				{
					$eeff = round($ef/sqrt($ee*$ff),2);
				}
				
				$data[$num]['point'] = $data[$num]['point'] + 1300*$aabb;
				$data[$num]['point'] = $data[$num]['point'] + 1900*$ccdd;
				$data[$num]['point'] = $data[$num]['point'] + 1800*$eeff;
			}
			
			//媒合記錄
			
			$sql_match_user = "SELECT * FROM `match_group_sample`
								WHERE username = '".$_SESSION['user']."'";
								
			$result_match_user = mysql_query($sql_match_user);
			
			$u = mysql_fetch_array($result_match_user);
			
			$i = round(($u[1]+$u[2]+$u[3]+$u[4])/4,2);
			$k = round(($u[5]+$u[6]+$u[7]+$u[8]+$u[9]+$u[10]+$u[11]+$u[12]+$u[13]+$u[14]+$u[15]
					   +$u[16]+$u[17]+$u[18]+$u[19]+$u[20]+$u[21]+$u[22]+$u[23]+$u[24])/20,2);
			$m = round(($u[25]+$u[26]+$u[27]+$u[28]+$u[29]+$u[30])/6,2);
			
			
			
			
			for($num=0;$num<$total;$num++)
			{
				$sql_match_buddy = "SELECT * FROM `match_group_sample`
									WHERE username = '".$data[$num]['username']."'";
									
				//echo "</br>".$sql_match_buddy."</br>";
				
				$result_match_buddy = mysql_query($sql_match_buddy);
				
				$v = mysql_fetch_array($result_match_buddy);
				
				$j = round(($v[1]+$v[2]+$v[3]+$v[4])/4,2);
				$l = round(($v[5]+$v[6]+$v[7]+$v[8]+$v[9]+$v[10]+$v[11]+$v[12]+$v[13]+$v[14]+$v[15]
					   +$v[16]+$v[17]+$v[18]+$v[19]+$v[20]+$v[21]+$v[22]+$v[23]+$v[24])/20,2);
				$n = round(($v[25]+$v[26]+$v[27]+$v[28]+$v[29]+$v[30])/6,2);
				
				
				$ij = round(($x[1]-$i)*($y[1]-$j)+($x[2]-$i)*($y[2]-$j)+($x[3]-$i)*($y[3]-$j)+($x[4]-$i)*($y[4]-$j),2);
				$ii = round(($x[1]-$i)*($x[1]-$i)+($x[2]-$i)*($x[2]-$i)+($x[3]-$i)*($x[3]-$i)+($x[4]-$i)*($x[4]-$i),2);
				$jj = round(($y[1]-$j)*($y[1]-$j)+($y[2]-$j)*($y[2]-$j)+($y[3]-$j)*($y[3]-$j)+($y[4]-$j)*($y[4]-$j),2);
				
				if($ii*$jj == 0)
				{
					$iijj =0;
				}else
				{
					$iijj = round($ij/sqrt($ii*$jj),2);
				}
				
				$kl = round(($x[5]-$k)*($y[5]-$l)+($x[6]-$k)*($y[6]-$l)+($x[7]-$k)*($y[7]-$l)+($x[8]-$k)*($y[8]-$l)+($x[9]-$k)*($y[9]-$l)
						   +($x[10]-$k)*($y[10]-$l)+($x[11]-$k)*($y[11]-$l)+($x[12]-$k)*($y[12]-$l)+($x[13]-$k)*($y[13]-$l)+($x[14]-$k)*($y[14]-$l)
						   +($x[15]-$k)*($y[15]-$l)+($x[16]-$k)*($y[16]-$l)+($x[17]-$k)*($y[17]-$l)+($x[18]-$k)*($y[18]-$l)+($x[19]-$k)*($y[19]-$l)
						   +($x[20]-$k)*($y[20]-$l)+($x[21]-$k)*($y[21]-$l)+($x[22]-$k)*($y[22]-$l)+($x[23]-$k)*($y[23]-$l)+($x[24]-$k)*($y[24]-$l),2);
				$kk = round(($x[5]-$k)*($x[5]-$k)+($x[6]-$k)*($x[6]-$k)+($x[7]-$k)*($x[7]-$k)+($x[8]-$k)*($x[8]-$k)+($x[9]-$k)*($x[9]-$k)
						   +($x[10]-$k)*($x[10]-$k)+($x[11]-$k)*($x[11]-$k)+($x[12]-$k)*($x[12]-$k)+($x[13]-$k)*($x[13]-$k)+($x[14]-$k)*($x[14]-$k)
						   +($x[15]-$k)*($x[15]-$k)+($x[16]-$k)*($x[16]-$k)+($x[17]-$k)*($x[17]-$k)+($x[18]-$k)*($x[18]-$k)+($x[19]-$k)*($x[19]-$k)
						   +($x[20]-$k)*($x[20]-$k)+($x[21]-$k)*($x[21]-$k)+($x[22]-$k)*($x[22]-$k)+($x[23]-$k)*($x[23]-$k)+($x[24]-$k)*($x[24]-$k),2);
				$ll = round(($y[5]-$l)*($y[5]-$l)+($y[6]-$l)*($y[6]-$l)+($y[7]-$l)*($y[7]-$l)+($y[8]-$l)*($y[8]-$l)+($y[9]-$l)*($y[9]-$l)
						   +($y[10]-$l)*($y[10]-$l)+($y[11]-$l)*($y[11]-$l)+($y[12]-$l)*($y[12]-$l)+($y[13]-$l)*($y[13]-$l)+($y[14]-$l)*($y[14]-$l)
						   +($y[15]-$l)*($y[15]-$l)+($y[16]-$l)*($y[16]-$l)+($y[17]-$l)*($y[17]-$l)+($y[18]-$l)*($y[18]-$l)+($y[19]-$l)*($y[19]-$l)
						   +($y[20]-$l)*($y[20]-$l)+($y[21]-$l)*($y[21]-$l)+($y[22]-$l)*($y[22]-$l)+($y[23]-$l)*($y[23]-$l)+($y[24]-$l)*($y[24]-$l),2);
				
				if($kk*$ll == 0)
				{
					$kkll = 0;
				}else
				{
					$kkll = round($kl/sqrt($kk*$ll),2);
				}
				
				$mn = round(($x[25]-$m)*($y[25]-$n)+($x[26]-$m)*($y[26]-$n)+($x[27]-$m)*($y[27]-$n)
						   +($x[28]-$m)*($y[28]-$n)+($x[29]-$m)*($y[29]-$n)+($x[30]-$m)*($y[30]-$n),2);
				$mm = round(($x[25]-$m)*($x[25]-$m)+($x[26]-$m)*($x[26]-$m)+($x[27]-$m)*($x[27]-$m)
						   +($x[28]-$m)*($x[28]-$m)+($x[29]-$m)*($x[29]-$m)+($x[30]-$m)*($x[30]-$m),2);
				$nn = round(($y[25]-$n)*($y[25]-$n)+($y[26]-$n)*($y[26]-$n)+($y[27]-$n)*($y[27]-$n)
						   +($y[28]-$n)*($y[28]-$n)+($y[29]-$n)*($y[29]-$n)+($y[30]-$n)*($y[30]-$n),2);
				
				if($mm*$nn == 0)
				{
					$mmnn = 0;
				}else
				{
					$mmnn = round($mn/sqrt($mm*$nn),2);
				}
				
				$data[$num]['point'] = $data[$num]['point'] + 1300*$iijj;
				$data[$num]['point'] = $data[$num]['point'] + 1900*$kkll;
				$data[$num]['point'] = $data[$num]['point'] + 1800*$mmnn;
			}
			
			for($i=0;$i<$total;$i++)	//氣泡排序法
			{
				for($j=$i;$j<$total;$j++)
				{
					if($data[$j]['point']>$data[$i]['point'])
					{
						$temp_username = $data[$j]['username'];
						$data[$j]['username'] = $data[$i]['username'];
						$data[$i]['username'] = $temp_username;
						
						$temp_groupname = $data[$j]['groupname'];
						$data[$j]['groupname'] = $data[$i]['groupname'];
						$data[$i]['groupname'] = $temp_groupname;
						
						$temp_point = $data[$j]['point'];
						$data[$j]['point'] = $data[$i]['point'];
						$data[$i]['point'] = $temp_point;
					}
				}
			}
			
			for($z=0;$z<4;$z++)	//顯是最終結果
			{
				$sql_info = "SELECT * FROM `group`
							 WHERE username = '".$data[$z]['username']."'
							 AND groupname = '".$data[$z]['groupname']."'";
							 
				$result_info = mysql_query($sql_info);
				$row_info = mysql_fetch_array($result_info);
				
				$http = "g.info.php?".$row_info['id'];
				
				?>
                <div class="box1">

                <?php
				
				echo "<a href=\"$http\">".$row_info['groupname']."</a>";
				echo "<p>".$row_info['date']."</p>";
				echo "<p>".$row_info['time']."</p>";
				echo "<p>".$row_info['location']."</p>";
				echo "<p>".$row_info['type']."</p>";
				?>
                </div>
                <?php				

			}
			
		}
		
		?>
        <div class="b1">
        <img src="img/group2.png" />
        </div>
        
        <div class="c">
        <?php
		
		$sql_group = "SELECT * FROM `group`
					  WHERE hide != '*'
					  ORDER BY id DESC
					  LIMIT 0,8";
		$result_group = mysql_query($sql_group);
		
		while($row_group = mysql_fetch_array($result_group))
		{
			$http = "g.info.php?".$row_group['id'];
			
			?>

        <div class="box2">

        <?php
				
			echo "<a href=\"$http\">".$row_group['groupname']."</a>";
			echo "<p>".$row_group['date']."</p>";
		    echo "<p>".$row_group['time']."</p>";
			echo "<p>".$row_group['location']."</p>";
			echo "<p>".$row_group['type']."</p>";
				?>
                </div>
                <?php


		}		
?>
</div>

<p class="b2">
<a href="g.more.php\">尋找更多旅行團……</a>
</p>
</div>

<script>
	
		n = new Array();
		v = new Array();
		
		n[1] = ["臺北","新北","基隆"];
		n[2] = ["桃園","新竹","苗栗"];
		n[3] = ["臺中","彰化","南投"];
		n[4] = ["雲林","嘉義","臺南"];
		n[5] = ["高雄","屏東"];
		n[6] = ["宜蘭","花蓮","臺東"];
		n[7] = ["澎湖","金門","馬祖"];
		
		v[1] = ["臺北","新北","基隆"];
		v[2] = ["桃園","新竹","苗栗"];
		v[3] = ["臺中","彰化","南投"];
		v[4] = ["雲林","嘉義","臺南"];
		v[5] = ["高雄","屏東"];
		v[6] = ["宜蘭","花蓮","臺東"];
		v[7] = ["澎湖","金門","馬祖"];
		
		function Sub(index)
		{
			for(var i=0;i<n[index].length;i++)
			{
				document._match.location.options[i]
				= new Option(n[index][i],v[index][i]);
			}
			document._match.location.length = n[index].length;
		}
</script>

<div id="footer">
<p>&nbsp;</p>
<p><img src="../homeimg/logo.png"></p>
<p>Budditrip © 2014 . NCCUMIS100 . produce</p>
</div>	
</body>
</html>