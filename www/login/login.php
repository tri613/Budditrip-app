<?php session_start() ?>
<html>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
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
<a href="../register/register.php">註冊</a>    
<a href="login.php">登入</a>
</span>
<span id="loggedIn" style="display:none" class="topButton">
<a href="logout.php">登出</a>
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
登入BuddyTrip
</span>
<form name="login" action="login_backend.php" method="post" class="table">
<input type="text" name="username"  class="beforeInput"  placeholder="帳號"><br>
<input type="password" name="password"  class="beforeInput"  placeholder="密碼"><br>
<input type="submit" class="button"><input type="reset" class="button"><br>
</form>

<div class="ps">
還沒有帳號？<a href="../register/register.php">註冊</a><br>
</div>
</div>


</body>
</html>