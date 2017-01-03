<?php session_start(); ?>



<?php
$id = $_GET['id'];

if(isset($_SESSION['user'])){
	$username = $_SESSION['user'];
}

include("../mysql.php");

$sql = "SELECT member.username, group.groupname FROM `member`, `group`
		WHERE member.groupname = group.groupname AND group.id = '$id'";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
	$starName = $row[0];
	if($starName!= $username){
		//這次的評價
		$starNew = $_POST[$starName];
		echo $starName."&nbsp&nbsp" .  $starNew ."<br>";
		
		//之前的評價
		$starResult = mysql_query("SELECT star FROM user WHERE username ='$row[0]'");
		$starBefore = mysql_result($starResult, 0);
		echo $starBefore . "<br>" ;

		//平均
		if($starBefore!= 0 ){
			$star = ($starNew + $starBefore) / 2 ;			
		}else{
			$star = $starNew;
		}
		echo 'star for saving:' . $star;


		$save = "UPDATE user SET star = '$star' WHERE username = '$starName'";
		if(mysql_query($save)){echo'<br><br>success!';};
		
		$done = "INSERT INTO poll (id,groupname,subject,writer,star)
				VALUES ('$id','$row[1]','$starName','$username','$starNew')";
		if(mysql_query($done)){echo '<br>done!';}
	}
}
   		echo'<meta http-equiv="refresh" content="2;url=groups.php">';

?>
