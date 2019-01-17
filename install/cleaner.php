<?php
	$cleaner = array(
		"./index.php",
		"./step1.php",
		"./create/step2.php",
		"./insert/step2.php",
		"./create/step3.php",
		"./insert/step3.php",
		"./pattern.php"
	);

	// foreach ($cleaner as $file) {
	// 	if(file_exists($file)){
	// 		unlink($file);
	// 	}
	// }

	header('Location: ../index.php');

?>