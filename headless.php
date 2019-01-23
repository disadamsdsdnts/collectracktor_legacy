<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
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


    require __DIR__ . '/vendor/autoload.php';

    use JonnyW\PhantomJs\Client;
    
    $client = Client::getInstance();
    $client->isLazy(); // Tells the client to wait for all resources before rendering

    $request  = $client->getMessageFactory()->createRequest();
    $request->setTimeout(5000); // Will render page if this timeout is reached and resources haven't finished loading

    $response = $client->getMessageFactory()->createResponse();
    
    $request->setMethod('GET');
    $request->setUrl('https://es.webuy.com/product-detail?id=023272009434&categoryName=pc-juegos&superCatName=juegos&title=lego-star-wars-the-complete-saga');
    
    $client->send($request, $response);
    
    // if($response->getStatus() === 301) {
    //     echo htmlspecialchars($response->getContent());
    // }

    $html = $response->getContent();

    $doc = new DOMDocument('1.0');

	libxml_use_internal_errors(TRUE);

    $doc->loadHTML($html);
    
    /* Nombre */
    $temporalNombreParrafo = getElementsByClass($doc, 'div', 'productNamecustm');
    $itemArtist = '';
    if(sizeof($temporalNombreParrafo) != 0){
        $itemArtist = $temporalNombreParrafo[0]->textContent;

        $arrayTo = explode('★', $itemArtist);
        $itemArtist = $arrayTo[0];
    }
//var_dump($temporalNombreParrafo);
    echo '<h1>El titulo es ' . trim($itemArtist) . '</h1>';
    echo '<h1>El precio es ' . $doc->getElementById('Asellprice')->textContent . '</h1>';
    if(trim(getElementsByClass($doc, 'div', 'buyNowButton')[0]->textContent) == 'Agotado'){
        echo '<h1>' . 'El juego está agotado' . '</h1>';
    } else {
        echo '<h1>' . 'El juego está disponible para comprar' . '</h1>';
    }

    $temporalNombreParrafo = getElementsByClass($doc, 'div', 'productImg');
    $itemArtist = '';

    var_dump($temporalNombreParrafo);

    $temporalNombreParrafo[0]->childNodes[0]->getElementsByTagName('img')[0]->getAttribute('href');


    echo '<h1>' . 'La imagen encontrada es la siguiente: ' . '</h1><img href=">';