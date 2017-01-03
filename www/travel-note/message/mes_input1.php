<?php

$n=$array['name'] = $_POST['name'];
$m=$array['mail'] = $_POST['mail'];
$t=$array['title'] = $_POST['title'];
$c=$array['content'] = $_POST['content'];
$o=$no = $_POST['no'];

echo $no;

	include( "mes_functions1.php" );
	fileInput( $array,$no );
	

include("../connect_note.php");
		
$insertSQL ="INSERT INTO mes_off (name, title, email, message, off_no) VALUES ('$n','$t', '$m', '$c', $o)";


$result = mysql_query($insertSQL)or die(mysql_error());

	header("location: ../official/show_content1.php?no=" . $no);


?>