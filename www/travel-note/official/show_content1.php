<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/slider_note.js"></script>
<link rel="stylesheet" href="../css/slider_note.css" type="text/css">
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
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
</head>

<body>

<div class="topNav">
<span class="topNavText"><a href="../../index.php">BuddyTrip</a></span>

<?php
include("../../mysql.php");


if (isset($_SESSION['user'])){
  $userid = $_SESSION['user'];
  
}

if(isset($_SESSION['user'])){
echo '<script>';
echo ' window.onload = function() {document.getElementById("loggedIn").style.display="";} ;';
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

<div class="nav">
<div class="nav_bg">
<ul>
<li><a href="#">關於我們</a></li>
<li><a href="http://localhost/travel-note/notehome.php">遊記</a></li>
<li><a href="http://localhost/match/build/step1.php">我要揪團</a></li>
<li><a href="http://localhost/match/group.php">我要跟團</a></li>
<li><a href="http://localhost/match/buddy.php">配對</a></li>
</ul>
</div>
</div>
 
<div class="sideNav">
<ul class="sideNavList"> 
<li class="menuIcon">MENU</li>
<li><a href="../notehome.php">遊記首頁</a></li>
<li><a href="../traveler/notepage1.php">精彩遊記</a></li>
<li><a href="notepage.php">推薦景點</a></li>
<li><a href="../traveler/travelnote.php">發表文章</a></li>
<li><a href="../backstage.php">個人遊記空間</a></li>
</ul>
</div>
<script src="../js/sideNav.js"></script>



<div class="centerBlock">
<br />
<?php

include ("../../mysql.php");

$no = $_GET['no'];

$sql = "SELECT * FROM official WHERE off_no = '$no' ";
$result = mysql_query($sql);

echo '<table class="font">';

while($row = mysql_fetch_array($result)){ 
  
    echo'<div class="name show-n">';
	print_r($row['off_name']);
	echo'</div>';
	echo'<div class="date show-d">';
	print_r($row['off_date']);
	echo'</div>';
	echo'<div class="area show-d">';
	echo'Location:';
	print_r($row['off_area']);	
	echo'</div>';
    echo'<div class="content show-c">';
	print_r($row['off_content']); 
	echo '</div>';
}


echo '</table>';
?>

<br />
<hr color="#999999" size="1" />
<img src="../image/note4.png" />
<br />

<?php include( "../message/message1.php" ); ?>



</body>
</html>