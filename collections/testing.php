<?php
    // include_once '../admin/functions.php';

    // include '../config/config.php';

    // /* Hey puta */
    // echo '<h1>Prueba de si es una imagen o no</h1>';
    // $checkitout = array(
    // 	'Muertos del ayer',
    // 	'Linkin Park',
    // 	'img/google.jpg',
    // 	'img/0_books.jpg'
    // );

    // foreach ($checkitout as $actual) {
    // 	$checking = isAImagePath($actual);

    // 	if($checking){
    // 		echo $actual . ' <strong style="color: red;">es una imagen.</strong> O debería de serlo.<br>';
    // 	} else {
    // 		echo $actual . ' <strong>no es una imagen.</strong><br>';
    // 	}
    // }

// takes URL of image and Path for the image as parameter
function download_image($image_url, $image_file){
    $fp = fopen ($image_file, 'w+');              // open file handle

    $ch = curl_init($image_url);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
    curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    // curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
    curl_exec($ch);

    curl_close($ch);                              // closing curl handle
    fclose($fp);                                  // closing file handle
}

$url = 'https://pics.filmaffinity.com/jui_kuen_ii_the_legend_of_drunken_master-128297522-mmed.jpg';
$ruta = 'img/item/';
$ID = 88;
$extension = 'jpg';

download_image("$url", "$ruta/$ID.$extension");