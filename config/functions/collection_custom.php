<?php    
    /* APARTADO CUSTOM COLLECTION*/
    /* Detectar tipo de campo para añadir en DB */
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