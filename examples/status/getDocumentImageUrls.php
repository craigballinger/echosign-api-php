<?php

    include('../setup.php');

    $options = new EchoSign\Options\GetDocumentImageUrlsOptions;

    try{
        $result = $api->getDocumentImageUrls($document_key, $options);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);