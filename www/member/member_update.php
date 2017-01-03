<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/top-nav-ban.css" type="text/css">
<link rel="stylesheet" href="../css/content.css" type="text/css">
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>會員資料修改</title>
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

<script>

function add() {
	
var c = document.getElementsByName("interest");
var v =[];
var j =0 ;

for(i=0;i<c.length;i++)
{	
   if(c[i].checked == true )
   {   
       v[j]  = c[i].value;
	   j++;
   }
}

document.getElementById('show').innerHTML = v ;
/*
var other = document.getElementById("other_interest").value;

if(other!=""){
	document.getElementById('show').innerHTML = v + ',' + other;
	}
else{document.getElementById('show').innerHTML = v ;
	}

*/

}
</script>

<br />
<br />

<div class="centerBlock">
<span class="title">個人資料更新</span>
<br>

<?php 	include("../mysql.php");
$userid = $_SESSION['user'];
echo '帳號：'.$_SESSION['user'];


$sql="SELECT * FROM user WHERE username = '$userid'";
$result = mysql_query($sql);    
while($row = mysql_fetch_array($result))
    {
       $year = substr($row['birthday']  ,0,4);
       $month= substr($row['birthday']  ,5,2);
       $date = substr($row['birthday']  ,8,2);

       echo '<div id="year" style="display:none">' . $year . '</div>';
       echo '<div id="month" style="display:none">' . $month . '</div>';
       echo '<div id="date" style="display:none">' . $date . '</div>';
    }
?>

<!--
<form enctype="multipart/form-data" method="post" action="member_up_BE.php">
    <input type="submit"  class="button" value="上傳"/>
</form>
-->

<div style="font-family:微軟正黑體">
<form  name="_match" enctype="multipart/form-data" method="post" action="member_up_BE.php">若要改密碼，請輸入新密碼：<input type="password" name="new_pw"><br>
若要改信箱，請輸入新e-mail：<input type="email" name="email"><br>

<hr width="100%">
上傳頭像：<input type="file" name="image" /> <br>
姓名：<input name="name"  type="text"><br>
暱稱：<input name="nickname"  type="text"><br>
手機：<input type="mobile" name="mobile"><br>
性別：<input type="radio" name="gender" value="男">男性
    <input type="radio" name="gender" value="女">女性<br>
生日：
<select class="sel_year" name="year"></select>年
<select class="sel_month" name="month"></select>月
<select class="sel_day" name="day"></select>日
    <script src="birthday.js"></script>
    <script type="text/javascript">
    $(function () { 
        $.ms_DatePicker({ 
            YearSelector: ".sel_year", 
            MonthSelector: ".sel_month", 
            DaySelector: ".sel_day" 
        }); 
    }); 
	
	
	n = new Array();v = new Array();
		
				n[1] = ["臺北","新北","基隆"];
				n[2] = ["桃園","新竹","苗栗"];
				n[3] = ["臺中","彰化","南投"];
				n[4] = ["雲林","嘉義","臺南"];
				n[5] = ["高雄","屏東"];
				n[6] = ["宜蘭","花蓮","臺東"];
				n[7] = ["澎湖","金門","馬祖"];
		
				v[1] = ["臺北","新北","基隆"];
				v[2] = ["桃園","新竹","苗栗"];
				v[3] = ["臺中","彰化","南投"];
				v[4] = ["雲林","嘉義","臺南"];
				v[5] = ["高雄","屏東"];
				v[6] = ["宜蘭","花蓮","臺東"];
				v[7] = ["澎湖","金門","馬祖"];
		
				function goto(index)
				{
					for(var i=0;i<n[index].length;i++)
					{
						document._match.location.options[i]
						= new Option(n[index][i],v[index][i]);
					}
					document._match.location.length = n[index].length;
				}
    </script>
<!--
生日：<input name="year" placeholder="請輸入西元年">
     </select>
        <select name="month">
            <option value="">月</option>
            <option value="01">01</option><option value="02">02</option>
            <option value="03">03</option><option value="04">04</option>
            <option value="05">05</option><option value="06">06</option>
            <option value="07">07</option><option value="08">08</option>
            <option value="09">09</option><option value="10">10</option>
            <option value="11">11</option><option value="12">12</option>
            </select>
        <select name="day">
            <option value="">日</option>
            <option value="01">01</option><option value="02">02</option>
            <option value="03">03</option><option value="04">04</option>
            <option value="05">05</option><option value="06">06</option>
            <option value="07">07</option><option value="08">08</option>
            <option value="09">09</option><option value="10">10</option>
            <option value="11">11</option><option value="12">12</option>
            <option value="13">13</option><option value="14">14</option>
            <option value="15">15</option><option value="16">16</option>
            <option value="17">17</option><option value="18">18</option>
            <option value="19">19</option><option value="20">20</option>
            <option value="21">21</option><option value="22">22</option>
            <option value="23">23</option><option value="24">24</option>
            <option value="25">25</option><option value="26">26</option>
            <option value="27">27</option><option value="28">28</option>
            <option value="29">29</option><option value="30">30</option>
            <option value="31">31</option>
            </select><br>
        -->
<br>
所在地：
<select id="place" name="place" onChange="goto(this.selectedIndex)">
            	<option value="">請選擇</option>
                <option value="北北基">北北基</option>
                <option value="桃竹苗">桃竹苗</option>
                <option value="中彰投">中彰投</option>
                <option value="雲嘉南">雲嘉南</option>
                <option value="高屏">高屏</option>
                <option value="宜花東">宜花東</option>
                <option value="澎金馬">澎金馬</option>
            </select>
             <select name="location" id="location">
            	<option value="">請選擇</option>
            </select>
<br>    
興趣：<div id="show"></div>
<input type="checkbox" name="interest[]" value="音樂" onChange="add()">音樂
<input type="checkbox" name="interest[]" value="美食" onChange="add()">美食
<input type="checkbox" name="interest[]" value="運動" onChange="add()">運動
<input type="checkbox" name="interest[]" value="閱讀" onChange="add()">閱讀
<input type="checkbox" name="interest[]" value="電影" onChange="add()">電影
<input type="checkbox" name="interest[]" value="美術" onChange="add()">美術 
<!--<input type="text" name="interest"><br>
-
->
<!--其他：<input name="interest"  type="text" id="other_interest" onChange="add()"><br>-->
<br>
自我介紹： <textarea name="selfintro"></textarea><br>
<input value="送出" type="submit" class="button">
<input value="取消" type="button" class="button" onClick="this.form.action='member_page.php';this.form.submit();">
</form>
</div>
</div>
</body>
</html>