<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    /*
     *  Setup variables
     *  Change these before testing
     */
    $api_key = 'YOUR ECHOSIGN API KEY';
    
    $recipient_email = 'recipient email address';
    
    $merge_fields = array(
                            'first_name' => 'Craig', 
                            'last_name' => 'Ballinger', 
                            'website' => 'craigballinger.com'
                         );
    
    //for testing document methods not required to start
    $document_key = 'AN EXISTING DOCUMENT KEY'; 
    $mega_sign_document_key = 'AN EXISTING MEGA SIGN DOCUMENT KEY';
    
    $filepath = '../demo.pdf';
    //end setup variables
    
    include('../../Autoloader.php');
    
    $ESLoader = new SplClassLoader('EchoSign', realpath(__DIR__.'/../lib').'/');
    $ESLoader->register();
    
    $client = new SoapClient(EchoSign\API::getWSDL());
    $api = new EchoSign\API($client, $api_key);
    
    print '<pre>';
