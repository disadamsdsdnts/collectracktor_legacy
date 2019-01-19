<?php
    /* Función para descargar imágenes */
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