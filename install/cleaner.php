<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	$cleaner = array(
		DOMAIN_PATH . "create/step2.php",
		DOMAIN_PATH . "create/step3.php",
		DOMAIN_PATH . "index.php",
		DOMAIN_PATH . "insert/step2.php",
		DOMAIN_PATH . "insert/step3.php",
		DOMAIN_PATH . "pattern.php",
		DOMAIN_PATH . "step1.php"
	);

	// foreach ($cleaner as $file) {
	// 	if(file_exists($file)){
	// 		unlink($file);
	// 	}
	// }

	header('Location: ' . DOMAIN_PATH . 'index.php');

?>