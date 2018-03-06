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

	function showUserDefinedTable($datosConsulta, $listaCabecerasAMostrar){

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
		if(!isset($_SESSION['login'])){
			header('Location:../login.php');
		}
	}