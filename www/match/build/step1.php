<?php session_start(); ?><head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../css/content-1.css" type="text/css">    
<link rel="stylesheet" href="../../css/navigators-match.css" type="text/css">
<link rel="stylesheet" href="../../css/slider.css" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<title>Budditrip - 揪團</title>
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
<br />
<br />

<?php	if(!isset($_SESSION['user']))
		{
			echo '<script type="text/javascript">';
			echo 'alert ("You do not login.")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=/login/login.php">';	//有斜線 是絕對位址
		}	?>
        <div class="centerBlock">
        
        <p><img src="../img/step1.png" class="box" /></p>
        
		<div class="content">        
		<form id="step1" name="step1" action="step1.b.php" method="post">
    		<h3>揪團名稱：<input type="text" id="groupname" name="groupname"></h3>
            
            <h3>旅遊時間</h3>
            
            <input type="date" id="date" name="date">
            
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
            
           	<h3>旅遊地點</h3>
            <select name="place" id="place" onChange="Sub(this.selectedIndex)">
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
            <h3>旅遊類型</h3>
        	<input type="checkbox" name="type[]" value="自然生態">自然生態
            <input type="checkbox" name="type[]" value="娛樂節慶">娛樂節慶
            <input type="checkbox" name="type[]" value="社會藝文">社會藝文
            <input type="checkbox" name="type[]" value="美食饗宴">美食饗宴
            <input type="checkbox" name="type[]" value="健康運動">健康運動
            <input type="checkbox" name="type[]" value="產業觀光">產業觀光</br></br>
        	<input type="button" value="下一步" onClick="Next()">
		</form>  
        </div>
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
				document.step1.location.options[i]
				= new Option(n[index][i],v[index][i]);
			}
			document.step1.location.length = n[index].length;
		}
		
		function Next()
		{
			var count = 0;
			
			/*for(var i=0;i<step1.type.length;i++)
			{
				if(step1.type[i].checked)
				{
					count = count + 1;
				}
			}*/
			
			if(step1.groupname.value == "")
			{
				alert ("請輸入揪團名稱");
			}else if(step1.date.value == "")
			{
				alert ("請選擇旅遊時間");
			}
			else if(step1.location.value == "")
			{
				alert ("請選擇旅遊地點");
			}
			/*else if(count == 0)
			{
				alert ("請選擇旅遊類型");
			}*/
			else
			{
				step1.submit();
			}
		}
		</script>
        
<div id="footer">
<p>&nbsp;</p>
<p><img src="../../homeimg/logo.png"></p>
<p>Budditrip © 2014 . NCCUMIS100 . produce</p>
</div>	
</body>
</html>