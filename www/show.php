<?
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>

</head>

<body>
<?

if(!empty($_POST["PS"]))
{
   date_default_timezone_set('Asia/Taipei');
   $DD=date("Y")."-".date("m")."-".date("d")." ".date("h").":".date("i").":".date("s");
   add_SQL("insert into chat (uid,d,mss)  values (".$_POST["uid"].",'".$DD."','".$_POST["PS"]."') ");
   
   
   $_SESSION["uid"]=$_POST["uid"];
}

$RR=get_chat_r($_SESSION["DT"]);
$DE=get_chat($_SESSION["DT"]);
?>

<table width="1025" border="0">
   <tr>
    <td width="438" >
     <a href="chat.php?tp=1&uid=<? echo $_SESSION["uid"];?>">一個月</a>   <a href="chat.php?tp=2&uid=<? echo $_SESSION["uid"];?>">七天</a>    <a href="chat.php?tp=3&uid=<? echo $_SESSION["uid"];?>">昨天</a>      </td>
    <td width="577" >
     
     </td>
  </tr>


  <?
  for($i=0;$i<$RR;$i++)
  {
   $PS=$DE[$i][0]." 年齡:".$DE[$i][1]." 性別:".$DE[$i][2]." 日期:".$DE[$i][4] ;  
  ?>
  <tr>
    <td width="438" bgcolor="#66FFCC">
     
      <?  echo $PS;?>    </td>
    <td width="577" bgcolor="#CCFFCC">
     
      <?  echo $DE[$i][5];?>    </td>
  </tr>
  <?
  }
  ?>
</table>

</body>
</html>
<?

function  get_chat_r($a)
{
        $link = mysql_pconnect("localhost","boymicke_jes", "k123k123");
		mysql_select_db ("chat", $link) ;
		mysql_query("SET NAMES 'utf8'");
		$sql = "SELECT us_.n, us_.o, us_.s, us_.ip, chat.d, chat.mss FROM chat INNER JOIN us_ ON chat.uid = us_.uid   where  chat.d  >= '$a'    ";
		$ret = mysql_query($sql, $link); 
		$r=0;
		
	    while($row = mysql_fetch_row($ret))
		{
			$r++;
        }
		mysql_close ($link) ;
		return $r;
		
}


function  get_chat($a)
{
        $link = mysql_pconnect("localhost","boymicke_jes", "k123k123");
		mysql_select_db ("chat", $link) ;
		mysql_query("SET NAMES 'utf8'");
		$sql = "SELECT us_.n, us_.o, us_.s, us_.ip, chat.d, chat.mss FROM chat INNER JOIN us_ ON chat.uid = us_.uid   where  chat.d  >= '$a'  ORDER BY chat.d ASC ";
		//echo $sql;
		$ret = mysql_query($sql, $link); 
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
		mysql_close ($link) ;
		return $DB;
		
}




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