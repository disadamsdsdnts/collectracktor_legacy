<?php
	//header ("content-type: application/json; charset=utf-8");
	/* Función para saber la respuesta del estado de la web */
	function is_working_url($url) {
		$handle = curl_init($url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_NOBODY, true);
		curl_exec($handle);
		
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		curl_close($handle);
		
		return $httpCode;
	}

	function correct_encoding($text) {
	    $current_encoding = mb_detect_encoding($text, 'auto');
	    $text = iconv($current_encoding, 'UTF-8', $text);
	    return $text;
	}

	function getElementsByClass(&$parentNode, $tagName, $className) {
	    $nodes=array();

	    $childNodeList = $parentNode->getElementsByTagName($tagName);
	    for ($i = 0; $i < $childNodeList->length; $i++) {
	        $temp = $childNodeList->item($i);
	        if (stripos($temp->getAttribute('class'), $className) !== false) {
	            $nodes[]=$temp;
	        }
	    }

	    return $nodes;
	}
	
	/* Obtener la información de la película */
	function getInfo($music, $recordRegistry) {
		$html = file_get_contents($music);

		$doc = new DOMDocument('1.0');

		libxml_use_internal_errors(TRUE);

		$doc->loadHTML($html);

		/* Nombre */
		$temporalNombreParrafo = getElementsByClass($doc, 'p', 'subheader');
		$itemArtist = '';
		if(sizeof($temporalNombreParrafo) != 0){
			$itemArtist = $temporalNombreParrafo[0]->getElementsByTagName('a')[0]->getElementsByTagName('bdi')[0]->nodeValue;
		}

		/* Título */
		$temporalTitulo = getElementsByClass($doc, 'div', 'releaseheader');
		$itemTitle = '';
		if(sizeof($temporalTitulo) != 0){
			$itemTitle = $temporalTitulo[0]->getElementsByTagName('h1')[0]->getElementsByTagName('a')[0]->getElementsByTagName('bdi')[0]->nodeValue;
		}

		/* Fecha */
		$temporalFecha = getElementsByClass($doc, 'span', 'release-date');
		$itemPublishDate = '';
		if(sizeof($temporalFecha) != 0){
			$itemPublishDate = $temporalFecha[0]->nodeValue;
		}

		/* Discográfica */
		$itemRecordCompany = $recordRegistry;

		/* Formato */
		$temporalTipo = getElementsByClass($doc, 'dd', 'type');
		$itemType = '';
		if(sizeof($temporalTipo) != 0){
			$itemType = $temporalTipo[0]->nodeValue;
		}

		/* Código de barras */
		$temporalBarcode = getElementsByClass($doc, 'dd', 'barcode');
		$itemBarcode = '';
		if(sizeof($temporalBarcode) != 0){
			$itemBarcode = $temporalBarcode[0]->nodeValue;
		}

		/* Imagen */
		$temporalImagen = getElementsByClass($doc, 'span', 'cover-art-image');
		$itemImage = '';
		if(sizeof($temporalImagen) != 0){
			$itemImage = 'http:' . $temporalImagen[0]->getAttribute('data-large-thumbnail');
		}

		$response = array(
			"music",
			array('artist' => $itemArtist, 
				'title' => $itemTitle, 
				'publishDate' => $itemPublishDate, 
				'recordcompany' => $itemRecordCompany, 
				'type' => $itemType, 
				'barcode' => $itemBarcode, 
				'image' => $itemImage )
		);

		echo json_encode( $response );
	}

	/* Obtener todos los resultados de una búsqueda inexacta. */
	function getSearch($music) {
		$html = file_get_contents($music);

		$doc = new DOMDocument('1.0');

		libxml_use_internal_errors(TRUE);

		$doc->loadHTML($html);

		$results = array("search");

		/* Obtener resultados */
		foreach($doc->getElementsByTagName('tbody') as $table){
			foreach($doc->getElementsByTagName('tr') as $row) {
				$actualSearch = array();
				$contador = 0;

				foreach($row->getElementsByTagName('td') as $column){
					if($contador == 1){
						$actualSearch["url"] = 'https://musicbrainz.org' . $column->getElementsByTagName('a')[0]->getAttribute('href');
						$actualSearch["title"] = $column->textContent;
					} else if($contador == 2){
						$actualSearch["artist"] = $column->textContent;
					} else if($contador == 3){
						$actualSearch["format"] = $column->textContent;
					} else if($contador == 5){
						$actualSearch["date"] = substr($column->textContent, 0, 4);
					} else if($contador == 7){
						$actualSearch["record"] = $column->textContent;
					} else if($contador == 8){
						$actualSearch["catalog_num"] = $column->textContent;
					} else if($contador == 9){
						$actualSearch["barcode"] = $column->textContent;
					}

					$contador = $contador + 1;
				}

				$results[] = $actualSearch;
			}
		}

		echo json_encode( $results );
	}

	$music = "";

	if(isset($_GET['query'])){
		$music = 'https://musicbrainz.org/search?query=' . str_replace(' ', '+', $_GET['query']) . '&type=release&method=indexed';
	}

	if(isset($_GET['link'])){
		getInfo($_GET['link'], $_GET['record']);
	} else {
		getSearch($music);
	}
?>