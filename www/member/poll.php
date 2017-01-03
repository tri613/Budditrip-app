<?php session_start(); ?>

<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>Budditrip - 您的旅伴/參加的團</title>
</head>
<body>
<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddiTrip</a></span>
<?php
if(isset($_SESSION['user'])){
$username = $_SESSION['user'];
echo '<script>';
echo ' window.onload = function() {document.getElementById("loggedIn").style.display="";} ;';
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
<?php //echo $username ;?>
<a href="../login/logout.php">登出</a>
<a href="member_page.php">會員中心</a>   
</span>
</div>

<div class="nav">
<div class="nav_bg">
<ul>
<li><a href="../about.php">關於我們</a></li>
<li><a href="../travel-note/notehome.php">遊記分享</a></li>
<li><a href="../match/build/step1.php">我要揪團</a></li>
<li><a href="../match/group.php">我要跟團</a></li>
<li><a href="../match/buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>

<div class="sideNav">
<ul class="sideNavList"> 
<li class="menuIcon">MENU</li>
<li><a href="member_page.php">個人資料頁面</a></li>
<li><a href="../travel-note/backstage.php">個人遊記空間</a></li>
<li><a href="bonus.php">紅利點數兌換</a></li>
<li><a href="invite.php">旅伴 & 跟團邀請</a></li>
<li><a href="groups.php">我的旅伴 & 旅團</a></li>
</ul>
</div>


<script src="../js/sideNav.js"></script>



<div class="centerBlock">
<?php
$id = $_GET['id'];
echo '<form name="star" method="post" action="poll_BE.php?id=' . $id . '">';

//撈團員資訊 + 加選項
include("../mysql.php");

$titleResult = mysql_query("SELECT groupname FROM `group` WHERE id = '$id'");
$title = mysql_result($titleResult, 0);

echo '<span class="title" style="	color: #ED7234;">' .$title . '－－滿意度填寫</span>';
echo "<br>以下顯示此團除了自己以外的旅伴<br>";

$sql = "SELECT member.username FROM `member`, `group`
		WHERE member.groupname = group.groupname AND group.id = '$id'";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
	if($row[0] != $username){
	echo $row[0]."&nbsp&nbsp";	
	echo "<select name='". $row[0] ."'>";
?>
	 <option value="1">1</option>
	 <option value="2">2</option>
	 <option value="3">3</option>
	 <option value="4">4</option>
	 <option value="5">5</option>
	 </select>
	 <br>

<?php
	}
}
?>

<input type="submit" value="send">
</form>

</div>
</body>
</html>