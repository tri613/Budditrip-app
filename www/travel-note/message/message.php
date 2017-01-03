<?php include( "mes_functions.php" ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/content.css" type="text/css">
</head>
<body>


<form style="margin:0 auto;" action="../message/mes_input.php" method="post" class="message">
  <tr>
    <td width="148">姓名：       
   <input type="text" id="name" name="name" placeholder="請輸入姓名" /><br /></td>
  </tr>
  <tr>
    標題：<input type="text" id="title" name="title" placeholder="請輸入您設計好的主題"/><br />
  </tr>
  <tr>
    留言內容：</tr>
  <tr>
    <textarea name="content" rows="10" cols="35" id="content" placeholder="請輸入您的意見或問題" style="width:450px;">
</textarea>
  <br />
  <br />
  <div>
  </tr>
    </td>
</tr>
<td width="43%" align="left">
<input name="no" type="hidden" value= <?php echo $no ; ?>>
										<input type="submit" name="submit" value="送出留言"  />
                                     </td>

<br />
<hr color="#999999" size="1" />

<?php

	$contents = getFileContent($no);
	
		for( $i=0; $i<count($contents); $i++ )
	{
?>

<table width="80%" height="171" class="feedback">
<tr>
<th bgcolor="#FFFFCC">
<div align="left">姓名：
    <?=@$contents[$i]['name']?>
    </div>
</th>
</tr>
<tr>
  <th>
  <div align="left">標題：
    <?php print_r($contents[$i]['title']); ?>
    </div>
</th>
</tr>
<tr>
  <th>
  <div align="left">內容：
    <?php print_r($contents[$i]['content']); ?>
    </div>
</th>
</tr>
</table>

<?php
	}



?>
</body>
</html>