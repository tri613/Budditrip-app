 <?php
session_start();
include("../mysql.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/top-nav-ban.css" type="text/css">
<link rel="stylesheet" href="chat.css" type="text/css">

<script type="text/javascript" src="jquery.js"></script>
<title>Budditrip Chatroom</title>
</head>
 <?php
function get_SQL($a,$b)    //用來抓資料表的通用函數
{
	    //echo $a;
	    $ret = mysql_query($a); 
		$r="";
		while($row = mysql_fetch_row($ret))
		{
			$r=$row[$b];
			
        }
		return $r;
}



function add_SQL($a)
{ 
       
		$sql=$a;
		$ret = mysql_query($sql); 
		$sn = mysql_insert_id();
		
		return $sn;
}



?>



<script language="javascript">

function startTime()
{
  var uid=<?php echo $_GET["gid"]?>;;
  $.post("show.php", {uid : uid}, function(result){
  $("#LV").html(result);
        });
  setTimeout('startTime()',3000);
}


function save()
{
    var PS=document.getElementById('PS').value;
	var uid=document.getElementById('H1').value;
	if(PS == "")
	{
	   alert("未填寫發言內容");
	}
   else
   {
     $.post("show.php", {PS : PS,uid : uid}, function(result){
     $("#LV").html(result);
        });
	}
	document.getElementById('PS').value="";
}

</script>


<div class="topNav">
<span class="topNavText"><a href="../index.php">BuddyTrip</a></span>

<?php

include("../mysql.php");

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

<body onLoad="startTime();">


 <div class="centerBlock" >
<p class="title"><?php echo  get_SQL("SELECT * FROM `group` WHERE id=".$_GET["gid"],2); ?>聊天室</p>
<p>
  <?php
$IP=$_SERVER['REMOTE_ADDR'];
date_default_timezone_set('Asia/Taipei');
$DD=date("Y")."-".date("m")."-".date("d")." ".date("h").":".date("i").":".date("s");
//@$uid=add_SQL(" insert into us_ (date_,ip,n,o,s)  values ('".$DD."','".$IP."','".$_POST["t1"]."',".$_POST["t2"].",'".$_POST["s1"]."')   ");

$_SESSION["DT"]=$DD;



if(!empty($_GET["tp"]))
{
     $uid=$_GET["gid"]; 
	 if($_GET["tp"]=="1")
	 {
        $a = $_SESSION["DT"];
        $a_time = strtotime($a);
        $b_time = strtotime('-1 Month',$a_time);
	    $b = date('Y-m-d H:i:s',$b_time);
	    $_SESSION["DT"]=$b;
	  }
	  if($_GET["tp"]=="2")
	 {
        $a = $_SESSION["DT"];
        $a_time = strtotime($a);
        $b_time = strtotime('-7 Day',$a_time);
	    $b = date('Y-m-d H:i:s',$b_time);
	    $_SESSION["DT"]=$b;
	  }
	  if($_GET["tp"]=="3")
	 {
        $a = $_SESSION["DT"];
        $a_time = strtotime($a);
        $b_time = strtotime('-1 Day',$a_time);
	    $b = date('Y-m-d H:i:s',$b_time);
	    $_SESSION["DT"]=$b;
	  }
	 
}

   $GID=$_GET["gid"];
   $GID= trim($GID);

?>
<div id="LV" style="padding: 3px; 
border-top: 3px solid #CCC; 
border-left: 3px solid #999;  
border-bottom: 1px solid #b1b1b1; 
border-right: 1px solid #b1b1b1;
border-style:ridge;
height: 560px;  
overflow: scroll;" >
</div>  
  
  
</p>


<img src="img/phone.png">發表意見
<input name="PS" type="text" id="PS">
<input type="button" name="Submit" value="送出" onClick="save();">
<input name="H1" type="hidden" id="H1" value="<?php echo $GID;?>">

<a href="../match/g.info.php?<?php echo $GID;?>" target="_self">回跟團資訊</a>

</div>
</body>
</html>
