<?php

    include('../setup.php');

    try{
        $result = $api->getMyWidgets();
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);