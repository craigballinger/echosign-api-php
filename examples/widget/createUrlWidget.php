<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $widget = new EchoSign\Info\WidgetCreationInfo('Test createUrlWidget', $file);
    $widget->setMergeFields(new EchoSign\Info\MergeFieldInfo($merge_fields));
    
    try{
        $result = $api->createUrlWidget($widget);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);
    