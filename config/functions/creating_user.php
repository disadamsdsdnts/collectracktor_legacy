<?php

    /* APARTADO CREAR USUARIO */
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