<?php
session_start();
include("../mysql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<?php

          date_default_timezone_set('Asia/Taipei');   //台灣時區
		  $Y=date("Y");    //年
		  $M=date("m");    //月
		  $D=date("d");    //日
		  $H=date("h");    //日
		  $m=date("i");    //日
		  $s=date("s");    //日
		  $dd=$Y."-".$M."-".$D." ".$H.":".$m.":".$s ;

if(!empty($_POST["PS"]))
{
   add_SQL("INSERT INTO chat2 (tag,id_1,id_2,txt,t) VALUES ('".$_POST["ids"]."','".$_POST["id_1"]."','".$_POST["id_2"]."','".$_POST["PS"]."','".$dd."')");
}

if(!empty($_POST["id_1"]))
{
   $ud1=$_POST["id_1"];
   $ud2=$_POST["id_2"];
}
else
{
   $ud1=$_GET["id_1"];
   $ud2=$_GET["id_2"];
}

if(!empty($_POST["tp"]))
{
  if($_POST["tp"] == "1")
  {
	    $a = $_SESSION["DT"];
        $a_time = strtotime($a);
        $b_time = strtotime('-1 Day',$a_time);
	    $b = date('Y-m-d H:i:s',$b_time);
	    $_SESSION["DT"]=$b;
  }
  else  if($_POST["tp"] == "2")
  {
	    $a = $_SESSION["DT"];
        $a_time = strtotime($a);
        $b_time = strtotime('-7 Day',$a_time);
	    $b = date('Y-m-d H:i:s',$b_time);
	    $_SESSION["DT"]=$b;
  }
  else  if($_POST["tp"] == "3")
  {
	    $a = $_SESSION["DT"];
        $a_time = strtotime($a);
        $b_time = strtotime('-31 Day',$a_time);
	    $b = date('Y-m-d H:i:s',$b_time);
	    $_SESSION["DT"]=$b;
  }
}




$sql=" where ((id_1='".$ud1."' and  id_2='".$ud2."')  or (id_1='".$ud2."' and  id_2='".$ud1."'))  and (t > '".$_SESSION["DT"]."')  ORDER BY chat2.t ASC ";

$DE=get_chat($sql);
$L= get_chat_r($sql);

//echo $sql;

?>

<table width="690" border="0">
 
 <?php 
 
 for($i=0;$i<$L;$i++)
 {
 ?>
 
 
  <tr>
    <td width="288"><div align="left"><?php  echo $DE[$i][3]; ?>  <?php  echo $DE[$i][0]; ?>留言:</div></td>
    <td width="327"><div align="left"><?php  echo $DE[$i][2]; ?></div></td>
  </tr>
 <?php 
  }
  
  ?> 

</table>





</body>
</html>
<?php



function get_chat_r($a)
{
	  
		$sql = "select * from chat2   $a";
		$ret = mysql_query($sql); 
		$r=0;
		
		
		
		
		while($row = mysql_fetch_row($ret))
		{
			
			$r++;
        }
		
		return $r;
}




function get_chat($a)
{
	  
		$sql = "select * from chat2   $a";
		$ret = mysql_query($sql); 
		$r=0;
		
		$DB=array(array(),array());
		
		
		while($row = mysql_fetch_row($ret))
		{
			$DB[$r][0]= get_SQL("select * from  user where username='".$row[2]."'",4);
			$DB[$r][1]=$row[3];
			$DB[$r][2]=$row[4];
			$DB[$r][3]=$row[5];
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