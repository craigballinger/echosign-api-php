<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $widget = new EchoSign\Info\WidgetCreationInfo('Test createPersonalEmbeddedWidget', $file);
    $widget->setMergeFields(new EchoSign\Info\MergeFieldInfo($merge_fields));
    
    $personalization = new EchoSign\Info\WidgetPersonalizationInfo($recipient_email);
    
    try{
        $result = $api->createPersonalEmbeddedWidget($widget, $personalization);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);
    