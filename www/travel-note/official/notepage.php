<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Budditrip#推薦景點#</title>
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
<li><a href="../official/notepage.php">推薦景點</a></li>
<span id="loggedIn-nav" style="display:none">
<li><a href="../traveler/travelnote.php">發表文章</a></li>
<li><a href="../backstage.php">個人遊記空間</a></li>
</span>
</ul>
</div>
<script src="../js/sideNav.js"></script>

<?php

include ("../../mysql.php");

$query = mysql_query("SELECT * From `official`");
$data; 
$count = 0;
while($row = mysql_fetch_array($query)){
    $data[$count]['off_no'] = $row[0];
	$data[$count]['off_name'] = $row[1];
    $data[$count]['off_date'] = $row[2];
	$data[$count]['off_cate'] = $row[3];
    $data[$count]['off_area'] = $row[4];
	$data[$count]['off_content'] = $row[5];
	$count++;
}
?>

<div class="centerBlock">
<br />
<div align="center">
<img src="../image/note5.png"  />
</div>

    <table class="NP-table2" border="1">
<?php
	for($i=0; $i<count($data); $i++)
	{?>
    	<tr>
        <td width="500" class="name" bgcolor="#FFCCCC">
        <?php echo '<a href="../../click-counter/click-count_offiNote.php?no=' . $data[$i]['off_no']. '">' ;
		print_r($data[$i]['off_name']) . '</a>' ;
		?>
        </td>
        <td width="300" class="date">發表日期   <?php print_r($data[$i]['off_date']); ?></td>

		</tr>
        <tr>
        <td width="100">分類： <?php print_r($data[$i]['off_cate']); ?></td>
        <td width="100">地區： <?php print_r($data[$i]['off_area']); ?></td>
		</tr>
		<?php
	}?> 
       
    
    </table>

</div>
</body>
</html>