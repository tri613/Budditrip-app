<?php session_start() ?><head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/content-5.css" type="text/css">    
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<title>Budditrip - 揪團資訊</title>
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

<div class="nav">
<div class="nav_bg">
<ul>
<li><a href="../about.php">關於我們</a></li>
<li><a href="../travel-note/notehome.php">遊記分享</a></li>
<li><a href="build/step1.php">我要揪團</a></li>
<li><a href="group.php">我要跟團</a></li>
<li><a href="buddy.php">旅伴配對</a></li>
</ul>
</div>
</div>
<br />
<br />
<br />
<br />
<div class="centerBlock">

<?php		
			include("../mysql.php");
			
			$parameter = $_SERVER['QUERY_STRING'];	//讀取參數
			
			$sql = "SELECT * FROM `group`
					WHERE	id = $parameter";
					
			$result = mysql_query($sql);
			
			$row = mysql_fetch_array($result);		
			
			////↑讀取必要資料
			
			$GID=$row['id'];  //這行不要不小心刪掉或屏蔽掉喔不然聊天室會無法用
			
			?>
            <div class="content">
            
            <?php 
			
			echo "<p>揪團名稱：".$row['groupname']."</p>";
			echo "<a>旅遊日期：".$row['date']."</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
			echo "<a>旅遊時間：".$row['time']."</a>";
			echo "<p style='color:#FF3366'>旅遊地點：".$row['location']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp旅遊型態：".$row['type']."</p>";
			echo "<hr align='left' width='500px'>";
			echo "<p>團員性別：".$row['gender']."</p>";
			echo "<p>團員年齡：".$row['age_min']."~".$row['age_max']."歲</p>";
			echo "<p>團員人數：".$row['number_min']."~".$row['number_max']."人</p>";
			echo "<p>揪團預算：$".$row['budget_min']."~".$row['budget_max']."TWD</p>";
		
			echo "<hr align='left' width='500px'>";
			echo "<p>描述：".$row['description']."</p>";
			
			////
			
			$_sql = "SELECT * FROM `member`
					 WHERE groupname = '".$row['groupname']."'
					 AND username = '".$_SESSION['user']."'
					 AND mark = '*'";
					 
			$_result = mysql_query($_sql);
			
			while($_row = mysql_fetch_array($_result))
			{
				$zzz = 1;
			}
			
			if($zzz != 1)
			{
				$sql_count = "SELECT COUNT(*) FROM `member`
						  WHERE groupname = '".$row['groupname']."'";
			
			$result_count = mysql_query($sql_count);
			
			$row_count = mysql_fetch_array($result_count);
			
			////↑讀取必要資料
			
			
			$i = $row['number_max']; $j = $row_count['COUNT(*)'];
			//人數上限					//當前人數
			
			$GP=$row['groupname'];  //這行不要不小心刪掉或屏蔽掉喔不然聊天室會無法用
			
			echo "<hr align='left' width='500px'>";
			
			if($i > $j)	//判別滿團與否
			{
				echo '<form id="join" name="join" action="join.b.php" method="post">';
				echo '<input type="hidden"  name="id" value="'.$row['id'].'">';		//傳遞揪團編號
                echo '<input type="hidden"  name="groupname" value="'.$row['groupname'].'">';	//傳遞揪團名稱
                echo '</br>目前參加人數：'.$j.'<p>   </p> ';
				if(!empty($_SESSION['user']))
			   {
				 echo '   <input type="submit" value="我要跟團">';
			   }
				echo '</form>';
			}
			
			else
			{
				echo "</br><p style=\"color:red\">很抱歉，已經額滿了</p>";
			}
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			echo "<hr align='left' width='500px'>";
			
			$sql_nickname = "SELECT user.nickname FROM `user`,`member`
							 WHERE  member.groupname = '".$row['groupname']."'
							 AND	member.username = user.username";
							 
			$result_nickname = mysql_query($sql_nickname);
			
			echo "跟團者暱稱：</br>";
			
			while($row_nickname = mysql_fetch_array($result_nickname))
			{
				echo $row_nickname[0]."</br>";
			}
			
			
			////////////////
			
			
			$location = $row['location'];
			
			
			
			
			
			if(isset($_SESSION['user']))
			{
			
			$sql_location_sample = "UPDATE	click_group_sample 
						  	  	 SET		$location = $location+1
						      	 WHERE		username= '".$_SESSION['user']."'";	//更新揪團點擊紀錄的通訊地		  
		
			$query_location_sample =mysql_query($sql_location_sample);
			
			
			$type = explode(",",$row['type']);	//字串轉換陣列
			
			if(in_array("自然生態",$type))
			{
				$sql_A = "UPDATE click_group_sample
						  SET	自然生態 = 自然生態+1
						   WHERE		username= '".$_SESSION['user']."'";
				mysql_query($sql_A);
			}
			
			
			if(in_array("娛樂節慶",$type))
			{
				$sql_B = "UPDATE click_group_sample
						  SET	娛樂節慶 = 娛樂節慶+1
						   WHERE		username= '".$_SESSION['user']."'";
				mysql_query($sql_B);
			}
			
			
			if(in_array("社會藝文",$type))
			{
				$sql_C = "UPDATE click_group_sample
						  SET	社會藝文 = 社會藝文+1
						   WHERE		username= '".$_SESSION['user']."'";
				mysql_query($sql_C);
			}
			
			
			if(in_array("美食饗宴",$type))
			{
				$sql_D = "UPDATE click_group_sample
						  SET	美食饗宴 = 美食饗宴+1
						   WHERE		username= '".$_SESSION['user']."'";
				
				mysql_query($sql_D);
			}
			
			
			if(in_array("健康運動",$type))
			{
				$sql_E = "UPDATE click_group_sample
						  SET	健康運動 = 健康運動+1
						   WHERE		username= '".$_SESSION['user']."'";
				
				mysql_query($sql_E);
			}
			
			
			if(in_array("產業觀光",$type))
			{
				$sql_F = "UPDATE click_group_sample
						  SET	產業觀光 = 產業觀光+1
						   WHERE		username= '".$_SESSION['user']."'";
				
				mysql_query($sql_F);
			}
		}
			
?>

			<hr align='left' width='500px'>
			<div>
               <?php
			   if(!empty($_SESSION['user']))
			   {
			   $jj=get_SQL("select * from member  where groupname='".$GP."' and  username='".$_SESSION['user']."' ",0);    //判斷有沒有加入這團,如果有就可以進入聊天室
			   if($jj !='')
			   {
			   ?>
               <a href="../chat/chat.php?gid=<?php echo $GID;?>" target="_blank">開始聊天</a>
                 <?php
			   }
			   }
			   ?>
            </div>    
            </div>
</body>
</html>
<?php
function get_SQL($a,$b)
{
	    $ret = mysql_query($a); 
		$r="";
		while($row = mysql_fetch_row($ret))
		{
			$r=$row[$b];
			
        }
		return $r;
}



?>