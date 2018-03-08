<?php
	$cleaner = array(
		"./index.php",
		"./step1.php",
		"./step2create.php",
		"./step2insert.php",
		"./step3create.php",
		"./step3insert.php",
		"./pattern.php"
	);

	foreach ($cleaner as $file) {
		if(file_exists($file)){
			unlink($file);
		}
	}

	header('Location: ../index.php');

?>