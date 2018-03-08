<?php

	function openConnection(){
		include('../config/config.php');
	}

	function closeConnection(){
        include('../config/config.php');
		mysqli_close($databaseConnection);
		unset($databaseConnection);
	}

	function showMusicTable($datosConsulta){
		$resultado = '<table><tr>';
		$tablas = array('Artista', 'Título', 'Fecha de publicación');

		foreach ($cabecera as $listaCabecerasAMostrar) {
			$resultado = $resultado . '<th>' . $cabecera . '</th>';
		}

		$resultado += '</tr>';

	}

	function whatItIs($type){
		switch ($type) {
			case 'auto':
				return ' INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY, ';
				break;
			case 'text':
				return ' VARCHAR(255), ';
				break;
			case 'date':
				return ' DATE, ';
				break;
			case 'int':
				return ' INT(11), ';
				break;
			case 'image':
				return ' VARCHAR(255)';
				break;		
			default:
				return ' VARCHAR(255)';
				break;
		}
	}

	function areULogin(){
		include('../config/config.php');

		if(!isset($_SESSION['login'])){
			header('Location:../login.php');
		}
	}

	function isAImagePath($field){
		$result = FALSE;

		$imageExtensions = array(
			'.jpg', '.jpeg', '.png', '.gif', '.bmp'
		);

		$imgPath = 'img/';

		foreach ($imageExtensions as $actualExt) {
			if((strrpos($field, $actualExt) !== FALSE) && (strrpos($field, $imgPath) !== FALSE)){
				$result = TRUE;
			}
		}

		return $result;
	}

	function download_image($image_url, $image_file){
	    $fp = fopen ($image_file, 'w+');

	    $ch = curl_init($image_url);
	    curl_setopt($ch, CURLOPT_FILE, $fp);          
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
	    curl_exec($ch);

	    curl_close($ch);
	    fclose($fp);
	}
	
	function youDontBelongHere(){
		if (!(isset($_SESSION['login'])) || ($_SESSION['rol'] != 'administrator')){
			header('Location: ../index.php');
		}
	}

	function isActivated(){
		if ($_SESSION['activated'] == '1'){
			header('Location: ../index.php');
		}
	}