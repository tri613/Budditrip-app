<?php session_start() ?><head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/content-4.css" type="text/css">    
<link rel="stylesheet" href="../css/navigators.css" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<title>Budditrip - 旅伴資訊</title>
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
<span class="topNavText"><a href="../index.php">BuddiTrip</a></span>

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
        <br>
<?php
		include("../mysql.php");
			
		$parameter = $_SERVER['QUERY_STRING'];	//讀取參數
			
		$sql = "SELECT * FROM `user`
				WHERE	id = $parameter";
					
		$result = mysql_query($sql);
			
		$row = mysql_fetch_array($result);		
			
		////↑讀取必要資料

		//image
		if($row['userImage']!=null){
		echo '<img width="200px" height="auto" src="data:image/jpeg;base64,'.base64_encode( $row['userImage'] ).'"/>';
		}

		echo "<p>暱稱：".$row['nickname']."</br></p>";
		echo "<p>性別：".$row['gender']."</br></p>";
		//echo "生日：".$row['birthday']."</br>";
		
		$age = floor((time()-strtotime($row['birthday']))/31556926);
		
		echo "<p>年齡:".$age."</br></p>";
		
		echo "<p>所在地：".$row['location']."</br></p>";
		echo "<p>興趣：".$row['interest']."</br></p>";
		echo "<p>EMAIL：".$row['email']."</br></p>";
		echo "<p>自我介紹：".$row['selfintro']."</br></p>";
		
		
		
		/////////
		
		$gender = $row['gender'];
		$location = $row['location'];
		
		//////
		
		if(isset($_SESSION['user']))	//點擊紀錄部分
		{
		
		
		$sql_FS = "SELECT * FROM `friendship`
					WHERE username = '".$_SESSION['user']."'
					AND   friend   = '".$row['username']."' ";
					
		//echo $sql_FS;
		
		$result_FS = mysql_query($sql_FS);
		
		$row_FS = mysql_fetch_array($result_FS);
		
		$URL='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	//取得當前網址
		
		
		//$URL='to.chat.html';	//取得當前網址

		
		if($row_FS['friendship'])
		{
			switch($row_FS['friendship'])
			{
				case "a";
				echo '<form name="form_a">';
				echo '<input type="button" value="已經發送邀請">';
				echo '</form>';
				break;					//不用寫
		
				case "b";
				echo '<form name="form_b" action="answer.php" method="post">';
				echo '<input type="submit" value="等待你的確認">';
				echo '<input type="hidden" name="friend" value="'.$row['username'].'">';
				echo '<input type="hidden" name="url" value="'.$URL.'">';
				echo '</form>';
				break;
			
				default;
				echo '<form name="form_a">';
				echo '<input type="button" value="已經是旅伴囉">';
				//echo '<a href=\"javascript://\"   onClick=\"window.open(\'to.chat.html\',\'\',\'menubar=no,status=yes,scrollbars=no,top=200,left=200.toolbar=no,width=360,height=490\')\"    >開始聊天</a>';
				
				?>
                
                <a href="javascript://" onClick="window.open('tochat.php?id_=<?php echo $_SESSION['user']; ?>&ud=<?php echo $row['username'] ?>','','menubar=no,status=yes,scrollbars=no,top=200,left=200.toolbar=no,width=760,height=680')">開始聊天</a> 
                
                <?php
				
				
				
				
				echo '</form>';
				break;					//不用寫
			}
		}else
		{
		
			echo '<form name="form1" action="ask.php" method="post">';
			echo '<input type="submit" value="+1加旅伴">';
			echo '<input type="hidden" name="friend" value="'.$row['username'].'">';
			echo '<input type="hidden" name="url" value="'.$URL.'">';
			echo '</form>';
		}
		
		
		
		
		
		
		//-----------------------------------------------
		
			
			$sql_gender_sample = "UPDATE	click_buddy_sample 
						  	 	 SET		$gender = $gender+1
						     	 WHERE		username= '".$_SESSION['user']."'";	//更新旅伴點擊紀錄的性別
							  
			$sql_subarea_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		$location = $location+1
						      	 WHERE		username= '".$_SESSION['user']."'";	//更新旅伴點擊紀錄的所在地	  
		
			$query_gender_sample = mysql_query($sql_gender_sample);
		
			$query_subarea_sample =mysql_query($sql_subarea_sample);
			
			///////////////////////////////
			
			$sql_UB = "SELECT birthday from `user`
					WHERE username = '".$_SESSION['user']."'";
					
			$result_UB = mysql_query($sql_UB);
		
			while($row_UB = mysql_fetch_array($result_UB))
			{
				$UB = floor((time()-strtotime($row_UB[0]))/31556926);	//使用者年齡
			}
			
			$subtraction = $age - $UB;	//旅伴與使用者的年齡差距
			
			//echo $subtraction;
			
			if($subtraction > 35)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		A = A+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else if (35 >= $subtraction && $subtraction> 25)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		B = B+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else if (25 >= $subtraction && $subtraction> 15)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		C = C+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else if (15 >= $subtraction && $subtraction> 5)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		D = D+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else if (5 >= $subtraction && $subtraction>= -5)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		E = E+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else if (-5 > $subtraction && $subtraction>= -15)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		F = F+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else if (-15 > $subtraction && $subtraction>= -25)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		G = G+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else if (-25 > $subtraction && $subtraction>= -35)
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		H = H+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			else
			{
				$sql_age_sample = "UPDATE	click_buddy_sample 
						  	  	 SET		I = I+1
						      	 WHERE		username= '".$_SESSION['user']."'";
			}
			
			$query_age_sample =mysql_query($sql_age_sample);
			
			////
			
			$interest = explode(",",$row['interest']);	//字串轉換陣列
			
			if(in_array("音樂",$interest))
			{
				$sql_A = "UPDATE click_buddy_sample
						  SET	音樂 = 音樂+1
						   WHERE		username= '".$_SESSION['user']."'";
				mysql_query($sql_A);
			}
			
			
			if(in_array("美食",$interest))
			{
				$sql_B = "UPDATE click_buddy_sample
						  SET	美食 = 美食+1
						   WHERE		username= '".$_SESSION['user']."'";
				mysql_query($sql_B);
			}
			
			
			if(in_array("運動",$interest))
			{
				$sql_C = "UPDATE click_buddy_sample
						  SET	運動 = 運動+1
						   WHERE		username= '".$_SESSION['user']."'";
				mysql_query($sql_C);
			}
			
			
			if(in_array("閱讀",$interest))
			{
				$sql_D = "UPDATE click_buddy_sample
						  SET	閱讀 = 閱讀+1
						   WHERE		username= '".$_SESSION['user']."'";
				
				mysql_query($sql_D);
			}
			
			
			if(in_array("電影",$interest))
			{
				$sql_E = "UPDATE click_buddy_sample
						  SET	電影 = 電影+1
						   WHERE		username= '".$_SESSION['user']."'";
				
				mysql_query($sql_E);
			}
			
			
			if(in_array("美術",$interest))
			{
				$sql_F = "UPDATE click_buddy_sample
						  SET	美術 = 美術+1
						   WHERE		username= '".$_SESSION['user']."'";
				
				mysql_query($sql_F);
			}
			
		}
		
		
		$_username = $row['username'];	//對方的使用者名稱
		
		
		$sql_find = "SELECT * FROM `group`
					WHERE username = '$_username'";
					
		$result_find = mysql_query($sql_find);	
		
		
		echo "<hr>";
		echo "這位使用者正在舉辦的揪團</br></br>";
		
		while($row_find = mysql_fetch_array($result_find))
		{
			
			$URL = "/match/g.info.php?".$row_find['id'];
			
			//echo $URL;
			echo "團名：<a href=\"$URL\">".$row_find['groupname']."</a></br>";
			
		}
		
		
?>
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


?>