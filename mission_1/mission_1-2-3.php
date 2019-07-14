<?php

$message = "HELLO,WORLD!";
$filename = "mission_1-2-1.txt";

$fp = fopen($filename ,"a");
fwrite( $fp ,  $message );
fclose( $fp );

?>