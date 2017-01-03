 <?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
</head>
 <?php
function  get_chat($a)   //取得聊天內容
{
        @$link = mysql_pconnect("localhost","boymicke_jes", "k123k123");
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
		return $DB;    //回傳
		
}

?>
<body>
 <?php
$_SESSION["uid"]="1";
$DE=get_chat('2014-6-6');

echo  $_SESSION["uid"];

for($i=0;$i<sizeof($DE);$i++)
{
	echo $DE[$i][4]." ".$DE[$i][5]."<BR>";
}

?>
</body>
</html>


