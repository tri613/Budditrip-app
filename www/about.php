 <?php session_start(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="css/top-nav-ban.css" type="text/css">
 <link rel="stylesheet" href="css/content.css" type="text/css">
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
<br>
<br>
<br>
<br>
<div class="centerBlock">
<br>
<img src="homeimg/IMAG0764.jpg" class="about">

<div class="about1">
<p><img src="homeimg/logo.png"></p>
<p>給沒有旅伴出遊的你最刺激、最精彩的旅程！</p>
<br />
<p>From Dep. of MIS, NCCU.</p>
</div>




</div>

<div id="footer">
<p>&nbsp;</p>
<p><img src="homeimg/logo.png"></p>
<p>Budditrip © 2014 . NCCUMIS100 . produce</p>
</div>


</body>
</html>