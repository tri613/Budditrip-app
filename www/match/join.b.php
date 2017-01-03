<?php session_start(); ?>
<head>
	<meta http-equiv="Content-Language" content="zh-tw" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Budditrip - join.b.php</title>
</head>

<body>
<?php
        //error_reporting(E_ALL ^ E_DEPRECATED);
		include("../mysql.php");
		
		$JUDE=get_SQL("select * from member  where groupname='".$_POST['groupname']."' and  username='".$_SESSION['user']."' ",0);    //判斷有沒有加入這團,如果沒有就可以加入,解決重複加入問題,要不然同一個身分可以加入好幾次
		
		if($JUDE=='')
		{
		    $sql = "INSERT INTO `member`(`groupname`,`username`) VALUES ('".$_POST['groupname']."','".$_SESSION['user']."')";
	        $query = mysql_query($sql);
		}
?>

<script language="javascript">
//alert("參加成功!");
window.location.replace("g.info.php?<?php echo $_POST['id'];?>",'_parent');
</script>
<?php		
function get_SQL($a,$b)    //用來抓資料表的通用函數
{
	    $ret = mysql_query($a); 
		$r="";
		while($row = mysql_fetch_row($ret))
		{
			$r=$row[$b];
			
        }
		return $r;
}

	$sql_exist = "SELECT * FROM `match_group_sample`
				  WHERE username = '".$_SESSION['user']."'";
	
	$result_exist = mysql_query($sql_exist);
	
	$row_exist = mysql_fetch_array($result_exist);	
	
	if($row_exist['username'] == null)	//如果資料沒有使用者的資料 就自動新增
	{
		$sql_insert = "INSERT INTO `match_group_sample`(`username`)
					   VALUES ('".$_SESSION['user']."')";
		$query_insert = mysql_query($sql_insert);
	}
	
	
	$sql = "SELECT * FROM `group`
			WHERE  id = '".$_POST['id']."'";
	
	$result = mysql_query($sql);
	
	$row = mysql_fetch_array($result);
	
	$subarea = $row['subarea'];
	$type = explode(",",$row['type']);
	$gender = $row['gender'];
	
	$sql_subarea_sample = "UPDATE match_group_sample
						   SET	  $subarea = $subarea+1
						   WHERE  username = '".$_SESSION['user']."'";
	mysql_query($sql_subarea_sample);//儲存使用者對跟團所在地的偏好
	
	//儲存使用者對跟團類型的偏好
	if(in_array("自然生態",$type))
	{
		$sql_A = "UPDATE match_group_sample
				  SET	 自然生態 = 自然生態+1
				  WHERE	 username= '".$_SESSION['user']."'";
		mysql_query($sql_A);
	}
			
			
	if(in_array("娛樂節慶",$type))
	{
		$sql_B = "UPDATE match_group_sample
				  SET	 娛樂節慶 = 娛樂節慶+1
				  WHERE	 username= '".$_SESSION['user']."'";
		mysql_query($sql_B);
	}
			
			
	if(in_array("社會藝文",$type))
	{
		$sql_C = "UPDATE match_group_sample
				  SET	 社會藝文 = 社會藝文+1
				  WHERE	 username= '".$_SESSION['user']."'";
		mysql_query($sql_C);
	}
			
			
	if(in_array("美食饗宴",$type))
	{
		$sql_D = "UPDATE match_group_sample
				  SET	 美食饗宴 = 美食饗宴+1
				  WHERE	 username= '".$_SESSION['user']."'";
		mysql_query($sql_D);
	}
			
			
	if(in_array("健康運動",$type))
	{
		$sql_E = "UPDATE match_group_sample
				  SET	 健康運動 = 健康運動+1
				  WHERE	 username= '".$_SESSION['user']."'";		
		mysql_query($sql_E);
	}
			
			
	if(in_array("產業觀光",$type))
	{
		$sql_F = "UPDATE match_group_sample
				  SET	 產業觀光 = 產業觀光+1
				  WHERE	 username= '".$_SESSION['user']."'";
		mysql_query($sql_F);
	}
	
	$sql_gender_sample = "UPDATE match_gender_sample
						  SET    $gender = $gender+1
						  WHERE  username = '".$_SESSION['user']."'";
	mysql_query($sql_gender_sample);	//儲存使用者對性別限制的偏好

?>



</body>
</html>