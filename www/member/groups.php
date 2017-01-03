<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/top-nav-ban.css" type="text/css">
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>Budditrip - 您的旅伴/參加的團</title>
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

<br />
<br />
<div class="centerBlock">

<?php
		echo "<h1>旅伴清單</h1>";
		
		$_sql = "SELECT * FROM `friendship`
				WHERE username = '".$_SESSION['user']."'
				AND friendship = 'c'";
		$_result = mysql_query($_sql);
		
		while($_row = mysql_fetch_array($_result))
		{
			$__sql = "SELECT * FROM `user`
					WHERE username = '".$_row['friend']."'";
					
			$__result = mysql_query($__sql);
			
			$__row = mysql_fetch_array($__result);
			
			$url = "../../match/b.info.php?".$__row['id'];
			
			echo '暱稱：<a href="'.$url.'">'.$__row['nickname'].'</a><br>';
			
			
		}
		
		echo "<br>";

?>


<span class="title" style="	color: #ED7234;">正在參加的旅團</span>
<br>
<?php
//$sql = "SELECT member.groupname, group.date FROM 'member', 'group' 
//		WHERE member.groupname = group.groupname AND member.username = '$username' ";
$timeNow = time();

$sql = "SELECT member.groupname, group.date,group.id FROM `member`, `group`
		WHERE member.groupname = group.groupname AND member.username = '$username' ";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
	$compare = $timeNow - strtotime($row[1]);
	if($compare <= 0){
		echo " <a href='../match/g.info.php?" . $row[2] . "'>" . $row[0]. "</a><br>";	
	}
}
?>

<br>
<span class="title" style="	color: #ED7234;">曾經參加的旅團</span>
<br>
<?php
$sql = "SELECT member.groupname, group.date, group.id FROM `member`, `group`
		WHERE member.groupname = group.groupname AND member.username = '$username' ";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
	$compare = $timeNow - strtotime($row[1]);
	if($compare >=0 ){
		//echo strtotime($row[1]);
		//echo '<br>' . $timeNow;
		echo " <a href='../match/g.info.php?" . $row[2] . "'>" . $row[0]. "</a>&nbsp&nbsp&nbsp";
		
		$find = mysql_query("SELECT writer FROM poll WHERE id='$row[2]' AND writer='$username'");
		$done = mysql_num_rows($find); 
		if($done == 0){ //還沒填過
			echo "<input type='button' value='填寫問卷' onClick=' gotoPoll(".$row[2] .")'><br>";
		}else{
			echo "<input type='button' value='已填過問卷' disabled='disabled'><br>";
		}
	}
}
?>

<script type="text/javascript">

function gotoPoll(id){
	window.location.href="poll.php?id="+ id ;
}

</script>
	
</body>
</html>