<?php

    include('../setup.php');

    $options = new EchoSign\Options\GetDocumentUrlsOptions;

    try{
        $result = $api->getDocumentUrls($document_key, $options);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);