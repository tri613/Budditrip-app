<?
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="jquery.js"></script>
<title>Budditrip Chatroom</title>
</head>

<body onLoad="startTime();">
<?
$IP=$_SERVER['REMOTE_ADDR'];
date_default_timezone_set('Asia/Taipei');
$DD=date("Y")."-".date("m")."-".date("d")." ".date("h").":".date("i").":".date("s");
$uid=add_SQL(" insert into us_ (date_,ip,n,o,s)  values ('".$DD."','".$IP."','".$_POST["t1"]."',".$_POST["t2"].",'".$_POST["s1"]."')   ");

$_SESSION["DT"]=$DD;


echo SDD;

if(!empty($_GET["tp"]))
{
     $uid=$_GET["uid"]; 
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



?>


<div id="LV" style="padding: 3px; border-top: 1px solid #696969; border-left: 1px solid #696969;  border-bottom: 1px solid #b1b1b1; border-right: 1px solid #b1b1b1; height: 560px;  overflow: scroll;" >

</div>
發言內容:
<input name="PS" type="text" id="PS">
<input type="button" name="Submit" value="送出" onClick="save();">
<input name="H1" type="hidden" id="H1" value="<? echo $uid;?>">


<script language="javascript">

function startTime()
{
  var uid=document.getElementById('H1').value;;
  $.post("show.php", {uid : uid}, function(result){
  $("#LV").html(result);
        });
  setTimeout('startTime()',3000);
}


function save()
{
    var PS=document.getElementById('PS').value;;
	var uid=document.getElementById('H1').value;;
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
<a href="login.php" target="_self">登出</a>
</body>
</html>
<?
function get_SQL($a,$b)
{
       $link = mysql_pconnect("localhost","boymicke_jes", "k123k123");
		mysql_select_db ("chat", $link) ;
		mysql_query("SET NAMES 'utf8'");
		$sql = $a;
		$ret = mysql_query($sql, $link); 
		$r="";
		while($row = mysql_fetch_row($ret))
		{
			$r=$row[$b];
			
        }
		mysql_close ($link) ;
		return $r;
}

function add_SQL($a)
{
       $link = mysql_pconnect("localhost","boymicke_jes", "k123k123");
		mysql_select_db ("chat", $link) ;
		mysql_query("SET NAMES 'utf8'");
		$sql=$a;
		$ret = mysql_query($sql, $link) ;
		$sn = mysql_insert_id();
		mysql_close ($link) ;
		return $sn;
}



?>