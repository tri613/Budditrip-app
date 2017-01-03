<?php


	function fileInput( $array,$no )
	{
		$keys = array_keys( $array );
		// 抓取 key 值
		// ex: $test['asd'] 的 asd 就是一個 key
		
		for( $i=0; $i<count($array); $i++ )
		{
			$string .= addslashes($keys[$i]) . "::" . addslashes($array[ $keys[$i] ]) . "@@\r\n";
		}
		$string .= "@@end\r\n";
		
		$content = file_get_contents("../txt/message". $no .".txt"); // 把原來已經有的內容抓出來
		
		$open = fopen(  "../txt/message". $no .".txt", "w+" );
		$input = $string . $content; //把原來已經有的內容 + 新增的內容
		fwrite( $open, $input ); //寫入檔案裡面;
		fclose( $open );
	}
	
	function getFileContent( $no )
	{
		$return_array;
		$path = "../txt/message". $no .".txt";
		
		
		if($content =	@file_get_contents($path))
		{	
		
		$items = explode( "@@end\r\n", $content );
		
		for( $i=0; $i<(count($items)-1); $i++ )
		{
			$rows = explode( "@@\r\n", $items[$i] );
			
			for( $x=0; $x<(count($rows)-1); $x++ )
			{
				$value = explode( "::", $rows[$x] );
				$return_array[ $i ][ $value[0] ] = stripslashes($value[1]);
			}			
			
		}
	    return $return_array;

		}
		
		else
		echo("目前尚未有留言，給他一個鼓勵吧！");  
		
	}

?>