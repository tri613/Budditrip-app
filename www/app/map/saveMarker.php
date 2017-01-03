<?php session_start();?>
<?php
include("../mysql.php");

//markerPostion

$NewMarker;
$username = $_SESSION['user'];

if(isset($_SESSION['jsonNewMarker'])){
  $jsonMarker = $_SESSION['jsonNewMarker'];
  $NewMarker = json_decode($jsonMarker, true);
  print_r ($NewMarker);
}else{
  echo 'there is no marker';
}

//markerInfo
$markerTitle = $_POST['title'];
$markerAddress = $_POST['address'];
$markerInfo = $_POST['info'];

//save
$k = $NewMarker['k'];
$B = $NewMarker['B'];
$markerContent = '<div class="infoWindow"><div class="markerTitle">' . $markerTitle . '</div><div class="markerAddress">'. $markerAddress . '</div><div class="markerInfo">' . $markerInfo . '</div><div class="markerUser">由' .$username. '提供</div></div>' ;

$sql = "INSERT INTO app_markers
			(K,B,marker_info,username) VALUES				
			('$k' , '$B','$markerContent','$username')";
//mysql_query($sql);

if(mysql_query($sql)){
	unset($_SESSION['jsonNewMarker']);
}
?>