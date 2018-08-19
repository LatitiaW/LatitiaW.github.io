<?php  
    $fIn = fopen("status2.php", "r");
	$text =  fread($fIn, filesize("status2.php"));
	$list = (explode("\n", $text));
	fclose($fIn);
?>
<?php
    $fOut = fopen("status2.php", "w");
	echo $_GET["battleship"];
    $list[0] = $_GET["battleship"];
	$output = (implode("\n", $list));
	fwrite ($fOut, $output);
	fclose($fOut);
?>