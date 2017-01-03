<?php session_start(); ?><head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../css/content-2.css" type="text/css">    
<link rel="stylesheet" href="../../css/navigators-match.css" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<title>Budditrip - 揪團</title>
</head>


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
<li><a href="../../travel-note/notehome.php">遊記分享</a></li>
<li><a href="step1.php">我要揪團</a></li>
<li><a href="../group.php">我要跟團</a></li>
<li><a href="../buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>
<br />
<br />


<?php	
		if(!isset($_SESSION['user']))
		{
			echo '<script type="text/javascript">';
			echo 'alert ("You do not login.")';
			echo '</script>';
			echo '<meta http-equiv="refresh" content="0;url=/login/login.php">';
		}	
?>

        <div class="centerBlock">
        
         <p><img src="../img/step2.png" class="box" /></p>
        
		<div class="content">   
        	<form  id="step2" name="step2" action="step2.b.php" method="post">
        		<h3>團員性別</h3>
            	<input type="radio" name="gender" value="男">男性
            	<input type="radio" name="gender" value="女">女性
            
            	<h3>團員年齡</h3>
            	最小值：<input type="text" name="age_min">
            	最大值：<input type="text" name="age_max"></br></br>
           
            	<h3>揪團人數</h3>
            	最小值：<input type="text" name="number_min">
            	最大值：<input type="text" name="number_max"></br></br>
            
            	<h3>揪團預算</h3>
            	最小值：<input type="text" name="budget_min">
            	最大值：<input type="text" name="budget_max"></br></br>
                
                ●年齡、人數及預算若無限制，空白即可！●
                <input type="button" value="上一步" onClick="Back()">
            	<input type="button" value="下一步" onClick="Next()">
            </form>		
        </div>
        </div>
        
        <script>
			function Back()
			{
				document.location.href = "step1.php";
			}
			
			function Next()
			{
				//check anything form filled.
				step2.submit();
			}
		</script>
</body>
</html>