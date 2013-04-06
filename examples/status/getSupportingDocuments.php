<?php

    include('../setup.php');

    try{
        $result = $api->getSupportingDocuments($document_key);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);