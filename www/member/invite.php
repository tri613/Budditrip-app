<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link rel="stylesheet" href="../css/top-nav-ban.css" type="text/css">-->
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>Budditrip - 旅伴/活動邀請</title>
</head>
<body>
<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddiTrip</a></span>

<?php
		include("../mysql.php");

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

<div class="centerBlock">
<span class="title" style="	//color: #ED7234;">你邀請其他使用者成為旅伴</span>
<br>
<?php
		//echo "<h1>你邀請其他使用者成為旅伴</h1>";
		
		$a = "SELECT * FROM `friendship`
			  WHERE username ='".$_SESSION['user']."'
			  AND friendship = 'a'";
		$aa = mysql_query($a);
?>
  <?php
		echo "<form name=\"a\">";

		while($aaa = mysql_fetch_array($aa))
		{
			echo '<div class="box">';
			
			$sql = "SELECT * FROM `user`
					WHERE username = '".$aaa['friend']."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			
			$url = "../match/b.info.php?".$row['id'];
			
			if( $row['userImage'] != NULL) {
				echo '<p><img width="150px" height="150px" src="data:image/jpeg;base64,'.base64_encode( $row['userImage'] ).'"/></p>';
			}else{
				echo'<p><img width="150px" height="150px" src="../css/default.jpg"></p>';
				}
			echo "暱稱：<a href=\"$url\">".$row['nickname']."</a>";
			
			echo "</br></br>";
			echo "</div>";
		}
		
		echo "</form>";
		?>
        
        <div style="clear:left;">

        <?php
		
		echo "<h1>其他使用者邀請你成為旅伴</h1>";
		
		$b = "SELECT * FROM `friendship`
			  WHERE username = '".$_SESSION['user']."'
			  AND friendship = 'b'";
		$bb = mysql_query($b);
		
		echo "<form name='b' action='../match/answer.php' method='post'>";
		
		while($bbb = mysql_fetch_array($bb))
		{
			$sql = "SELECT * FROM `user`
					WHERE username = '".$bbb['friend']."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			
			$url = "../match/b.info.php?".$row['id'];
			
			$http='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			
			echo "暱稱：<a href=\"$url\">".$row['nickname']."</a></br>";
			echo "<input type='button' value='等待你的確認' onClick='answer()'>";
			echo '<input type="hidden" name="friend" value="'.$row['username'].'">';
			echo '<input type="hidden" name="url" value="'.$http.'">';
			
			
			echo "<br><br>";
			
			
		}
				
		echo "</form>";
		
		echo '<h1>其他使用者邀請你參加活動</h1>';
		
		$c = "SELECT * FROM `invite`
			  WHERE username = '".$_SESSION['user']."'";
		$cc = mysql_query($c);
		
		echo '<form>';
		?>

        <?php
		
		while($ccc = mysql_fetch_array($cc))
		{
			$sql = "SELECT * FROM `group`
					WHERE groupname = '".$ccc['groupname']."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			
			$url = "../match/g.info.php?".$row['id'];
			
			echo "團名：<a href=\"$url\">".$row['groupname']."</a></br>";

		}
		
?>
</div>


		<script>
		
				function answer()
				{
					b.submit();
				}
		
		</script>
</body>
</html>