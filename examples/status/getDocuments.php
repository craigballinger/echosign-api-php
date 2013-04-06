<?php

    include('../setup.php');

    $options = new EchoSign\Options\GetDocumentsOptions;

    try{
        $result = $api->getDocuments($document_key, $options);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);