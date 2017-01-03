<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/content-4.css" type="text/css">    
<link rel="stylesheet" href="../css/navigators-match.css" type="text/css">
<link rel="stylesheet" href="../css/slider.css" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<title>Budditrip - 旅伴配對</title>
</head>

<style type="text/css">

#header{
	text-align:center;
	font-family:"微軟正黑體";
	font-size:18px;
	background-color:#FF9;		
}

#column{
		font-family:"微軟正黑體";
	}

</style>
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

		<form id="_match" name="_match" action="b.result.php" method="post">
        	
            <h3>搜索適合您的旅伴</h3>
            性別：
            <input type="radio" name="gender" value="男">男
            <input type="radio" name="gender" value="女">女
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            年齡：
            <input type="text" name="age_min" style="width:25px">~<input type="text" name="age_max" style="width:25px">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            所在地：
            <select id="place" name="place" onchange="goto(this.selectedIndex)">
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
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            興趣：
            <input type="checkbox" name="interest[]" value="音樂">音樂
            <input type="checkbox" name="interest[]" value="美食">美食
            <input type="checkbox" name="interest[]" value="運動">運動
            <input type="checkbox" name="interest[]" value="閱讀">閱讀
            <input type="checkbox" name="interest[]" value="電影">電影
            <input type="checkbox" name="interest[]" value="美術">美術
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="match" value="配對">
            </br></br>
            
            <script>
				
            	n = new Array();v = new Array();
		
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
		
				function goto(index)
				{
					for(var i=0;i<n[index].length;i++)
					{
						document._match.location.options[i]
						= new Option(n[index][i],v[index][i]);
					}
					document._match.location.length = n[index].length;
				}
            
            </script>
            
            <h3>
            帳號搜尋
            <input type="text" name="username">
            <input type="submit" name="_username" value="搜尋">
            
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
            暱稱搜尋
            <input type="text" name="nickname">
            <input type="submit" name="_nickname" value="搜尋">
            </h3>
        </form>
        
        </br>
		<hr>


