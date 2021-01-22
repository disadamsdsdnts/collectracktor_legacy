<?php
//header ("content-type: application/json; charset=utf-8");
/* Función para saber la respuesta del estado de la web */
function is_working_url($url)
{
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_NOBODY, true);
  curl_exec($handle);

  $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
  curl_close($handle);

  return $httpCode;
}

function correct_encoding($text)
{
  $current_encoding = mb_detect_encoding($text, 'auto');
  $text = iconv($current_encoding, 'UTF-8', $text);
  return $text;
}

/* Obtener la información de la película */
function getInfo($movie)
{
  $html = file_get_contents($movie);

  $doc = new DOMDocument('1.0');

  libxml_use_internal_errors(TRUE);

  $doc->loadHTML($html);

  /*Obtener el Nombre */
  $name = correct_encoding($doc->getElementById('main-title')->nodeValue);

  /*Obtener el año*/
  $year = 0;

  foreach ($doc->getElementsByTagName('dd') as $key) {
    $esteEsElItem = $key->getAttribute('itemprop');
    if ($esteEsElItem == 'datePublished') {
      $year = $key->nodeValue;
    }
  }

  $director = "";

  foreach ($doc->getElementsByTagName('dd') as $actualDD) {
    $esteEsElItem = $actualDD->getAttribute('class');

    if ($esteEsElItem == 'directors') {
      $getSpan = $actualDD->getElementsByTagName('span');

      foreach ($getSpan as $actualSpan) {
        $getA = $actualSpan->getElementsByTagName('a');

        foreach ($getA as $getDirector) {
          $director = $director . trim($getDirector->nodeValue) . ', ';
        }
      }
    }
  }

  /* Obteniendo reparto */

  $cast = "";

  $contador = 0;

  foreach ($doc->getElementsByTagName('span') as $actualSpan) {
    $esteEsElItem = $actualSpan->getAttribute('class');

    if ($esteEsElItem == 'cast') {
      $getA = $actualSpan->getElementsByTagName('a');

      foreach ($getA as $actualA) {
        $getSpan = $actualA->getElementsByTagName('span');

        foreach ($getSpan as $theLastOne) {
          $cast = $cast . $theLastOne->nodeValue . ', ';

          $contador = $contador + 1;

          if ($contador == 5) {
            break 3;
          }
        }
      }
    }
  }

  /* Obtenemos el póster */
  $image = "";

  foreach ($doc->getElementsByTagName('img') as $actualSpan) {
    $esteEsElItem = $actualSpan->getAttribute('alt');

    if (($esteEsElItem == $name) or ($esteEsElItem == trim($name))) {
      $image = $actualSpan->getAttribute('src');
    }
  }

  $name = trim($name);
  $cast = trim($cast);
  $director = trim($director);

  if (substr($cast, -1) == ',') {
    $cast = substr($cast, 0, -1);
  }

  if (substr($director, -1) == ',') {
    $director = substr($director, 0, -1);
  }

  $response = array(
    "movie",
    array(
      'name' => $name,
      'year' => $year,
      'cast' => $cast,
      'director' => $director,
      'image' => $image
    )
  );

  echo json_encode($response);
}

/* Obtener todos los resultados de una búsqueda inexacta. */
function getSearch($movie)
{
  $html = file_get_contents($movie);

  $doc = new DOMDocument('1.0');

  libxml_use_internal_errors(TRUE);

  $doc->loadHTML($html);

  $results = array("search");

  foreach ($doc->getElementsByTagName('div') as $actualDiv) {
    $isMovie = $actualDiv->getAttribute('class');

    if ($isMovie == 'mc-poster') {
      $getAtag = $actualDiv->getElementsByTagName('a');

      foreach ($getAtag as $actualSearch) {
        $name = $actualSearch->getAttribute('title');
        $name = trim($name);
        $name = correct_encoding($name);
        $url = 'https://www.filmaffinity.com' . $actualSearch->getAttribute('href');
        $results[] = array(
          'name' => "$name", 'url' => "$url"
        );
      }
    }
  }

  echo json_encode($results);
}

$movie = "";

if (isset($_GET['query'])) {
  $movie = 'https://www.filmaffinity.com/es/search.php?stext=' . str_replace(' ', '+', $_GET['query']);
}

if (isset($_GET['link'])) {
  getInfo($_GET['link']);
} else if (is_working_url($movie) == 303) {
  getInfo($movie);
} else {
  getSearch($movie);
}
