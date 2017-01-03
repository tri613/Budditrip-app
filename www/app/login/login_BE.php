<?php session_start(); ?>
<?php
include("../mysql.php");

$username = $_POST['username'];
$password = $_POST['password'];

//echo $username . ' ' . $password;

$sql = "SELECT * FROM  `user`
			WHERE	username = '$username'";
	$result = mysql_query($sql);
	$row = @mysql_fetch_array($result);
	
	if($row['username'] == $username && $row['password'] == $password)
	{
		$_SESSION['user'] = $username;
		echo 'T';
		  
	}else
	{
		echo 'F';
	}

?>