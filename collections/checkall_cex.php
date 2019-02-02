<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(isset($_GET['id'])){
        include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'collections/search_cex.php');

        $idToUpdate = $_GET['id'];

        $query = "SELECT ID FROM $tableItem WHERE CollectionsID='$idToUpdate'";

        $allItems = mysqli_query($databaseConnection, $query);

        if ($allItems == false){
            die();
        }

        $getItems = "SELECT * FROM $tableCex WHERE";
        while($actualRow = mysqli_fetch_assoc($allItems)){
            $thisID = $actualRow['ID'];
            $getItems .= " ItemID=$thisID OR";
        }

        $getItems = substr($getItems, 0, -3);

        $allItems = mysqli_query($databaseConnection, $query);

        if($allItems != false){
            while($actualItem = mysqli_fetch_assoc($allItems)){
                print_r($actualItem);
                $id = $actualItem['ItemID'];
                $url = $actualItem['URL'];

                $result = json_decode(cexGet($url, TRUE));

                if($result != ''){
                    $date = date('Y-m-d H:i:s', time());

                    $available = ($result['available'] == 'true' ? '1' : '0');

                    $price = $result['pricce'];

                    $update = "UPDATE $tableCex SET LastCheck='$date', Available='$available', Price='$price'";
                }
            }
        }

        //echo 'ok';
        header("Location: ./view_cex.php?id_collection=$idToUpdate");
    } else {

    echo 'False';}