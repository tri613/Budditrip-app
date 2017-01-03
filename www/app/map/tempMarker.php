<?php session_start(); ?>

<?php

$jsonMarker = $_POST['marker'];
$_SESSION['jsonNewMarker'] = $jsonMarker;

echo $_SESSION['jsonNewMarker'];
?>

