<?php session_start();?>

<?php

include ("mysql.php");

if(isset ($_SESSION['user'])){
	$userid = $_SESSION['user'];
}else{
	$userid = 'guest' ;
}
$no = $_GET['no'];

echo $userid;
echo "<br>";

//get the article title from Database
$sql = "SELECT * FROM travelnote WHERE note_no = '$no'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$title=$row['note_name'];
echo 'user choice:'.$title;
echo "<br>";

//see if this article was clicked before
$findSql = "SELECT * FROM user_click WHERE username = '$userid' AND title = '$title' ";
$resultF = mysql_query($findSql);
$rowF = mysql_fetch_array($resultF);

//要不要加location
if($rowF['title']!=null){
	echo "AAAAA";
	$count =  $rowF['clicked-times'] + 1;
	echo $count;
	$addCount = "UPDATE `user_click` SET `clicked-times` = '$count' WHERE `username` = '$userid' AND `title` = '$title'";
	mysql_query($addCount);
}else{
	echo'none';
	$newCount = "INSERT INTO `user_click`(`username`, `title`, `clicked-times`) VALUES  ('$userid','$title', 1)";
	mysql_query($newCount);	
};

header("location: travel-note/traveler/show_content.php?no=" . $no);

?>