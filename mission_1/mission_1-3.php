<?php

$filename = "mission_1-2-1.txt";

$fp = fopen($filename ,"r");

	$content = file_get_contents($filename);
	echo $content;
	
fclose( $fp );

?>