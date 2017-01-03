<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../css/slider_note.css" type="text/css">
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<title>管理者發表文章</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="../js/slider_note.js"></script>
  <script>
  $(function() {
    $( "#off_date" ).datepicker({dateFormat:'yy-mm-dd'});
  });
  </script>

<script src="../ckeditor/ckeditor.js"></script>

<title>管理者遊記發表</title>


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
<span class="topNavText"><a href="../index.php">BuddyTrip</a></span>

<?php

include("../../mysql.php");

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

<div class="container travelnote">

<form action='ckeditor_in3.php' method="POST">
<fieldset>

<label>
<div class="field-title">
文章標題</div>
<div class="field-text">
<input placeholder="請輸入遊記名稱" class="text-input" type="text" name="off_name" value=""/>
</div>
</label>
<hr></hr>

<label>
<div class="field-title">                
發表日期</div>
<div class="field-text">
<input name="off_date" placeholder="yyyy-mm-dd" type="text" id="off_date" /></div>


<hr></hr>

<label=>
<div class="field-title">
文章主題</div>
<select class="field-text" name="off_cate" id="off_cate">
 <option>請選擇</option>
 <option>自然景點</option>
 <option>美食饗宴</option>
 <option>藝文娛樂</option>
 <option>名勝古蹟</option>
</select>
</label>

<hr></hr>

<label>
<div class="field-title">
推薦範圍</div>
<select class="field-text" name="off_area" id="off_area">
 <option>請選擇</option>
 <option>北北基</option>
 <option>桃竹苗</option> 
 <option>宜花東</option>
 <option>中彰投</option>
 <option>雲嘉南</option>
 <option>高屏</option>
 <option>澎金馬</option>
 <option>綠島蘭嶼</option>  
</select>
</label>

<hr></hr>
                                          
<div class="field-title">
文章內容</div>
<textarea class="ckeditor" cols="80" id="editor2" name="editor2" rows="5">
</textarea>
<input type="submit" value="送出" onclick="this.form.action='ckeditor_in3.php';this.form.submit();">
<input type="button" value="返回" onclick="this.form.action='../notehome.php';this.form.submit();">
</fieldset>
</form>
</div>


</body>
</html>
