<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Budditrip#精彩遊記#</title>
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
<span class="topNavText"><a href="../../index.php">BuddiTrip</a></span>


<?php

include("../../mysql.php");

  
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
<li><a href="../../about.php">關於我們</a></li>
<li><a href="../notehome.php">遊記分享</a></li>
<li><a href="../../match/build/step1.php">我要揪團</a></li>
<li><a href="../../match/group.php">我要跟團</a></li>
<li><a href="../../match/buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>
 
<div class="sideNav">
<ul class="sideNavList"> 
<li class="menuIcon">MENU</li>
<li><a href="../notehome.php">遊記首頁</a></li>
<li><a href="../traveler/notepage1.php">精彩遊記</a></li>
<span id="loggedIn-nav" style="display:none">
<li><a href="travelnote.php">發表文章</a></li>
<li><a href="../backstage.php">個人遊記空間</a></li>
</span>
</ul>
</div>
<script src="../js/sideNav.js"></script>

<?php

include ("../../mysql.php");

$query = mysql_query("SELECT * From `travelnote` Order By time DESC");
$data; 
$count = 0;
while($row = mysql_fetch_array($query)){
      $data[$count]['note_no'] = $row[0];
	$data[$count]['name'] = $row[1];
    $data[$count]['datefrom'] = $row[2];
	$data[$count]['dateto'] = $row[3];
    $data[$count]['time'] = $row[4];
	$data[$count]['cate'] = $row[5];
	$data[$count]['member'] = $row[9];
	$data[$count]['area'] = $row[10];
	$count++;
}
?>
<br />
<br />
<br />
<br />
<div class="centerBlock2">
<br />


<?php
	for($i=0; $i<count($data); $i++)
	{?>
    <div class="box2">  
    	<p class="time1"><?php print_r($data[$i]['time']); ?></p>

        <a class="author"><?php print_r($data[$i]['member']); ?></a> | 
        <a class="date">旅遊時程：<?php print_r($data[$i]['datefrom']); ?>   至  <?php print_r($data[$i]['dateto']); ?></a>
        <p class="show-n">
        <?php echo '<a href="show_content.php?no=' . $data[$i]['note_no']. '">' ;
		print_r($data[$i]['name']) . '</a>' ;
		?>
        </p>
        <a>
        <p>地點：<?php print_r($data[$i]['area']); ?></p>      
        <p>主題：<?php print_r($data[$i]['cate']); ?></p>        
        <hr />
        
        </div>
		<?php
	}?> 
    
</div>
</body>
</html>