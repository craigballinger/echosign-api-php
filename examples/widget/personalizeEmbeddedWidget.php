<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $widget = new EchoSign\Info\WidgetCreationInfo('Test personalizeEmbeddedWidget', $file);
    $widget->setMergeFields(new EchoSign\Info\MergeFieldInfo($merge_fields));
    
    $personalization = new EchoSign\Info\WidgetPersonalizationInfo($recipient_email);
    
    try{
        $result = $api->createEmbeddedWidget($widget);
        $js = $result->embeddedWidgetCreationResult->javascript;
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
        exit;
    }
    
    print '<h2>Unpersonalized Widget</h2>';
    print $result->embeddedWidgetCreationResult->javascript;
    
    try{
        $result = $api->personalizeEmbeddedWidget($js, $personalization);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    print '<h2>Personalized Widget</h2>';
    print $result->embeddedWidgetCreationResult->javascript;