<?php
		include("../mysql.php");
		
		
		if(isset($_SESSION['user']))
		{
		?>
        <div class="b">
        <img src="img/buddy2.png" />
        </div>
        <?php
			
			
			$total=0;
			
			$sql = "SELECT * FROM `user`
					WHERE username != '".$_SESSION['user']."'";
			
			$result = mysql_query($sql);
			
			while($row = mysql_fetch_array($result))
			{
				$data[$total]['username'] = $row['username'];
				$data[$total]['point'] = 0;
				$total++;
			}
			
			$sql_click_user = "SELECT * FROM `click_buddy_sample`
								WHERE username = '".$_SESSION['user']."'";	
			$result_click_user = mysql_query($sql_click_user);
			
			$x = mysql_fetch_array($result_click_user);	//使用者的點擊記錄
			//print_r($x);
			
			$a = round(($x[1]+$x[2])/2,2);	//使用者點擊記錄的性別平均
			$c = round(($x[3]+$x[4]+$x[5]+$x[6]+$x[7]+$x[8]+$x[9]+$x[10]+$x[11])/9,2);	//使用者點擊記錄的年齡平均
			$e = round(($x[12]+$x[13]+$x[14]+$x[15]+$x[16]+$x[17]+$x[18]+$x[19]+$x[20]+$x[21]
						+$x[22]+$x[23]+$x[24]+$x[25]+$x[26]+$x[27]+$x[28]+$x[29]+$x[30]+$x[31])/20,2);	//使用者點擊記錄的所在地平均
			$g = round(($x[32]+$x[33]+$x[34]+$x[35]+$x[36]+$x[37])/6,2);	//使用者點擊記錄的興趣平均
			
			for($num=0;$num<$total;$num++)
			{
				$sql_click_buddy = "SELECT * FROM `click_buddy_sample`
									WHERE username = '".$data[$num]['username']."'";
				$result_click_buddy = mysql_query($sql_click_buddy);
				
				$y = mysql_fetch_array($result_click_buddy);
				//print_r($y);
				
				$b = round(($y[1]+$y[2])/2,2);	//旅伴點擊記錄的性別平均
				$d = round(($y[3]+$y[4]+$y[5]+$y[6]+$y[7]+$y[8]+$y[9]+$y[10]+$y[11])/9,2);	//旅伴點擊記錄的年齡平均
				$f = round(($y[12]+$y[13]+$y[14]+$y[15]+$y[16]+$y[17]+$y[18]+$y[19]+$y[20]+$y[21]
						+$y[22]+$y[23]+$y[24]+$y[25]+$y[26]+$y[27]+$y[28]+$y[29]+$y[30]+$y[31])/20,2);	//旅伴點擊記錄的所在地平均
				$h = round(($y[32]+$y[33]+$y[34]+$y[35]+$y[36]+$y[37])/6,2);				
				
				$ab = round(($x[1]-$a)*($y[1]-$b) + ($x[2]-$a)*($y[2]-$b),2);
				$aa = round(($x[1]-$a)*($x[1]-$a) + ($x[2]-$a)*($x[2]-$a),2);
				$bb = round(($y[1]-$b)*($y[1]-$b) + ($y[2]-$b)*($y[2]-$b),2);
				
				if($aa*$bb == 0)
				{
					$aabb = 0;
				}else
				{
					$aabb = round($ab/sqrt($aa*$bb),2);
				}
				
				//點擊記錄的性別相關係數
				
				$cd = round(($x[3]-$c)*($y[3]-$d) + ($x[4]-$c)*($y[4]-$d) + ($x[5]-$c)*($y[5]-$d) + ($x[6]-$c)*($y[6]-$d)
						  + ($x[7]-$c)*($y[7]-$d) + ($x[8]-$c)*($y[8]-$d) + ($x[9]-$c)*($y[9]-$d) + ($x[10]-$c)*($y[10]-$d)
						  + ($x[11]-$c)*($y[11]-$d),2);
				$cc = round(($x[3]-$c)*($x[3]-$c) + ($x[4]-$c)*($x[4]-$c) + ($x[5]-$c)*($x[5]-$c) + ($x[6]-$c)*($x[6]-$c) 
					      + ($x[7]-$c)*($x[7]-$c) + ($x[8]-$c)*($x[8]-$c) + ($x[9]-$c)*($x[9]-$c) + ($x[10]-$c)*($x[10]-$c)
				          + ($x[11]-$c)*($x[11]-$c),2);
				$dd = round(($y[3]-$d)*($y[3]-$d) + ($y[4]-$d)*($y[4]-$d) + ($y[5]-$d)*($y[5]-$d) + ($y[6]-$d)*($y[6]-$d) 
					      + ($y[7]-$d)*($y[7]-$d) + ($y[8]-$d)*($y[8]-$d) + ($y[9]-$d)*($y[9]-$d) + ($y[10]-$d)*($y[10]-$d)
				          + ($y[11]-$d)*($y[11]-$d),2);
				
				if($cc*$dd == 0)
				{
					$ccdd = 0;
				}else
				{
					$ccdd = round($cd/sqrt($cc*$dd),2);
				}
				//點擊記錄的年齡相關係數
				
				$ef = round(($x[12]-$e)*($y[12]-$f) + ($x[13]-$e)*($y[13]-$f) + ($x[14]-$e)*($y[14]-$f) + ($x[15]-$e)*($y[15]-$f) 
					      + ($x[16]-$e)*($y[16]-$f) + ($x[17]-$e)*($y[17]-$f) + ($x[18]-$e)*($y[18]-$f) + ($x[19]-$e)*($y[19]-$f)
				          + ($x[20]-$e)*($y[20]-$f) + ($x[21]-$e)*($y[21]-$f) + ($x[22]-$e)*($y[22]-$f) + ($x[23]-$e)*($y[23]-$f) 
					      + ($x[24]-$e)*($y[24]-$f) + ($x[25]-$e)*($y[25]-$f) + ($x[26]-$e)*($y[26]-$f) + ($x[27]-$e)*($y[27]-$f)
				          + ($x[28]-$e)*($y[28]-$f) + ($x[29]-$e)*($y[29]-$f) + ($x[30]-$e)*($y[30]-$f) + ($x[31]-$e)*($y[31]-$f),2);
						  
				$ee = round(($x[12]-$e)*($x[12]-$e) + ($x[13]-$e)*($x[13]-$e) + ($x[14]-$e)*($x[14]-$e) + ($x[15]-$e)*($x[15]-$e) 
					      + ($x[16]-$e)*($x[16]-$e) + ($x[17]-$e)*($x[17]-$e) + ($x[18]-$e)*($x[18]-$e) + ($x[19]-$e)*($x[19]-$e)
				          + ($x[20]-$e)*($x[20]-$e) + ($x[21]-$e)*($x[21]-$e) + ($x[22]-$e)*($x[22]-$e) + ($x[23]-$e)*($x[23]-$e) 
					      + ($x[24]-$e)*($x[24]-$e) + ($x[25]-$e)*($x[25]-$e) + ($x[26]-$e)*($x[26]-$e) + ($x[27]-$e)*($x[27]-$e)
				          + ($x[28]-$e)*($x[28]-$e) + ($x[29]-$e)*($x[29]-$e) + ($x[30]-$e)*($x[30]-$e) + ($x[31]-$e)*($x[31]-$e),2);
				$ff = round(($y[12]-$f)*($y[12]-$f) + ($y[13]-$f)*($y[13]-$f) + ($y[14]-$f)*($y[14]-$f) + ($y[15]-$f)*($y[15]-$f) 
					      + ($y[16]-$f)*($y[16]-$f) + ($y[17]-$f)*($y[17]-$f) + ($y[18]-$f)*($y[18]-$f) + ($y[19]-$f)*($y[19]-$f)
				          + ($y[20]-$f)*($y[20]-$f) + ($y[21]-$f)*($y[21]-$f) + ($y[22]-$f)*($y[22]-$f) + ($y[23]-$f)*($y[23]-$f) 
					      + ($y[24]-$f)*($y[24]-$f) + ($y[25]-$f)*($y[25]-$f) + ($y[26]-$f)*($y[26]-$f) + ($y[27]-$f)*($y[27]-$f)
				          + ($y[28]-$f)*($y[28]-$f) + ($y[29]-$f)*($y[29]-$f) + ($y[30]-$f)*($y[30]-$f) + ($y[31]-$f)*($y[31]-$f),2);
				
				if($ee*$ff == 0)
				{	
					$eeff = 0;
				}else
				{
					$eeff = round($ef/sqrt($ee*$ff),2); 
				}
				
				//點擊記錄的所在地相關係數
				
				$gh = round(($x[32]-$g)*($y[32]-$h) + ($x[33]-$g)*($y[33]-$h) + ($x[34]-$g)*($y[34]-$h)
						  + ($x[35]-$g)*($y[35]-$h) + ($x[36]-$g)*($y[36]-$h) + ($x[37]-$g)*($y[37]-$h),2);
				$gg = round(($x[32]-$g)*($x[32]-$g) + ($x[33]-$g)*($x[33]-$g) + ($x[34]-$g)*($x[34]-$g)
						  + ($x[35]-$g)*($x[35]-$g) + ($x[36]-$g)*($x[36]-$g) + ($x[37]-$g)*($x[37]-$g),2);
				$hh = round(($y[32]-$h)*($y[32]-$h) + ($y[33]-$h)*($y[33]-$h) + ($y[34]-$h)*($y[34]-$h)
						  + ($y[35]-$h)*($y[35]-$h) + ($y[36]-$h)*($y[36]-$h) + ($y[37]-$h)*($y[37]-$h),2);
				
				if($gg*$hh ==0)
				{
					$gghh = 0;
				}else
				{
					$gghh = round($gh/sqrt($gg*$hh),2);
				}
				//點擊記錄的興趣相關係數
				
				$data[$num]['point'] = $data[$num]['point'] + 2000 * $aabb;
				$data[$num]['point'] = $data[$num]['point'] + 700 * $ccdd;
				$data[$num]['point'] = $data[$num]['point'] + 100 * $eeff;
				$data[$num]['point'] = $data[$num]['point'] + 2200 * $gghh;
			}
			
			$sql_match_user = "SELECT * FROM `match_buddy_sample`
								WHERE username = '".$_SESSION['user']."'";
			$result_match_user = mysql_query($sql_match_user);
			
			$u = mysql_fetch_array($result_match_user);
			
			$i = round(($u[1]+$u[2])/2,2);
			$k = round(($u[3]+$u[4]+$u[5]+$u[6]+$u[7]+$u[8]+$u[9]+$u[10]+$u[11])/9,2);
			$m = round(($u[12]+$u[13]+$u[14]+$u[15]+$u[16]+$u[17]+$u[18]+$u[19]+$u[20]+$u[21]
						+$u[22]+$u[23]+$u[24]+$u[25]+$u[26]+$u[27]+$u[28]+$u[29]+$u[30]+$u[31])/20,2);
			$o = round(($u[32]+$u[33]+$u[34]+$u[35]+$u[36]+$u[37])/6,2);
			
			for($num=0;$num<$total;$num++)
			{
				$sql_match_buddy = "SELECT * FROM `match_buddy_sample`
									WHERE username = '".$data[$num]['username']."'";
				$result_match_buddy = mysql_query($sql_match_buddy);
				
				$v = mysql_fetch_array($result_match_buddy);
				
				$j = round(($v[1]+$v[2])/2,2);
				$l = round(($v[3]+$v[4]+$v[5]+$v[6]+$v[7]+$v[8]+$v[9]+$v[10]+$v[11])/9,2);
				$n = round(($v[12]+$v[13]+$v[14]+$v[15]+$v[16]+$v[17]+$v[18]+$v[19]+$v[20]+$v[21]
						+$v[22]+$v[23]+$v[24]+$v[25]+$v[26]+$v[27]+$v[28]+$v[29]+$v[30]+$v[31])/20,2);
				$p = round(($v[32]+$v[33]+$v[34]+$v[35]+$v[36]+$v[37])/6,2);				
				
				$ij = round(($u[1]-$i)*($v[1]-$j) + ($u[2]-$i)*($v[2]-$j),2);
				$ii = round(($u[1]-$i)*($u[1]-$i) + ($u[2]-$i)*($u[2]-$i),2);
				$jj = round(($v[1]-$j)*($v[1]-$j) + ($v[2]-$j)*($v[2]-$j),2);
				
				if($ii*$jj == 0)
				{
					$iijj = 0;
				}else
				{
					$iijj = round($ij/sqrt($ii*$jj),2);
				}
				
				$kl = round(($u[3]-$k)*($v[3]-$l) + ($u[4]-$k)*($v[4]-$l) + ($u[5]-$k)*($v[5]-$l) + ($u[6]-$k)*($v[6]-$l)
						  + ($u[7]-$k)*($v[7]-$l) + ($u[8]-$k)*($v[8]-$l) + ($u[9]-$k)*($v[9]-$l) + ($u[10]-$k)*($v[10]-$l)
						  + ($u[11]-$k)*($v[11]-$l),2);
				$kk = round(($u[3]-$k)*($u[3]-$k) + ($u[4]-$k)*($u[4]-$k) + ($u[5]-$k)*($u[5]-$k) + ($u[6]-$k)*($u[6]-$k) 
					      + ($u[7]-$k)*($u[7]-$k) + ($u[8]-$k)*($u[8]-$k) + ($u[9]-$k)*($u[9]-$k) + ($u[10]-$k)*($u[10]-$k)
				          + ($u[11]-$k)*($u[11]-$k),2);
				$ll = round(($v[3]-$l)*($v[3]-$l) + ($v[4]-$l)*($v[4]-$l) + ($v[5]-$l)*($v[5]-$l) + ($v[6]-$l)*($v[6]-$l) 
					      + ($v[7]-$l)*($v[7]-$l) + ($v[8]-$l)*($v[8]-$l) + ($v[9]-$l)*($v[9]-$l) + ($v[10]-$l)*($v[10]-$l)
				          + ($v[11]-$l)*($v[11]-$l),2);
						  
				if($kk*$ll == 0)
				{
					$kkll = 0;
				}else
				{
					$kkll = round($kl/sqrt($kk*$ll),2);
				}
				
				$mn = round(($u[12]-$m)*($v[12]-$n) + ($u[13]-$m)*($v[13]-$n) + ($u[14]-$m)*($v[14]-$n) + ($u[15]-$m)*($v[15]-$n) 
					      + ($u[16]-$m)*($v[16]-$n) + ($u[17]-$m)*($v[17]-$n) + ($u[18]-$m)*($v[18]-$n) + ($u[19]-$m)*($v[19]-$n)
				          + ($u[20]-$m)*($v[20]-$n) + ($u[21]-$m)*($v[21]-$n) + ($u[22]-$m)*($v[22]-$n) + ($u[23]-$m)*($v[23]-$n) 
					      + ($u[24]-$m)*($v[24]-$n) + ($u[25]-$m)*($v[25]-$n) + ($u[26]-$m)*($v[26]-$n) + ($u[27]-$m)*($v[27]-$n)
				          + ($u[28]-$m)*($v[28]-$n) + ($u[29]-$m)*($v[29]-$n) + ($u[30]-$m)*($v[30]-$n) + ($u[31]-$m)*($v[31]-$n),2);
						  
				$mm = round(($u[12]-$m)*($u[12]-$m) + ($u[13]-$m)*($u[13]-$m) + ($u[14]-$m)*($u[14]-$m) + ($u[15]-$m)*($u[15]-$m) 
					      + ($u[16]-$m)*($u[16]-$m) + ($u[17]-$m)*($u[17]-$m) + ($u[18]-$m)*($u[18]-$m) + ($u[19]-$m)*($u[19]-$m)
				          + ($u[20]-$m)*($u[20]-$m) + ($u[21]-$m)*($u[21]-$m) + ($u[22]-$m)*($u[22]-$m) + ($u[23]-$m)*($u[23]-$m) 
					      + ($u[24]-$m)*($u[24]-$m) + ($u[25]-$m)*($u[25]-$m) + ($u[26]-$m)*($u[26]-$m) + ($u[27]-$m)*($u[27]-$m)
				          + ($u[28]-$m)*($u[28]-$m) + ($u[29]-$m)*($u[29]-$m) + ($u[30]-$m)*($u[30]-$m) + ($u[31]-$m)*($u[31]-$m),2);
				$nn = round(($v[12]-$n)*($v[12]-$n) + ($v[13]-$n)*($v[13]-$n) + ($v[14]-$n)*($v[14]-$n) + ($v[15]-$n)*($v[15]-$n) 
					      + ($v[16]-$n)*($v[16]-$n) + ($v[17]-$n)*($v[17]-$n) + ($v[18]-$n)*($v[18]-$n) + ($v[19]-$n)*($v[19]-$n)
				          + ($v[20]-$n)*($v[20]-$n) + ($v[21]-$n)*($v[21]-$n) + ($v[22]-$n)*($v[22]-$n) + ($v[23]-$n)*($v[23]-$n) 
					      + ($v[24]-$n)*($v[24]-$n) + ($v[25]-$n)*($v[25]-$n) + ($v[26]-$n)*($v[26]-$n) + ($v[27]-$n)*($v[27]-$n)
				          + ($v[28]-$n)*($v[28]-$n) + ($v[29]-$n)*($v[29]-$n) + ($v[30]-$n)*($v[30]-$n) + ($v[31]-$n)*($v[31]-$n),2);
				
				if($mm*$nn == 0)
				{	
					$mmnn = 0;
				}else
				{
					$mmnn = round($mn/sqrt($mm*$nn),2);
				}
				
				$op = round(($u[32]-$o)*($v[32]-$p) + ($u[33]-$o)*($v[33]-$p) + ($u[34]-$o)*($v[34]-$p)
						  + ($u[35]-$o)*($v[35]-$p) + ($u[36]-$o)*($v[36]-$p) + ($u[37]-$o)*($v[37]-$p),2);
				$oo = round(($u[32]-$o)*($u[32]-$o) + ($u[33]-$o)*($u[33]-$o) + ($u[34]-$o)*($u[34]-$o)
						  + ($u[35]-$o)*($u[35]-$o) + ($u[36]-$o)*($u[36]-$o) + ($u[37]-$o)*($u[37]-$o),2);
				$pp = round(($v[32]-$p)*($v[32]-$p) + ($v[33]-$p)*($v[33]-$p) + ($v[34]-$p)*($v[34]-$p)
						  + ($v[35]-$p)*($v[35]-$p) + ($v[36]-$p)*($v[36]-$p) + ($v[37]-$p)*($v[37]-$p),2);
						  
				if($oo*$pp == 0)
				{
					$oopp = 0;
				}else
				{
					$oopp = round($op/sqrt($oo*$pp),2);
				}
				
				$data[$num]['point'] = $data[$num]['point'] + 2000 * $iijj;
				$data[$num]['point'] = $data[$num]['point'] + 700 * $kkll;
				$data[$num]['point'] = $data[$num]['point'] + 100 * $mmnn;
				$data[$num]['point'] = $data[$num]['point'] + 2200 * $oopp;
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
						
						$temp_point = $data[$j]['point'];
						$data[$j]['point'] = $data[$i]['point'];
						$data[$i]['point'] = $temp_point;
					}
				}
			}
			
			for($z=0;$z<4;$z++)	//顯示最終結果
			{	
				$sql_info = "SELECT * FROM `user`
							 WHERE username = '".$data[$z]['username']."'";
				$result_info = mysql_query($sql_info);
				$row_info =mysql_fetch_array($result_info);
				
				$http = "b.info.php?".$row_info['id'];
				
				$age = floor((time()-strtotime($row_info['birthday']))/31556926);
				?>
                <div class="box1">
                <?php
				
        		if( 
				$row_info['userImage'] != NULL) {
				echo '<p><img width="150px" height="150px" src="data:image/jpeg;base64,'.base64_encode( $row_info['userImage'] ).'"/></p>';
			}else{
				echo'<p><img width="150px" height="150px" src="../css/default.jpg"></p>';
				}
			    echo "<a href=\"$http\" style='text-shadow: 1px 1px 1px #999999;text-decoration:none;'>".$row_info['nickname']."</a>";
			    echo "<p></p>";
				echo "<p>".$row_info['gender']."</p>";
				echo "<p>".$age."</p>";
				echo "<p>".$row_info['location']."</p>";
				echo "<p>".$row_info['interest']."</p>";
				
				?>
                </div>
                <?php
			}
			
		}
		////////
		////////
		////////
		
		?>
        <div class="b1">
        <img src="img/buddy1.png" />
        </div>


        <div class="c">
        <?php
		
		$sql_buddy2 = "SELECT * FROM `user`
						ORDER BY id DESC
					   LIMIT 0,8";
		
		$result_buddy2 = mysql_query($sql_buddy2);
		
		while($row_buddy2 = mysql_fetch_array($result_buddy2))
		{
			$http2 = "b.info.php?".$row_buddy2['id'];
			$age = floor((time()-strtotime($row_buddy2['birthday']))/31556926);	//計算年齡
		?>
        <div class="box2">
        <?php
			if( $row_buddy2['userImage'] != NULL )
			{
				echo '<p><img width="150px" height="150px" src="data:image/jpeg;base64,'.base64_encode( $row_buddy2['userImage'] ).'"/></p>';
			}else{
				echo'<p><img width="150px" height="150px" src="../css/default.jpg"></p>';
				}
			echo "<a href=\"$http2\" style='text-shadow: 1px 1px 1px #999999;text-decoration:none;'>".$row_buddy2['nickname']."</a>";
			echo "<p></p>";
			echo "<a>".$row_buddy2['gender']."</a>&nbsp;&nbsp;";
			echo "<a>".$age."</a>";
			echo "<p>".$row_buddy2['location']."</p>";
			echo "<a>".$row_buddy2['interest']."</a>";
			?>
        </div>
        <?php

		}		
?>
</div>
<p class="b2">
<a href="b.more.php\">尋找更多旅伴……</a>
</p>
</div>

<div id="footer">
<p>&nbsp;</p>
<p><img src="../homeimg/logo.png"></p>
<p>Budditrip © 2014 . NCCUMIS100 . produce</p>
</div>		
</body>
</html>