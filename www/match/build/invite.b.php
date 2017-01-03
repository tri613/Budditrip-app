<?php	session_start(); 

		include("../../mysql.php");
		
		for($w=0;$w<count($_POST['invite']);$w++)
		{
			$sql = "INSERT INTO invite(`groupname`,`username`)
					VALUES ('".$_COOKIE['groupname']."','".$_POST['invite'][$w]."')";
			$result = mysql_query($sql);
		}

		echo '<meta http-equiv="refresh" content="0;url=../../index.php">';	//自動回到首頁

?>