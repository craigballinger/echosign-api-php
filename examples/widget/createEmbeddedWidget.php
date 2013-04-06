<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $widget = new EchoSign\Info\WidgetCreationInfo('Test createEmbeddedWidget', $file);
    $widget->setMergeFields(new EchoSign\Info\MergeFieldInfo($merge_fields));
    
    try{
        $result = $api->createEmbeddedWidget($widget);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);
    