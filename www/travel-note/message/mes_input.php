<?php

$n=$array['name'] = $_POST['name'];
$m=$array['mail'] = $_POST['mail'];
$t=$array['title'] = $_POST['title'];
$c=$array['content'] = $_POST['content'];
$o=$no = $_POST['no'];

echo $no;

	include( "mes_functions.php" );
	fileInput( $array,$no );
	

include("../../mysql.php");
		
$insertSQL ="INSERT INTO mes_note (name, title, email, message, note_no) VALUES ('$n','$t', '$m', '$c', $o)";


$Result = mysql_query($insertSQL)or die(mysql_error());

	header("location: ../traveler/show_content.php?no=" . $no);


?>