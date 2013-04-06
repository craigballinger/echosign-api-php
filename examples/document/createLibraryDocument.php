<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $document = new EchoSign\Info\LibraryDocumentCreationInfo('Test createLibraryDocument', $file);
    $document->setSignatureFlow('SENDER_SIGNATURE_NOT_REQUIRED')
         ->setSignatureType('ESIGN')
         ->setLibrarySharingMode('ACCOUNT');
    
    try{
        $result = $api->createLibraryDocument($document);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);