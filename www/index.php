<?php session_start(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="css/top-nav-ban-home.css" type="text/css">
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
<?php if(isset($_SESSION['user'])){
	echo 'Hi, '.$_SESSION['user'].'! Welcome to BuddiTrip!';
   }else{
   	echo'Welcome to BuddiTrip!';
   }
?>
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
<br/>
<p class="n">＂快來蒐集你的私密旅遊景點！＂</p>
<p>
<a href="http://tourism.e-land.gov.tw/cht/index.php?" target="_blank"><img src="homeimg/mid1.png" class="box1" 
onMouseOut="this.src='homeimg/mid1.png'" 
onMouseOver="this.src='homeimg/mid1-1.png'" alt="宜蘭勁好玩"></a>

<a href="http://travel.taichung.gov.tw/" target="_blank"><img src="homeimg/mid2.png" class="box1" 
onMouseOut="this.src='homeimg/mid2.png'" 
onMouseOver="this.src='homeimg/mid2-1.png'" alt="台中觀光旅遊網"></a>

<a href="http://tour-hualien.hl.gov.tw/Portal/?lang=0" target="_blank"><img src="homeimg/mid3.png" class="box1" 
onMouseOut="this.src='homeimg/mid3.png'" 
onMouseOver="this.src='homeimg/mid3-1.png'" alt="花蓮觀光資訊網"></a>
</p>
<p>
<a href="http://www.taipeitravel.net/" target="_blank"><img src="homeimg/mid4.jpg" class="box2" 
onMouseOut="this.src='homeimg/mid4.jpg'" 
onMouseOver="this.src='homeimg/mid4-1.png'" alt="台北旅遊網"></a>

<a href="http://khh.travel/tw/default1.asp" target="_blank"><img src="homeimg/mid5.png" class="box2" 
onMouseOut="this.src='homeimg/mid5.png'" 
onMouseOver="this.src='homeimg/mid5-1.png'" alt="高雄旅遊網"></a>
</p>

<p>
<a href="http://miaolitravel.net/MainWeb/main.aspx?Lang=1" target="_blank"><img src="homeimg/mid6.png" class="box1" 
onMouseOut="this.src='homeimg/mid6.png'" 
onMouseOver="this.src='homeimg/mid6-1.png'" alt="苗栗文化觀光旅遊網"></a>

<a href="http://travel.nantou.gov.tw/index.aspx" target="_blank"><img src="homeimg/mid7.png" class="box1" 
onMouseOut="this.src='homeimg/mid7.png'" 
onMouseOver="this.src='homeimg/mid7-1.png'" alt="南投觀光旅遊網"></a>

<a href="http://travel.hsinchu.gov.tw/page.aspx" target="_blank"><img src="homeimg/mid8.png" class="box1" 
onMouseOut="this.src='homeimg/mid8.png'" 
onMouseOver="this.src='homeimg/mid8-1.png'" alt="新竹旅遊網"></a>

<p class="n1"><a href="tormore.php" target="_blank">★ 獲得更多資訊</a></p>
</div>


<div id="footer">
<p>&nbsp;</p>
<p><img src="homeimg/logo.png"></p>
<p>Budditrip © 2014 . NCCUMIS100 . produce</p>
</div>

</body>



</html>