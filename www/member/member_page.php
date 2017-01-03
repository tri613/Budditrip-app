<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/top-nav-ban.css//" type="text/css">
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>個人頁面</title>
</head>

<body>
<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddiTrip</a></span>

<?php

include("../mysql.php");

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
<!--<a><?php echo $username ;?></a>-->
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
<!--<li><a href="">發表的徵旅伴文</a></li>
<li><a href="">回覆過的徵旅伴文</a></li>
<li><a href="">曾經一起出遊的朋友</a></li>-->
</ul>
</div>

<script src="../js/sideNav.js"></script>

<br />
<br />

<div class="centerBlock">
<span class="title" style="	color: #ED7234;">個人資料</span>
<br>
<?php		include("../mysql.php");
		mysql_query("SET NAMES 'utf8'");


if($_SESSION['user'] != null)
{
	echo 'Hi, '.$_SESSION['user'].'!' ;
	$userid = $_SESSION['user'];
	echo '<br>以下為您的基本資料!';
	echo'<hr width=100%>';

	$sql="SELECT * FROM user WHERE username = '$userid'";
	$result = mysql_query($sql);	

        while($row = mysql_fetch_array($result))
        {		
        		if($row['userImage']!=NULL) {echo '<img width="200px" height="auto" src="data:image/jpeg;base64,'.base64_encode( $row['userImage'] ).'"/>';}
				else{echo '<img width="150px" height="150px" src="../css/default.jpg">';;}
                echo 
				 	"<br>姓名：".$row['name'].
					"<br>暱稱：" . $row['nickname'].
					"<br>信箱：" . $row['email'] .
					"<br>性別：" . $row['gender'].
					"<br>生日：" . $row['birthday'].
					"<br>所在地：" .$row['location'].
					"<br>興趣：" . $row['interest'].
					"<br>自我介紹：" . $row['selfintro']. "<br>";

        }
}
else
{
        echo 'You do not have permission to view this page!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}

?>
<br>
<input type="button" value="更新會員資料" class="button" onClick="javascript:location.href='member_update.php'">
</div>

</body>
</html>