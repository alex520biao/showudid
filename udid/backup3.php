<?php
	$content = file_get_contents("php://input");
	file_put_contents('a.txt',$content);
	echo($content);
	echo("<br/>");
?>