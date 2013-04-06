<?php

    include('../setup.php');

    $file = EchoSign\Info\FileInfo::createFromFile($filepath);
    
    $widget = new EchoSign\Info\WidgetCreationInfo('Test personalizeUrlWidget', $file);
    $widget->setMergeFields(new EchoSign\Info\MergeFieldInfo($merge_fields));
    
    $personalization = new EchoSign\Info\WidgetPersonalizationInfo($recipient_email);
    
    try{
        $result = $api->createUrlWidget($widget);
        $url = $result->urlWidgetCreationResult->url;
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
        exit;
    }
    
    print '<h2>Unpersonalized Url</h2>';
    print $url;
    
    try{
        $result = $api->personalizeUrlWidget($url, $personalization);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    print '<h2>Personalized Url</h2>';
    print $result->urlWidgetCreationResult->url;
