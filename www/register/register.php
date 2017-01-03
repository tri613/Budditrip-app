<?php session_start() ?>
<html>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<title>Budditrip - 註冊</title>



<script src="register_check.js"></script> 


</head>

<body>
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
<a href="register.php">註冊</a>    
<a href="../login/login.php">登入</a>
</span>
<span id="loggedIn" style="display:none" class="topButton">
<a href="../login/logout.php">登出</a>
<a href="../member/member_page.php">會員中心</a>    
</span>
</div>

<div class="nav">
<div class="nav_bg">
<ul>
<li><a href="../about.php">關於我們</a></li>
<li><a href="../travel-note/notehome.php">遊記分享</a></li>
<li><a href="../matech/build/step1.php">我要揪團</a></li>
<li><a href="../match/group.php">我要跟團</a></li>
<li><a href="../match/buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>
<br />
<br />
<br />
<br />
<div class="centerBlock">
<span class="title">
註冊BuddyTrip
</span>
<form name="register" action="register_backend.php" method="post">
  
    <input name="userid" title="帳號"  id="userid" type="text" onChange="CheckUserName()" placeholder="帳號" ><span id="ErrorSpan" class="ErrorSpan"></span><br>
    <input name="password" title="密碼"  id="password" type="password" placeholder="密碼" onChange="CheckPW()"><span id="ErrorSpan_pw" class="ErrorSpan"></span><br>
    <input type="email" name="email" id="email" onChange="CheckUserEmail()" placeholder="e-mail"><span id="ErrorSpan_EMAIL"  class="ErrorSpan"></span><br>
    <input name="nickname" id="nickname"  placeholder="暱稱"><br>
    <input type="button" value="送出" onClick="SendForm()" class="button">
    <input type="reset" class="button" onClick="resetClass()">
</form>

<div class="ps">
註冊同時我們會自動寄一封驗證信到您填的信箱!<br>
記得去收ㄛ^.<
</div>

</div>

</body>
</html>