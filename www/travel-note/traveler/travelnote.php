<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../css/slider_note.css" type="text/css">
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<title>發表文章</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="../js/slider_note.js"></script>
  <script>
  $(function() {
    $( "#datefrom" ).datepicker({dateFormat:'yy-mm-dd'});
  });
  $(function() {
    $( "#dateto" ).datepicker({dateFormat:'yy-mm-dd'});
  });
   </script>
   <script src="../ckeditor/ckeditor.js"></script>

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


<div class="container travelnote">
<div>發表日期： 
<?php  date_default_timezone_set('Asia/Taipei');
       $today = date("Y-m-d H:i:s");
	   echo $today;
	   ?>
       </div> 
<form action='ckeditor_in2.php' method="POST">
<fieldset>

<label>
<div class="field-title">
文章標題</div>
<div class="field-text">
<input placeholder="請輸入遊記名稱" class="text-input" type="text" name="note_name" value=""/>
</div>
</label>
<hr></hr>

<label>
<div class="field-title">                
旅遊日期</div>
<div class="field-text">
<input name="datefrom" placeholder="yyyy-mm-dd" type="text" id="datefrom" />
                                    到 
<input name="dateto" placeholder="yyyy-mm-dd" type="text" id="dateto" /></div>

<div id="date_range"></div>
<hr></hr>

<label>
<div>
文章主題 (可複選)</div>
 <input type="checkbox" name="note_cate[]" value="自然生態">自然生態
 <input type="checkbox" name="note_cate[]" value="娛樂節慶">娛樂節慶
 <input type="checkbox" name="note_cate[]" value="社會藝文">社會藝文
 <input type="checkbox" name="note_cate[]" value="美食饗宴">美食饗宴
 <input type="checkbox" name="note_cate[]" value="健康運動">健康運動
 <input type="checkbox" name="note_cate[]" value="產業觀光">產業觀光
</label>
<hr></hr>

<label>
<div>
旅遊區域</div>
<select name="note_area">
<option>請選擇</option>
<option>臺北</option>
<option>新北</option>
<option>基隆</option>
<option>桃園</option>
<option>新竹</option>
<option>苗栗</option> 
<option>臺中</option>
<option>彰化</option>
<option>南投</option>
<option>雲林</option>
<option>嘉義</option>
<option>臺南</option>
<option>高雄</option>
<option>屏東</option>
<option>宜蘭</option>
<option>花蓮</option>
<option>臺東</option>
<option>澎湖</option> 
<option>金門</option>
<option>馬祖</option>
</select>
</label>
<hr></hr>

<label>
<div class="field-title">
同行旅伴</div>
 <div class="field-text">
 <div class="tag-box">
 </div>
 <input placeholder="請輸入好友帳號或暱稱" class="text-input" type="text" name="note_buddy" id="note_buddy" value="" />
</label>

<hr></hr>


<label>
<div>
總花費</div>
<div>
<select name="cost">
 <option selected="selected">0 ~ 1000元</option>
 <option>1000 ~ 2000元</option>
 <option>2000 ~ 3000元</option>
 <option>3000 ~ 5000元</option>
 <option>5000元 ~ </option>
</select>
</label>
<hr></hr>

                                          
文章內容</div>
<textarea class="ckeditor" cols="80" id="editor" name="editor" rows="5">
</textarea>
<input type="submit" value="送出" onclick="this.form.action='ckeditor_in2.php';this.form.submit();">
<input type="button" value="返回" onclick="this.form.action='../notehome.php';this.form.submit();">
</form>
</div>


</body>
</html>
