<?php session_start(); ?>
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/backend.css" type="text/css">
<title>Budditrip - 登出</title>
</head>
<!---分隔線--->
<!---分隔線--->
<body>
<div class="leftBlock">
<?php
	unset($_SESSION['user']);
	echo "登出中，請稍後";
	echo "<meta http-equiv=\"refresh\" content=\"1;url=../../index.php\">";
?>
</div>
</body>