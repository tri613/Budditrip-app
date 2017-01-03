<html>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/input.css" type="text/css">
<title>Budditrip - 註冊</title>



<script src="register_check.js"></script> 


</head>

<body>

<div class="topNav">
<div class="topNavText">
<a href="../index.php">BuddyTrip</a>
</div>
</div>

<div class="centerBlock">
<span class="title">
註冊BuddyTrip
</span>
<form name="register" action="register_backend.php" method="post">
  
    <input name="userid" title="帳號"  id="userid" type="text" onChange="CheckUserName()" placeholder="帳號" ><span id="ErrorSpan" class="ErrorSpan"></span><br>
    <input name="password" title="密碼"  id="password" type="password" placeholder="密碼" onChange="CheckPW()"><span id="ErrorSpan_pw" class="ErrorSpan"></span><br>
    <input type="email" name="email" id="email" onChange="CheckUserEmail()" placeholder="e-mail"><span id="ErrorSpan_EMAIL"  class="ErrorSpan"></span><br>
    <input type="button" value="送出" onClick="SendForm()" class="button">
    <input type="reset" class="button" onClick="resetClass()">
</form>

<div id='test'></div>


<div class="ps">
註冊同時我們會自動寄一封驗證信到您填的信箱!<br>
記得去收ㄛ^.<
</div>
</div>

</body>
</html>