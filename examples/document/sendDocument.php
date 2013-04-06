<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $recipients = new EchoSign\Info\RecipientInfo;
    $recipients->addRecipient($recipient_email);
    
    $document = new EchoSign\Info\DocumentCreationInfo('Test sendDocument', $file);
    $document->setRecipients($recipients)
             ->setMergeFields(new EchoSign\Info\MergeFieldInfo($merge_fields));
    
    try{
        $result = $api->sendDocument($document);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);