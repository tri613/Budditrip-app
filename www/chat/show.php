 <?php
session_start();
include("../mysql.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="chat.css" type="text/css">
<title>無標題文件</title>

</head>
<?php

function  get_chat_r($a,$b)
{ 
       
		$sql = "SELECT user.name, user.gender, chat.d, chat.mss, chat.gid, chat.username  FROM chat INNER JOIN user ON chat.username = user.username   where  chat.d  >= '$a' $b    ";
		//echo $sql;
		$ret = mysql_query($sql); 
		$r=0;
		
	    while($row = mysql_fetch_row($ret))
		{
			$r++;
        }
		
		return $r;
		
}


function  get_chat($a,$b)
{ 
      
		$sql = "SELECT user.nickname, user.gender, chat.d, chat.mss, chat.gid, chat.username  FROM chat INNER JOIN user ON chat.username = user.username   where  chat.d  >= '$a' $b ORDER BY `chat`.`cid` ASC ";
		//echo $sql;
		$ret = mysql_query($sql); 
		$r=0;
		$DB=array(array(),array());
	    while($row = mysql_fetch_row($ret))
		{
			$DB[$r][0]=$row[0];
			$DB[$r][1]=$row[1];
			$DB[$r][2]=$row[2];
			$DB[$r][3]=$row[3];
			$DB[$r][4]=$row[4];
			$DB[$r][5]=$row[5];
			
			$r++;
        }
		
		return $DB;
		
}




function get_SQL($a,$b)
{
	  
		$sql = $a;
		$ret = mysql_query($sql); 
		$r="";
		while($row = mysql_fetch_row($ret))
		{
			$r=$row[$b];
			
        }
		
		return $r;
}

function add_SQL($a)
{
	  
		//echo $a;
		$sql=$a;
		$ret = mysql_query($sql); 
		$sn = mysql_insert_id();
	
		return $sn;
}



?>
<body>
 <?php

if(!empty($_POST["PS"]))
{
   date_default_timezone_set('Asia/Taipei');
   $DD=date("Y")."-".date("m")."-".date("d")." ".date("h").":".date("i").":".date("s");
   add_SQL("insert into chat (username,d,mss,gid)  values ('".$_SESSION['user']."','".$DD."','".$_POST["PS"]."',".$_POST["uid"].") ");
   
}


$_SESSION["uid"]=$_POST["uid"];
$_SESSION["uid"]= trim($_SESSION["uid"]);

$RR=get_chat_r($_SESSION["DT"],"  and  gid=".$_POST["uid"]."  ");
$DE=get_chat($_SESSION["DT"],"  and  gid=".$_POST["uid"]);
?>

<table class="TB1">
   <tr>
   <td width="100" bgcolor="#FFFFCC">
   歷史記錄</td>
    <td>
     <a href="chat.php?tp=1&gid=<?php echo $_SESSION["uid"];?>">一個月</a>   <a href="chat.php?tp=2&gid=<?php echo $_SESSION["uid"];?>">七天</a>    <a href="chat.php?tp=3&gid=<?php echo $_SESSION["uid"];?>">昨天</a>      </td>
  </tr>
  </table>
  
  <hr>
  
  <table class="TB2">
   <?php
  for($i=0;$i<$RR;$i++)
  {
   "<img src='img/user.png'>".$PS=$DE[$i][0]." &nbsp;&nbsp;&nbsp;&nbsp;".$DE[$i][1]." &nbsp;&nbsp;&nbsp;&nbsp;<a style='font-size:10px'>".$DE[$i][2] ."</a>"; 
  ?>
  <tr>
    <td width="30%" bgcolor="#FFFFCC">
     
       <?php  echo $PS;?>    </td>
    <td width="70%">
     
       <?php  echo $DE[$i][3];?>    </td>
  </tr>
   <?php
  }
  ?>
</table>

</body>
</html>
 