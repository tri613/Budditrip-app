 <?php
session_start();
include("../mysql.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<title>雙人聊天室</title>
</head>
<?php

          date_default_timezone_set('Asia/Taipei');   //台灣時區
		  $Y=date("Y");    //年
		  $M=date("m");    //月
		  $D=date("d");    //日
		  $H=date("h");    //日
		  $m=date("i");    //日
		  $s=date("s");    //日
		  $ids=$Y.$M.$D.$H.$m.$s ;
           
		   if(empty($_SESSION["DT"]))
		  {
		  
		    $idt=$Y."-".$M."-".$D." ".$H.":".$m.":".$s ;
		    $_SESSION["DT"]=$idt;
		  }



?>



<script language="javascript">

function startTime()
{
  var uid=document.getElementById('H1').value;;
  $.post("show.php", {uid : uid}, function(result){
  $("#LV").html(result);
        });
  setTimeout('startTime()',3000);
}


function save()   //送出發言
{
    var PS=document.getElementById('cm').value;;
	var uid=document.getElementById('ids').value;;
	var id_1=document.getElementById('id_1').value;;
	var id_2=document.getElementById('id_2').value;;
	if(PS == "")
	{
	    $.post("show.php", {id_1 : id_1,id_2 : id_2}, function(result){
        $("#LV").html(result);
        });
	}
   else
   {
     $.post("show.php", {PS : PS,ids : uid,id_1 : id_1,id_2 : id_2}, function(result){
     $("#LV").html(result);
        });
	}
	document.getElementById('cm').value="";
}

function get_data(a)   //送出發言
{
   
	var tp=a;
	var id_1=document.getElementById('id_1').value;;
	var id_2=document.getElementById('id_2').value;;
	$.post("show.php", {id_1 : id_1,id_2 : id_2,tp:tp}, function(result){
        $("#LV").html(result);
        });
		
		//alert(tp);
}




</script>




<body onload="save()">
<?php
  //echo $ids;
?>
<table width="280" border="0">
<tr>
    <td width="70"><div align="left">歷史記錄</div></td>
    <td width="70"><div align="left"><a href="#" onclick="get_data('1');">昨天</a></div></td>
    <td width="70"><div align="left"><a href="#" onclick="get_data('2');">一星期</a></div></td>
    <td width="70"><div align="left"><a href="#" onclick="get_data('3');">一個月</a></div></td>
  </tr>
</table>
<div id="LV" style="padding: 3px; 
border-top: 3px solid #CCC; 
border-left: 3px solid #999;  
border-bottom: 1px solid #b1b1b1; 
border-right: 1px solid #b1b1b1;
border-style:ridge;
height: 560px;  
overflow: scroll;" >
</div>  


  <label for="bt">聊天內容</label>
 <input name="cm" type="text" id="cm">
<input type="button" name="Submit" value="送出" onClick="save()"  >
<input name="ids" type="hidden" id="ids" value="<?php echo $ids;?>">
<input name="id_1" type="hidden" id="id_1" value="<?php echo $_GET["id_"];?>">
<input name="id_2" type="hidden" id="id_2" value="<?php echo $_GET["ud"];?>">


</body>
</html>
<?php


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