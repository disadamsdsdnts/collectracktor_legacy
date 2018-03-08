<?php
	$cleaner = array(
		"./instalar.php",
		"./creation.php"
	);

	foreach ($cleaner as $file) {
		if(file_exists($file)){
			unlink($file);
		}
	}

	header('Location: ../index.php');

?>