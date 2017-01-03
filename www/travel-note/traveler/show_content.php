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
<li><a href="notepage1.php">精彩遊記</a></li>
<span id="loggedIn-nav" style="display:none">
<li><a href="travelnote.php">發表文章</a></li>
<li><a href="../backstage.php">個人遊記空間</a></li>
</ul>
</div>
<script src="../js/sideNav.js"></script>

<br />
<br />
<div class="centerBlock2">
<br />
<?php

include ("../../mysql.php");

$no = $_GET['no'];

$sql = "SELECT * FROM travelnote WHERE note_no = '$no' ";
$result = mysql_query($sql);
?>

<div class="box">
<?php
echo '<table class="font">';

while($row = mysql_fetch_array($result)){ 

    echo'<div class="name show-n">';
	print_r($row['note_name']);
	echo'</div>';
	echo'<a class="time show-d">';
	?><img src="../image/time.png" />&nbsp;<?php print_r($row['time']);
	echo'</a>&nbsp;&nbsp;';
	echo'<a class="member show-d">';
	?><img src="../image/author.png" />&nbsp;<?php echo "作者：";print_r($row['userid']);
	echo'</a>&nbsp;&nbsp;';
	echo'<div class="cate show-d">';
	?><img src="../image/theme.png" />&nbsp;<?php echo "主題：";print_r($row['note_cate']);
	echo'</div>';
	echo'<div class="date show-d">';
	?><img src="../image/period.png" />&nbsp;<?php echo "旅行時段：";print_r($row['datefrom']);echo "&nbsp-&nbsp"; print_r($row['dateto']);	
	echo'</div>';
	echo'<div class="buddy show-d">';
	?><img src="../image/buddy.png" />&nbsp;<?php print_r("同行旅伴：".$row['note_buddy']); 
	echo '</div>';
	echo'<div class="cost show-d">';
	?><img src="../image/budget.png" />&nbsp;<?php print_r("總花費：".$row['cost']); 
	echo '</div>';

}

echo '</table>';
?>
</div>

<?php

$sql = "SELECT * FROM travelnote WHERE note_no = '$no' ";
$result = mysql_query($sql);

echo '<table class="font">';

while($row = mysql_fetch_array($result)){ 
    echo'<div class="content show-c">';
	print_r($row['note_content']); 
	echo '</div>';
	
	$note_area = $row['note_area'];	//紀錄地點
	$note_cate = explode(",",$row['note_cate']); //紀錄類型
}
echo '</table>';

?>

<hr color="#999999" size="1" />
<img src="../image/note4.png" />
<br />


<?php include( "../message/message.php" ); ?>

<?php
		if(isset($_SESSION['user']))
		{
			$sql_exist = "SELECT username FROM `click_travel_sample`
						  WHERE  username = '".$_SESSION['user']."'";
						  
			$result_exist = mysql_query($sql_exist);
			
			$row_exist = mysql_fetch_array($result_exist);
			
			if($row_exist['username'] == null)
			{
				$sql_insert = "INSERT INTO `click_travel_sample`(`username`)
								VALUES ('".$_SESSION['user']."')";
								
				$query_insert = mysql_query($sql_insert);
			}
			
			$sql_subarea = "UPDATE click_travel_sample
							SET    $note_area = $note_area+1
							WHERE username = '".$_SESSION['user']."'";
			
			$query_subarea = mysql_query($sql_subarea);
			
			if(in_array("自然生態",$note_cate))
			{
				$sql_type1 = "UPDATE click_travel_sample
							  SET	 自然生態 = 自然生態+1
							  WHERE username = '".$_SESSION['user']."'";
							  
				$query_type1 = mysql_query($sql_type1);
			}
			
			if(in_array("娛樂節慶",$note_cate))
			{
				$sql_type2 = "UPDATE click_travel_sample
							  SET	 娛樂節慶 = 娛樂節慶+1
							  WHERE username = '".$_SESSION['user']."'";
							  
				$query_type2 = mysql_query($sql_type2);
			}
			
			if(in_array("社會藝文",$note_cate))
			{
				$sql_type3 = "UPDATE click_travel_sample
							  SET	 社會藝文 = 社會藝文+1
							  WHERE username = '".$_SESSION['user']."'";
							  
				$query_type3 = mysql_query($sql_type3);
			}
			
			if(in_array("美食饗宴",$note_cate))
			{
				$sql_type4 = "UPDATE click_travel_sample
							  SET	 美食饗宴 = 美食饗宴+1
							  WHERE username = '".$_SESSION['user']."'";
							  
				$query_type4 = mysql_query($sql_type4);
			}
			
			if(in_array("健康運動",$note_cate))
			{
				$sql_type5 = "UPDATE click_travel_sample
							  SET	 健康運動 = 健康運動+1
							  WHERE username = '".$_SESSION['user']."'";
							  
				$query_type5 = mysql_query($sql_type5);
			}
			
			if(in_array("產業觀光",$note_cate))
			{
				$sql_type6 = "UPDATE click_travel_sample
							  SET	 產業觀光 = 產業觀光+1
							  WHERE username = '".$_SESSION['user']."'";
							  
				$query_type6 = mysql_query($sql_type6);
			}
		}



?>


</body>
</html>