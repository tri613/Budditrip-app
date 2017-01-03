<?php session_start(); 
include("../mysql.php");

if (isset($_SESSION['user'])){
	$userid = $_SESSION['user'];
	}
else {echo "nothing" ;}

/*echo $userid;*/?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/slider_note.css" type="text/css">
<link rel="stylesheet" href="css/content.css" type="text/css">
<link rel="stylesheet" href="css/navigators.css" type="text/css">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datefrom" ).datepicker({dateFormat:'yy-mm-dd'});
  });
  $(function() {
    $( "#dateto" ).datepicker({dateFormat:'yy-mm-dd'});
  });
  
  </script>
  <script src="ckeditor/ckeditor.js"></script>
<title>修改遊記</title>

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

<body>

<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddyTrip</a></span>

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
<a href="../member/member_page.php">會員中心</a>    
</span>
</div>

<div class="sideNav">
<ul class="sideNavList"> 
<li class="menuIcon">MENU</li>
<li><a href="notehome.php">遊記首頁</a></li>
<li><a href="traveler/notepage1.php">精彩遊記</a></li>
<li><a href="official/notepage.php">推薦景點</a></li>
<li><a href="traveler/travelnote.php">發表文章</a></li>
<li><a href="backstage.php">個人遊記空間</a></li>
</ul>
</div>
<script src="js/sideNav.js"></script>


<?php

   $no = $_GET['no'];
   
   $sql= mysql_query("SELECT * FROM travelnote WHERE userid = '$userid' and note_no = '$no'");
   $row= mysql_fetch_array($sql);
   
   ?>
   
<div class="container travelnote">   
<div>
<form action='update.php' method="POST">
<fieldset>

<label>
<div>
文章標題</div>
<div>
<input placeholder="請輸入遊記名稱" class="text-input" type="text" name="note_name" value="<?php print_r($row[1]); ?>"/>
</div>
</label>
<hr></hr>

<label>
<div>                
旅遊日期</div>
<div>
<input name="datefrom" placeholder="yyyy-mm-dd" type="text" id="datefrom" value="<?php print_r ($row[2]); ?>" /></div>

                                    到 
<div>
<input name="dateto" placeholder="yyyy-mm-dd" type="text" id="dateto" value="<?php print_r ($row[3]); ?>"/></div>

<div id="date_range"></div>
<hr></hr>

<label>
<div>
文章主題</div>
<select name="note_cate" id="note_cate" value="">
<option selected="selected"><?php print_r ($row[5]); ?></option>
 <option>自然景點</option>
 <option>美食饗宴</option>
 <option>藝文娛樂</option>
 <option>名勝古蹟</option>
</select>
</label>

<hr></hr>

<label>
<div>
同行旅伴</div>
 <div class="tag-box">
 </div>
 <input placeholder="請輸入好友帳號或暱稱" class="text-input" type="text" name="note_buddy" id="note_buddy" value="<?php print_r ($row[6]); ?>" />
</label>

<label>
<div>
總花費</div>
 <select name="cost" id="cost" value="">
 <option selected="selected"><?php print_r ($row[7]); ?></option>
 <option>0 ~ 1000元</option>
 <option>1000 ~ 2000元</option>
 <option>2000 ~ 3000元</option>
 <option>3000 ~ 5000元</option>
 <option>5000元 ~ </option>
 </select>
</label>

                                          
<div>
文章內容</div>
<textarea class="ckeditor" id="editor" name="editor" value=""><?php print_r ($row[8]); ?>
</textarea>
<input type="submit" value="完成修改" onclick="this.form.action='update.php?no2=<?php echo $row[0];?>';this.form.submit();">
<input type="button" value="取消修改" onclick="this.form.action='backstage.php';this.form.submit();">
</fieldset>
</form>
</div>


</body>
</html>
