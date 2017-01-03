<?php	session_start();?>

<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

include ("../mysql.php");

$username = $_SESSION['user'];	//變數記錄使用者
$friend = $_POST['friend'];	//變數記錄旅伴


$xxx = "UPDATE `friendship`
		SET friendship = 'c'
		WHERE username = '$username'
		AND   friend    = '$friend'";

mysql_query($xxx);	//更新使用者與旅伴的關係


$yyy = "UPDATE `friendship`
		SET friendship = 'c'
		WHERE username = '$friend'
		AND   friend    = '$username'";

mysql_query($yyy);	//更新旅伴與使用者的關係


$aaa = "SELECT * FROM `user`
		WHERE  username = '$friend'";
$bbb = mysql_query($aaa);
$ccc = mysql_fetch_array($bbb);	//讀取對方的資料(轉換成自己的偏好)

$ddd = "SELECT * FROM `user`
		WHERE username = '$username'";
$eee = mysql_query($ddd);
$fff = mysql_fetch_array($eee);//讀取自己的資料(轉換成對方的偏好)
		
//對方的性別、年齡和興趣
$gender1 = $ccc['gender'];	
$age1 = floor((time()-strtotime($ccc['birthday']))/31556926);
$current1 = $ccc['current'];
$interest1 = explode(",",$ccc['interest']);

//自己的性別、年齡和興趣
$gender2 = $fff['gender'];
$age2 = floor((time()-strtotime($fff['birthday']))/31556926);
$current2 = $fff['current'];
$interest2 = explode(",",$fff['interest']);


$sql_gender_sample = "UPDATE match_buddy_sample
					  SET	 $gender1 = $gender1+1
					  WHERE  username = '$username'";
					  
mysql_query($sql_gender_sample);	//更新使用者對性別的偏好


$_sql_gender_sample = "UPDATE match_buddy_sample
					   SET    $gender2 = $gender2+1
					   WHERE  username = '$friend'";
mysql_query($_sql_gender_sample);	//更新旅伴對性別的偏好


$sql_current_sample = "UPDATE match_buddy_sample
					   SET	  $current1 = $current1+1
					   WHERE  username = '$username'";
mysql_query($sql_current_sample);	//更新使用者對所在地的偏好

$_sql_current_sample = "UPDATE match_buddy_sample
						SET    $current2 = $current2+1
						WHERE  username = '$friend'";
mysql_query($_sql_current_sample);	//更新旅伴對所在地的偏好


//更新使用者對年齡的偏好
$iii = $age1 - $age2;
if($iii > 35)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		A = A+1
					   WHERE	username= '$username'";
}
else if (35 >= $iii && $iii> 25)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		B = B+1
					   WHERE	username= '$username'";
}
else if (25 >= $iii && $iii> 15)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		C = C+1
					   WHERE	username= '$username'";
}
else if (15 >= $iii && $iii> 5)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		D = D+1
					   WHERE	username= 'username'";
}
else if (5 >= $iii && $iii>= -5)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		E = E+1
					   WHERE	username= '$username'";
}
else if (-5 > $iii && $iii>= -15)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		F = F+1
					   WHERE	username= '$username'";
}
else if (-15 > $iii && $iii>= -25)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		G = G+1
				       WHERE	username= '$username'";
}
else if (-25 > $iii && $iii>= -35)
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		H = H+1
				       WHERE	username= '$username'";
}
else
{
	$sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		I = I+1
					   WHERE	username= '$username'";
}
mysql_query($sql_age_sample);


//更新旅伴對年齡的偏好
$jjj = $age2 - $age1;
if($jjj > 35)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		A = A+1
					   WHERE	username= '$friend'";
}
else if (35 >= $jjj && $jjj> 25)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		B = B+1
					   WHERE	username= '$friend'";
}
else if (25 >= $jjj && $jjj> 15)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		C = C+1
					   WHERE	username= '$friend'";
}
else if (15 >= $jjj && $jjj> 5)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		D = D+1
					   WHERE	username= '$friend'";
}
else if (5 >= $jjj && $jjj>= -5)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		E = E+1
					   WHERE	username= '$friend'";
}
else if (-5 > $jjj && $jjj>= -15)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		F = F+1
					   WHERE	username= '$friend'";
}
else if (-15 > $jjj && $jjj>= -25)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		G = G+1
				       WHERE	username= '$friend'";
}
else if (-25 > $jjj && $jjj>= -35)
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		H = H+1
				       WHERE	username= '$friend'";
}
else
{
	$_sql_age_sample = "UPDATE	match_buddy_sample 
					   SET		I = I+1
					   WHERE	username= '$friend'";
}
mysql_query($_sql_age_sample);

//以下是更新使用者對類型的偏好
if(in_array("音樂",$interest1))
{
	$sql_type1_sample = "UPDATE match_buddy_sample	
						 SET 音樂=音樂+1 
						 WHERE username = '$username'";
	mysql_query($sql_type1_sample);
}

if(in_array("美食",$interest1))
{
	$sql_type2_sample = "UPDATE match_buddy_sample	
						 SET 美食=美食+1 
						 WHERE username = '$username'";
	mysql_query($sql_type2_sample);
}

if(in_array("運動",$interest1))
{
	$sql_type3_sample = "UPDATE match_buddy_sample	
						 SET 運動=運動+1 
						 WHERE username = '$username'";
	mysql_query($sql_type3_sample);
}

if(in_array("閱讀",$interest1))
{
	$sql_type4_sample = "UPDATE match_buddy_sample	
						 SET 閱讀=閱讀+1 
						 WHERE username = '$username'";
	mysql_query($sql_type4_sample);
}

if(in_array("電影",$interest1))
{
	$sql_type5_sample = "UPDATE match_buddy_sample	
						 SET 電影=電影+1 
						 WHERE username = '$username'";
	mysql_query($sql_type5_sample);
}

if(in_array("美術",$interest1))
{
	$sql_type6_sample = "UPDATE match_buddy_sample	
						 SET 美術=美術+1 
						 WHERE username = '$username'";
	mysql_query($sql_type6_sample);
}

//以下是更新旅伴對類型的偏好
if(in_array("音樂",$interest2))
{
	$_sql_type1_sample = "UPDATE match_buddy_sample	
						  SET 音樂=音樂+1 
						  WHERE username = '$friend'";
	mysql_query($_sql_type1_sample);
}

if(in_array("美食",$interest2))
{
	$_sql_type2_sample = "UPDATE match_buddy_sample	
			   			  SET 美食=美食+1 
						  WHERE username = '$friend'";
	mysql_query($_sql_type2_sample);
}

if(in_array("運動",$interest2))
{
	$_sql_type3_sample = "UPDATE match_buddy_sample	
						 SET 運動=運動+1 
						 WHERE username = '$friend'";
	mysql_query($_sql_type3_sample);
}

if(in_array("閱讀",$interest2))
{
	$_sql_type4_sample = "UPDATE match_buddy_sample	
						 SET 閱讀=閱讀+1 
						 WHERE username = '$friend'";
	mysql_query($_sql_type4_sample);
}

if(in_array("電影",$interest2))
{
	$_sql_type5_sample = "UPDATE match_buddy_sample	
						 SET 電影=電影+1 
						 WHERE username = '$friend'";
	mysql_query($_sql_type5_sample);
}

if(in_array("美術",$interest2))
{
	$_sql_type6_sample = "UPDATE match_buddy_sample	
						 SET 美術=美術+1 
						 WHERE username = '$friend'";
	mysql_query($_sql_type6_sample);
}

header('Location: '.$_POST["url"].'');	//轉址
exit;
?>
