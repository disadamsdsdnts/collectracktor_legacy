<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(isset($_GET['id'])){
        require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'collections/search_cex.php');

        $idToUpdate = $_GET['id'];

        $query = "SELECT ID FROM $tableItem WHERE CollectionsID='$idToUpdate'";

        $allItems = mysqli_query($databaseConnection, $query);

        if ($allItems == false){
            die();
        }

        $itemsToCheck = array();

        while($actualRow = mysqli_fetch_assoc($allItems)){
            $itemsToCheck[] = $actualRow['ID'];
        }

        if(sizeof($itemsToCheck) !== false && sizeof($itemsToCheck) !== 0){
            foreach($itemsToCheck as $actualItem){
                $id = $actualItem;
                
                $query = "SELECT * FROM $tableCex WHERE ItemID=$id";

                $check = mysqli_query($databaseConnection, $query);

                if($check !== false){
                    $info = mysqli_fetch_assoc($check);
                    $url = $info['URL'];

                    $result = json_decode(cexGet($url), TRUE);

                    if($result != ''){
                        $date = date('Y-m-d H:i:s', time());

                        $available = ($result['available'] == 'true' ? '1' : '0');

                        $price = str_replace('€', '', $result['price']);

                        $update = "UPDATE $tableCex SET LastCheck='$date', Available='$available', Price='$price' WHERE ItemID='$id'";

                        mysqli_query($databaseConnection, $update);
                    }
                }
            }
        }

        //echo 'ok';
        header("Location: ./view_cex.php?id_collection=$idToUpdate");
    } else {

    echo 'False';}