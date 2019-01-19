<?php
    /* APARTADO MÚSICA*/
    /* Crear estructura HTML de música */
	function showMusicTable($datosConsulta){
		$resultado = '<table><tr>';
		$tablas = array('Artista', 'Título', 'Fecha de publicación');

		foreach ($cabecera as $listaCabecerasAMostrar) {
			$resultado = $resultado . '<th>' . $cabecera . '</th>';
		}

		$resultado += '</tr>';

	}