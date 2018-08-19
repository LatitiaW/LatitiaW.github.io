<?php  
    $fIn = fopen("status1.php", "r");
	$text =  fread($fIn, filesize("status1.php"));
	$list = (explode("\n", $text));
	fclose($fIn);
?>
<?php
    $fOut = fopen("status1.php", "w");
	echo $_GET["mastermind"];
    $list[0] = $_GET["mastermind"];
	$output = (implode("\n", $list));
	fwrite ($fOut, $output);
	fclose($fOut);
?>