<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員資料修改-BE</title>
<link rel="stylesheet" href="../css/top-nav.css" type="text/css">
</head>

<body>
<?php

   	header("location: member_page.php");

		include("../mysql.php");
		mysql_query("SET NAMES 'utf8'");


	$userid = $_SESSION['user'];
	$password = $_POST['password'];
	$new_pw = $_POST['new_pw'];

	//imgFile

    $filename=$_FILES['image']['name'];
    $tmpname=$_FILES['image']['tmp_name'];
    $filetype=$_FILES['image']['type'];
    $filesize=$_FILES['image']['size'];    
    $file=NULL;
    
    if(isset($_FILES['image']['error'])){    
        if($_FILES['image']['error']==0){                                    
            $instr = fopen($tmpname,"rb" );
            $file = addslashes(fread($instr,filesize($tmpname)));        
        }

    }
	
	//$lastname = $_POST['lastname'];
	//$firstname = $_POST['firstname'];
	$name = $_POST['name'];
	$nickname = $_POST['nickname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$birthday = $_POST['year'] ."-". $_POST['month'] ."-". $_POST['day'];
	//這邊沒弄好QQ
	$hobby = $_POST['interest'];
	$allhobby = implode (",", $hobby);
	$gender = $_POST['gender'];
	$selfintro = $_POST['selfintro'];
	$place = $_POST['place'];
	$location = $_POST['location'];
		
	echo $userid . " " .$lastname . " " . $firstname;
		
	$str_hobby =(string)$allhobby;
	
	//$userpw_code = md5($password);
	//$userpw_code_new = md5($new_pw);
	
	$sql = "SELECT * FROM user
			WHERE	username = '$userid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	
	/*if($firstname != ""){$sql = "UPDATE user_info SET firstname = '$firstname' WHERE username = '$userid' ";
						 mysql_query($sql);}*/
	
	if($name != ""){$sql = "UPDATE user SET name = '$name' WHERE username = '$userid' ";
						 mysql_query($sql);}	
						 
	if($nickname != ""){$sql = "UPDATE user SET nickname = '$nickname' WHERE username = '$userid' ";
						 mysql_query($sql);}
	
	if($email != ""){$sql = "UPDATE user SET email = '$email' WHERE username = '$userid' ";
					 mysql_query($sql);}
					 	
	if($mobile != ""){$sql = "UPDATE user SET mobile_phone = '$mobile' WHERE username = '$userid' ";
					 mysql_query($sql);}
	
	if($birthday != "0000-00-00"){$sql = "UPDATE user SET birthday = '$birthday' WHERE username = '$userid' ";
					 mysql_query($sql);}	
					 
	if($gender != null){$sql = "UPDATE user SET gender = '$gender' WHERE username = '$userid' ";
					 mysql_query($sql);}
	if($place != null && $location != null)	
	{
		$sql = "UPDATE user SET location = '$location' WHERE username = '$userid' ";
		mysql_query($sql);
	}
	
	if($str_hobby != ""){$sql = "UPDATE user SET interest = '$str_hobby' WHERE username = '$userid' ";
					 mysql_query($sql);}	
	
	if($selfintro != ""){$sql = "UPDATE user SET selfintro = '$selfintro' WHERE username = '$userid' ";
					 mysql_query($sql);}	
	if($file != ""){ $sql = "UPDATE user SET userImage = '$file' , imageType = '$filetype' WHERE username ='$userid'";
    			mysql_query($sql);}	
			
	if(mysql_query($sql)){
			echo '新增成功!';
			//echo'<meta http-equiv="refresh" content="1;url=member_page.php">';
		}
		else{
			echo '新增失敗QQQQQQ';
			//echo'<meta http-equiv="refresh" content="1;url=member_page.php">';
		}
	
	
	
	if($row['username'] == $userid && $row['password'] == $password)
	{	if($new_pw != null){
		$sql_pw = "UPDATE user SET 'password' = '$new_pw' WHERE 'username' = '$userid'";
		mysql_query($sql_pw);
		}
	}else{ echo '<script>';
		   echo 'alert("要改密碼要輸入原本的密碼喔!";)';
		   echo '</script>';
   		   //echo'<meta http-equiv="refresh" content="0;url=member_page.php">';
   		}


	
?>

</body>
</html>