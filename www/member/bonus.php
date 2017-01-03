<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/top-nav-ban.css" type="text/css">
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>Budditrip - 紅利點數</title>
</head>

<body>

<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddiTrip</a></span>

<?php

include("../mysql.php");

if(isset($_SESSION['user'])){
$userid = $_SESSION['user'] ;
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
<li><a href="../travel-note/notehome.php">遊記</a></li>
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


<div class="centerBlock" style="font-family: 微軟正黑體">

<?php	include("../mysql.php"); 
		//SESSION['username'] = "fj88071";
?>
    
	<div id="coupon">
    <b class="title">優惠券兌換</b>
    <form action="/bonus.b.php" method="post">
<?php 	$sql = "SELECT * 
				FROM	`coupon_info`";	
		$result = mysql_query($sql);		?>    
    	<table border="1">
<?php 		
			
			echo '<tr>';
			
			while($row = mysql_fetch_array($result))
			{	
					echo '<td align="center" width="100">';
					echo '<img src="../member/'.$row[3].'"></br></br>';
					echo '<span>'.$row[1].'</span></br></br>';
					echo '<span>紅利：'.$row[2].'點</span></br></br>';
					echo '<input type="button" value="兌換" onClick="exchange('.$row[0].','.$row[2].')">';
			}
			
			echo '</tr>'; ?>
    	</table>  
        </form>         
	</div>
    
    <div id="amount">
    	<b>您擁有的紅利</b>
        <?php 
			$bonus = "SELECT * FROM `bonus`
						WHERE username = '$userid' ";
			$bonus_1 = mysql_query($bonus);
			$numBonus = mysql_num_rows($bonus_1);

			if($numBonus!=0){
				while($bonus_2 = mysql_fetch_array($bonus_1))
				{
					echo '共有'.$bonus_2[1].'點';
				} 
			}else{
				echo '0點';
			}

			?>
        
        <br>
        <b>擁有的優惠券</b>
        <br>
        <?php 
		
			$coupon = "SELECT * FROM `coupon`
						WHERE username = '$userid' ";
			$coupon_1 = mysql_query($coupon);
			$numCoupon = mysql_num_rows($coupon_1);

			if($numCoupon!=0){
				while($coupon_2 = mysql_fetch_array($coupon_1))
				{
					echo '優惠券ID:'.$coupon_2[1].'   共有'.$coupon_2[2].'張</br></br>';
				}
			}else{
				echo '目前沒有優惠卷喔!';
			}
			//echo '以下空白';
		?>
        
    </div>
    </div>
    <script>
		function exchange(coupon_id, points)
		{
			var w = coupon_id;
			alert (w + '   ' +points);
		}
	</script>
    
</body>
</html>