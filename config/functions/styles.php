<?php
    function insertStyles($actualRoute){
        $styles = '';

        if ( !(strpos($actualRoute, 'collections/') === false) ){
            $styles = $styles . "<link rel='stylesheet' type='text/css' href='" . DOMAIN_PATH . "css/collections_index.css'>";
	        $styles = $styles . "<link rel='stylesheet' type='text/css' href='" . DOMAIN_PATH . "css/collections_create.css'>";
        }

        return $styles;
    }