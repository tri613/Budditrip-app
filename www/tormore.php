<?php session_start(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="css/top-nav-ban.css" type="text/css">
<link rel="stylesheet" href="css/slider.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="js/slider.js"></script>
<title>BuddiTrip</title>

</head>

<body>

<?php
if(isset($_SESSION['user'])){
echo '<script>';
echo ' window.onload = function() {document.getElementById("loggedIn").style.display="";} ;';
echo ' </script> ';}

else{
echo '<script>';
echo ' window.onload = function() {document.getElementById("unloggedIn").style.display="";} ;';
echo ' </script> ';}


?>

<div class="header">

<div class="topNav">
<span class="topNavText"><a href="index.php">BuddiTrip</a></span>
<span id="unloggedIn" style="display:none" class="topButton">
<a href="register/register.php">註冊</a>    
<a href="login/login.php">登入</a>
</span>
<span id="loggedIn" style="display:none" class="topButton">
<a href="login/logout.php">登出</a>
<a href="member/member_page.php">會員中心</a>    
</span>
</div>


<div class="banner">
<div class="fadein">

          <img src="homeimg/home1.png" />
          <img src="homeimg/home2.png" />
          <img src="homeimg/home3.png" />

</div>
</div>
<div class="nav">

<div class="nav_bg">
<ul>
<li><a href="about.php">關於我們</a></li>
<li><a href="travel-note/notehome.php">遊記分享</a></li>
<li><a href="match/build/step1.php">我要揪團</a></li>
<li><a href="match/group.php">我要跟團</a></li>
<li><a href="match/buddy.php">旅伴配對</a></li>
</ul>
</div>

</div>

<div class="centerBlock">

<br>
<img src="homeimg/twmap.png" style="float:right;">
<div class="tcontent">
<p class="n2">臺灣各縣市官方觀光旅遊網</p>
<a href="http://tour.klcg.gov.tw/" target="_blank">基隆旅遊網</a> | 
<a href="http://www.taipeitravel.net/" target="_blank">臺北旅遊網</a> | 
<a href="http://tour.tpc.gov.tw/tom/lang_tw/index.aspx" target="_blank">新北市觀光旅遊網</a> | 
<a href="http://tourism.e-land.gov.tw/cht/index.php?" target="_blank">宜蘭勁好玩</a>
<hr>
<a href="http://travel-taoyuan.tycg.gov.tw/" target="_blank">桃園縣觀光導覽網</a> | 
<a href="http://travel.hsinchu.gov.tw/page.aspx" target="_blank">新竹旅遊網</a> | 
<a href="http://miaolitravel.net/MainWeb/main.aspx?Lang=1" target="_blank">苗栗文化觀光旅遊網</a>
<hr>
<a href="http://tour-hualien.hl.gov.tw/Portal/?lang=0" target="_blank">花蓮觀光資訊網</a> | 
<a href="http://tour.taitung.gov.tw/zh-tw/Home/Index" target="_blank">臺東縣觀光旅遊網</a>
<hr>
<a href="http://travel.taichung.gov.tw/" target="_blank">臺中觀光旅遊網</a> | 
<a href="http://tourism.chcg.gov.tw/tc/index.aspx" target="_blank">彰化縣政府旅遊資訊網</a> | 
<a href="http://travel.nantou.gov.tw/index.aspx" target="_blank">南投觀光旅遊網</a>
<hr>
<a href="http://tour.yunlin.gov.tw/" target="_blank">雲林縣文化旅遊網</a> | 
<a href="http://travel.chiayi.gov.tw/tc/index.aspx" target="_blank">嘉義觀光旅遊網</a> | 
<a href="http://tour.tainan.gov.tw/" target="_blank">臺南觀光旅遊局</a>
<hr>
<a href="http://khh.travel/tw/default1.asp" target="_blank">高雄旅遊網</a> | 
<a href="http://i-pingtung.com/Portal/Default.aspx" target="_blank">屏東觀光旅遊網</a> | 
<a href="http://tour.penghu.gov.tw/" target="_blank">澎湖逍遙遊</a>
<hr>
</div>
<br>
<br>
</div>

<div id="footer">
Budditrip © 2014 . NCCUMIS100 . produce
</div>


</body>
</html>