<?php  
    $fIn = fopen("status0.php", "r");
	$text =  fread($fIn, filesize("status0.php"));
	$list = (explode("\n", $text));
	fclose($fIn);
?>
<?php
    $fOut = fopen("status0.php", "w");
	$list[0] = floor($_GET["memory"]/4);
	echo $list[0];
	$output = (implode("\n", $list));
	fwrite ($fOut, $output);
	fclose($fOut);
?>