<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="jquery.js"></script>
<title>無標題文件</title>
 <style type="text/css">
        .style1
        {
            height: 16.5pt;
            width: 57pt;
            color: black;
            font-size: 12.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: 新細明體, serif;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            border: .5pt solid windowtext;
            padding-left: 1px;
            padding-right: 1px;
            padding-top: 1px;
        }
        .style2
        {
            width: 117pt;
            color: black;
            font-size: 12.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: 新細明體, serif;
            text-align: left;
            vertical-align: middle;
            white-space: nowrap;
            border: .5pt solid windowtext;
            padding-left: 1px;
            padding-right: 1px;
            padding-top: 1px;
        }
        .style3
        {
            height: 16.5pt;
            color: black;
            font-size: 12.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: 新細明體, serif;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            border: .5pt solid windowtext;
            padding-left: 1px;
            padding-right: 1px;
            padding-top: 1px;
        }
        .style4
        {
            color: black;
            font-size: 12.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: 新細明體, serif;
            text-align: left;
            vertical-align: middle;
            white-space: nowrap;
            border: .5pt solid windowtext;
            padding-left: 1px;
            padding-right: 1px;
            padding-top: 1px;
        }
        .style5
        {
            height: 16.5pt;
            color: black;
            font-size: 12.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: 新細明體, serif;
            text-align: left;
            vertical-align: middle;
            white-space: nowrap;
            border-left: .5pt solid windowtext;
            border-right-style: none;
            border-right-color: inherit;
            border-right-width: medium;
            border-top: .5pt solid windowtext;
            border-bottom: .5pt solid windowtext;
            padding-left: 1px;
            padding-right: 1px;
            padding-top: 1px;
        }
    </style>
   
    
</head>

<body>
<?





?>


<div align="center">
 <form action="chat.php" method="post" name="fm1" id="fm1">
     <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:
 collapse;width:174pt" width="232">
           
            <tr height="22" style="height:16.5pt">
                <td class="style1" height="22" width="76">
                    別名</td>
                <td class="style2" width="156">
                    <input name="t1" type="text" id="t1" size="12">　
                    </td>
            </tr>
            <tr height="22" style="height:16.5pt">
                <td class="style3" height="22">
                    年齡</td>
                <td class="style4">
                    <input name="t2" type="text" id="t2" size="6">　
                    </td>
            </tr>
            <tr height="22" style="height:16.5pt">
                <td class="style3" height="22">
                    性別</td>
                <td class="style4">
                    <select name="s1" id="s1">
                      <option>男</option>
                      <option>女</option>
                  </select>　
                    </td>
            </tr>
            <tr height="22" style="height:16.5pt">
                <td class="style5" colspan="2" height="22">
                    <input type="button" name="Submit" value="登入" onClick="Set();">
                    <input type="submit" name="Submit2" value="送出">　
                    </td>
            </tr>
  </table>
  </form>
  <p>&nbsp;</p>
  
  <script language="javascript">
  function Set()
  {
      var t1=document.getElementById('t1').value;
	  var t2=document.getElementById('t2').value;
	  var s1=$('select#s1 option:selected').text();
	  
	  if(t1=="")
	  {
	      alert("別名未填寫!");
	  }
	  else
	  {
	        if(isNaN(t2)==true || t2=="")
			{
			     alert("年齡必須是數字!"); 
			}
			else
			{
			     document.getElementById('fm1').submit();
			}
	  }
	  
	  
  }
  
  </script>
  
  
</div>
</body>
</html>
