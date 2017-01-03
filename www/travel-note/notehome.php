<?php session_start();?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Budditrip#遊記分享平台#</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../js/slider_note.js"></script>
<link rel="stylesheet" href="css/slider_note.css" type="text/css">
<link rel="stylesheet" href="css/content.css" type="text/css">
<link rel="stylesheet" href="css/navigators.css" type="text/css">

<style type="text/css">

#header{
	text-align:center;
	font-family:"微軟正黑體";
	font-size:18px;
	background-color:#FF9;		
}


</style>

</head>
<body>

<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddiTrip</a></span>

<?php
include("../mysql.php");


if (isset($_SESSION['user'])){
  $userid = $_SESSION['user'];
  
  //echo "Hi，".$userid."!";
}

else {
  //echo "Hi, 遊客！" ;
  }
   
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
<a href="../login/login.php">登入</a>
</span>
<span id="loggedIn" style="display:none" class="topButton">
<a href="../login/logout.php">登出</a>
<a href="../member/member_page.php">會員中心</a>    
</span>
</div>

<div class="nav">
<div class="nav_bg">
<ul>
<li><a href="../about.php">關於我們</a></li>
<li><a href="notehome.php">遊記分享</a></li>
<li><a href="../match/build/step1.php">我要揪團</a></li>
<li><a href="../match/group.php">我要跟團</a></li>
<li><a href="../match/buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>
 
<div class="sideNav">
<ul class="sideNavList"> 
<li class="menuIcon">MENU</li>
<li><a href="notehome.php">遊記首頁</a></li>
<li><a href="traveler/notepage1.php">精彩遊記</a></li>
<span id="loggedIn-nav" style="display:none">
<li><a href="traveler/travelnote.php">發表文章</a></li>
<li><a href="backstage.php">個人遊記空間</a></li>
</span>
</ul>
</div>
<script src="../js/sideNav.js"></script>

<br />
<?php
/*
    $sql = "SELECT * FROM user_authority WHERE userid = '$userid' ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $auth = $row['authority']; 
	
if($auth == 1){
	echo '<script>';
echo ' window.onload = function() {document.getElementById("new").style.display="";} ;';
echo ' </script> ';
	}
*/
?>

<div class="container">
	
<div id="abgneBlock">
		<ul class="list">
    	<li><a href="" target="_blank"><img src="image/1.png" 
onMouseOut="this.src='image/1.png'" 
onMouseOver="this.src='image/1-1.png'"></a></li>
		<li><a href="" target="_blank"><img src="image/2.jpg" 
onMouseOut="this.src='image/2.jpg'" 
onMouseOver="this.src='image/2-1.png'"></a></li>
		<li><a href="" target="_blank"><img src="image/3.png" 
onMouseOut="this.src='image/3.png'" 
onMouseOver="this.src='image/3-1.png'"></a></li>
        <li><a href="" target="_blank"><img src="image/4.png" 
onMouseOut="this.src='image/4.png'" 
onMouseOver="this.src='image/4-1.png'"></a></li>
		</ul>
	</div>
<br />

<?php

include("../mysql.php");

$sql = mysql_query("Select * From travelnote Order by note_no DESC Limit 6");
$data; 
$count = 0;
while($row = mysql_fetch_array($sql)){
    $data[$count]['note_no'] = $row[0];
	$data[$count]['name'] = $row[1];
    $data[$count]['datefrom'] = $row[2];
	$data[$count]['dateto'] = $row[3];
    $data[$count]['time'] = $row[4];
	$data[$count]['cate'] = $row[5];
	$data[$count]['buddy'] = $row[6];
	$data[$count]['cost'] = $row[7];
	$data[$count]['content'] = $row[8];
	$data[$count]['member'] = $row[9];
	$data[$count]['area'] = $row[10];
	$count++;
}

?>
<div class="centerBlock">
   <img src="image/note1.png" /><br />
<table class="TN-table">
  <tr>
    <td class="tableTitle">發表日期</td>
    <td class="tableTitle">標題名稱</td>
    <td class="tableTitle">作者</td>
    <td class="tableTitle">旅遊地點</td>
    <td class="tableTitle">主題</td>
  </tr>

<?php
   for($i=0; $i<count($data); $i++)
   {
	   ?>
       <td>
        <?php echo($data[$i]['time']) ; ?> 
        </td>

    <td>
    <?php echo '<a href="../click-counter.php?no=' . $data[$i]['note_no']. '">' ;
		echo($data[$i]['name']) . '</a>' ;
   ?>
    </td>
    <td >
       <?php echo($data[$i]['member']) ; ?>
    </td>
    <td>
    <?php echo($data[$i]['area']) ; ?>
    </td>
    <td>
    <?php echo($data[$i]['cate']) ; ?>
    </td>
    
    </tr>
    
<?php
   }
   ?>   
    </table>


<?php    

include("../mysql.php");

$sql2=mysql_query("SELECT *, A2.note_no, COUNT(message) AS times 
                  FROM travelnote A1, mes_note A2
				  WHERE A1.note_no=A2.note_no
				  Group by A2.note_no 
				  Order by times DESC Limit 6");

$data2;
$count2=0;				  
while($row2=mysql_fetch_array($sql2)){
	$data2[$count2]['note_no']=$row2[0];
    $data2[$count2]['note_name']=$row2[1];
	$data2[$count2]['time']=$row2[4];
    $data[$count]['cate'] = $row[5];
	$data2[$count2]['userid']=$row2[9];
	$data[$count]['area'] = $row[10];
	$count2++;
}

?> 
   <br />
   <img src="image/note2.png" /><br />
  <table class="TN-table2">
   <tr>
   <td class="tableTitle2">發表日期</td>
   <td class="tableTitle2">標題名稱</td>
   <td class="tableTitle2">作者</td>
   <td class="tableTitle2">旅遊地點</td>
   <td class="tableTitle2">主題</td>
   </tr>
    
    <tr>
<?php

   for($i=0; $i<count($data2); $i++)
   {
	   ?>
     <td>
        <?php echo($data2[$i]['time']) ; 
			  echo $data2[$i]['note_no'] ;?> 
     </td>
        
     <td>
    <?php 
	if($data2[$i]['userid']=='admin'){
	   echo '<a href="../click-counter.php?no=' . $data2[$i]['note_no']. '">' ;
	   echo($data2[$i]['note_name']) . '</a>' ;
	}else{
	   echo '<a href="../click-counter.php?no=' . $data2[$i]['note_no']. '">' ;
	   echo($data2[$i]['note_name']) . '</a>' ;

		}
   ?>
    </td>
    <td >
       <?php echo($data2[$i]['userid']) ; ?>
    </td>
        <td>
    <?php echo($data[$i]['area']) ; ?>
    </td>
    <td>
    <?php echo($data[$i]['cate']) ; ?>
    </td>
  </tr>

  <?php
   }
   ?>
   
   

</table>
</div>

</div>

<div id="footer">
<p>&nbsp;</p>
<p><img src="../homeimg/logo.png"></p>
<p>Budditrip © 2014 . NCCUMIS100 . produce</p>
</div>

</body>
</html>
