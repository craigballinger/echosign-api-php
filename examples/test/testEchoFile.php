<?php
    
    include('../setup.php');

    try{
        $result = $api->testEchoFile($filepath);
    }catch(Exception $e){
        print '<h3>An exception occurred:</h3>';
        var_dump($e);
    }
    
    var_dump($result);