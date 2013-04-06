<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $recipients = new EchoSign\Info\RecipientInfo;
    $recipients->addRecipient($recipient_email);
    
    $document = new EchoSign\Info\DocumentCreationInfo('Test sendDocumentInteractive', $file);
    $document->setRecipients($recipients)
             ->setMergeFields(new EchoSign\Info\MergeFieldInfo($merge_fields));
    
    $options = new EchoSign\Options\SendDocumentInteractiveOptions;
    $options->setAuthoringRequested(false)
            ->setAutoLoginUser(false)
            ->setChrome(false);
    
    try{
        $result = $api->sendDocumentInteractive($document, $options);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);