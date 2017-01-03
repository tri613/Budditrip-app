<?php

$db_server="localhost";
$db_name="project";
$db_username="webmaster";
$db_password="1401191935";

@mysql_connect($db_server,$db_username,$db_password)or die("Connect Failed.");
@mysql_select_db($db_name)or die("Select db Failed");
@mysql_query("SET NAMES utf8");
	
?>