<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

    require_once DOCUMENT_ROOT . '/vendor/autoload.php';

    use JonnyW\PhantomJs\Client;
    
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

	function getElementsByClass(&$parentNode, $tagName, $className){
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
    
    function innerHTML(DOMNode $element) { 
        $innerHTML = ""; 
        $children  = $element->childNodes;

        foreach ($children as $child) 
        { 
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML; 
    } 

    function getLazyHTML($urlToObtain){        
        $client = Client::getInstance();
        $client->getEngine()->setPath(DOCUMENT_ROOT . 'vendor/jonnyw/php-phantomjs/src/JonnyW/PhantomJs');
        $client->isLazy(); // Tells the client to wait for all resources before rendering

        $request  = $client->getMessageFactory()->createRequest();
        $request->setTimeout(5000); // Will render page if this timeout is reached and resources haven't finished loading

        $response = $client->getMessageFactory()->createResponse();
        
        $request->setMethod('GET');
        $request->setUrl($urlToObtain);
        
        $client->send($request, $response);
        
        return $response->getContent();
    }

    function cexGet($urlToGet){
        $doc = new DOMDocument('1.0');

        libxml_use_internal_errors(TRUE);

        $doc->loadHTML(getLazyHTML($urlToGet));

        $result = array();
        
        $nameTmp = getElementsByClass($doc, 'div', 'productNamecustm');

        $name = '';
        if(sizeof($nameTmp) != 0){
            $price = $nameTmp[0]->textContent;

            $arrayTo = explode('★', $price);
            $name = trim($arrayTo[0]);
        }

        $price = $doc->getElementById('Asellprice')->textContent;

        $available = '';
        if(trim(getElementsByClass($doc, 'div', 'buyNowButton')[0]->textContent) == 'Agotado'){
            $available = false;
        } else {
            $available = true;
        }

        $imageDoc = getElementsByClass($doc, 'div', 'productImg');

        $image = '';
        foreach ($imageDoc[0]->childNodes as $key) {
            $image = $key->getAttribute('src');
        }

        $result = array(
            'name' => "$name", 
            'image' => "$image", 
            'available' => "$available", 
            'price' => "$price"
        );

        return $result;
    };

    function cexSearch($searchText){
        $urlToSearch = "https://es.webuy.com/search?stext=" . $searchText;

        $urlToSearch = str_replace(' ', '+', $urlToSearch);

        var_dump($urlToSearch);

        $doc = new DOMDocument('1.0');

        libxml_use_internal_errors(TRUE);

        $htmlCode = getLazyHTML("$urlToSearch");

        $doc->loadHTML($htmlCode);

        $results = array();

        $resultsNode = getElementsByClass($doc, 'div', 'searchRcrd');

        foreach($resultsNode as $actualResult){
            $name = trim(getElementsByClass($actualResult, 'div', 'desc')[0]->getElementsByTagName('h1')[0]->getElementsByTagName('a')[0]->textContent);
            //$image = trim(getElementsByClass($actualResult, 'div', 'thumb')[0]->getElementsByTagName('a')[0]->getElementsByTagName('img')[0]->getAttribute('src'));
            $link = 'https://es.webuy.com' . trim(getElementsByClass($actualResult, 'div', 'desc')[0]->getElementsByTagName('h1')[0]->getElementsByTagName('a')[0]->getAttribute('href'));
            $available = ((getElementsByClass($actualResult, 'div', 'buyNowButton')[0]->textContent) == 'Agotado') ? false : true;
            $priceTemp = getElementsByClass($actualResult, 'div', 'priceTxt')[0]->textContent;

            $price = explode('Vendemos', $priceTemp);
            $price = '' . trim($price[1]);

            $results[] = array(
                'name' => "$name", 
                // 'image' => "$image", 
                'link' => "$link", 
                'available' => "$available", 
                'price' => "$price"
            );
        }

        echo json_encode( $results );
    }


    cexSearch('lego pc batman');


    var_dump($_GET['query']);

    if(isset($_GET['query'])){
        cexSearch($_GET['query']);

        
    } else {
        echo 'Nothing else';
    }