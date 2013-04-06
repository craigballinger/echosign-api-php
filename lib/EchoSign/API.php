<?php

    namespace EchoSign;
    
    use EchoSign\Info\DocumentCreationInfo,
        EchoSign\Info\WidgetCreationInfo,
        EchoSign\Info\LibraryDocumentCreationInfo,
        EchoSign\Info\UserCreationInfo,
        EchoSign\Info\WidgetPersonalizationInfo,
        EchoSign\Info\SenderInfo,
        EchoSign\Info\UsersToMoveInfo,
        EchoSign\Options\GetDocumentImageUrlsOptions,
        EchoSign\Options\GetDocumentsOptions,
        EchoSign\Options\GetDocumentUrlsOptions,
        EchoSign\Options\SendDocumentInteractiveOptions;
    
    class API{
        
        static protected $wsdl = 'https://secure.echosign.com/services/EchoSignDocumentService15?wsdl';
        protected $client;
        protected $api_key;
        
        function __construct(\SoapClient $client, $api_key){
            $this->client = $client;
            $this->api_key = $api_key;
        }
        
    #Document Methods
        
        /**
         * 
         * Send a Document to the EchoSign API for signing
         * This will notify both the sender and signee by email that a document
         * is ready to be signed
         * @param DocumentCreationInfo $document instance of DocumentCreationInfo
         * @param SenderInfo $sender instance of SenderInfo
         * 
         */
        function sendDocument(DocumentCreationInfo $document, SenderInfo $sender = null){
            
            $data = array_merge(
                                    array('apiKey' => $this->api_key),
                                    $document->asArray()
                               );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());
            
            $result = $this->client->sendDocument($data);
            
            return $result;

        }
        
        /**
         * 
         * Interactively send a document out for signature
         * This will notify both the sender and signee by email that a document
         * is ready to be signed
         * @param DocumentCreationInfo $document instance of DocumentCreationInfo
         * @param SendDocumentInteractiveOptions $options instance of sendDocumentInteractiveOptions
         * @param SenderInfo $sender instance of SenderInfo
         * 
         */
        function sendDocumentInteractive(DocumentCreationInfo $document, SendDocumentInteractiveOptions $options, SenderInfo $sender = null){
            
            $data = array_merge(
                                    array('apiKey' => $this->api_key),
                                    $document->asArray(),
                                    $options->asArray()
                               );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());
            
            $result = $this->client->sendDocument($data);
            
            return $result;

        }
        
        /**
         * 
         * Send a Document to the EchoSign API for mega signing
         * This will notify both the sender and signee by email that a document
         * is ready to be signed
         * @param DocumentCreationInfo $document instance of DocumentCreationInfo
         * @param SenderInfo $sender instance of SenderInfo
         * 
         */
        function sendDocumentMegaSign(DocumentCreationInfo $document, SenderInfo $sender = null){
            
            $data = array_merge(
                                    array('apiKey' => $this->api_key),
                                    $document->asArray()
                               );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());
            
            $result = $this->client->sendDocumentMegaSign($data);
            
            return $result;

        }
        
        /**
         * 
         * Create a document in the user's document library
         * @param LibraryDocumentCreationInfo $document instance of LibraryDocumentCreationInfo
         * @param SenderInfo $sender instance of SenderInfo
         * 
         */
        function createLibraryDocument(LibraryDocumentCreationInfo $document, SenderInfo $sender = null){
            
            $data = array_merge(
                                    array('apiKey' => $this->api_key),
                                    $document->asArray()
                               );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());
            
            $result = $this->client->createLibraryDocument($data);
            
            return $result;

        }
        
        /*
         * 
         * Sends a reminder to the currenly pending signer
         * @param string $document_key An existing EchoSign document key
         * @param string $comment The message to send as the reminder
         * 
         */
        function sendReminder($document_key, $comment = ''){
            
            $data = array(
                             'apiKey' => $this->api_key,
                             'documentKey' => $document_key,
                             'comment' => $comment
                            );
            
            $result = $this->client->sendReminder($data);
            
            return $result;
            
        }
        
        /*
         * 
         * Cancels a Document
         * @param string $document_key An existing EchoSign document key
         * @param string $comment An optional Comment with the reason of cancellation
         * @param boolean $notify_signer notify signer that the transaction has been cancelled
         * 
         */
        function cancelDocument($document_key, $comment = '', $notify_signer = false){
            
            $data = array(
                             'apiKey' => $this->api_key,
                             'documentKey' => $document_key,
                             'comment' => $comment,
                             'notifySigner' => $notify_signer
                            );
            
            $result = $this->client->cancelDocument($data);
            
            return $result;
            
        }
        
        /*
         * 
         * Removes a Document from EchoSign
         * @param string $document_key An existing EchoSign document key
         * 
         */
        function removeDocument($document_key){
            
            $data = array(
                             'apiKey' => $this->api_key,
                             'documentKey' => $document_key
                            );
            
            $result = $this->client->removeDocument($data);
            
            return $result;
            
        }
        
    #Status Methods
                
        /*
         * 
         * Retrieves the current status of a document
         * @param string $document_key The EchoSign library DocumentKey
         * 
         */
        function getDocumentInfo($document_key){
            
            $data = array(
                             'apiKey' => $this->api_key,
                             'documentKey' => $document_key
                            );

            $result = $this->client->getDocumentInfo($data);

            return $result;
            
        }
        
        /*
         * 
         * Retrieves the up-to-date statuses of documents given ExternalId
         * @param string $email an EchoSign user email
         * @param string $password the matching EchoSign user password
         * 
         */
        function getDocumentInfosByExternalId($external_id, $email = null, $password = null){
            
            $data = array(
                             'apiKey' => $this->api_key,
                             'externalId' => $external_id
                            );
            
            if(!empty($email) && !empty($password)){
            
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \InvalidArgumentException($email . ' is not a valid email');
                }
                
                $auth = array(
                                'email' => $email,
                                'password' => $password
                             );
                
                $data = array_merge($data, $auth);
                
            }
            
            $result = $this->client->getDocumentInfosByExternalId($data);

            return $result;
            
        }
        
        /*
         * 
         * Retrieves the pdf documents of an agreement
         * @param string $document_key An existing EchoSign document key
         * @param GetDocumentsOptions $options options for the request
         * 
         */
        function getDocuments($document_key, GetDocumentsOptions $options){
            
            $data = array_merge(
                             array(
                                    'apiKey' => $this->api_key,
                                    'documentKey' => $document_key,
                                  ),
                             $options->asArray()
                            );

            $result = $this->client->getDocuments($data);

            return $result;
            
        }    
        
        /*
         * 
         * Retrieves the urls of the pdf documents of an agreement
         * @param string $document_key An existing EchoSign document key
         * @param GetDocumentUrlsOptions $options options for the request
         * 
         */
        function getDocumentUrls($document_key, GetDocumentUrlsOptions $options){
            
            $data = array_merge(
                             array(
                                    'apiKey' => $this->api_key,
                                    'documentKey' => $document_key,
                                  ),
                             $options->asArray()
                            );

            $result = $this->client->getDocumentUrls($data);

            return $result;
            
        } 
        
        /*
         * 
         * Retrieves the image urls of the pdf documents of an agreement
         * @param string $document_key An existing EchoSign document key
         * @param GetDocumentImageUrlsOptions $options options for the request
         * 
         */
        function getDocumentImageUrls($document_key, GetDocumentImageUrlsOptions $options){
            
            $data = array_merge(
                             array(
                                    'apiKey' => $this->api_key,
                                    'documentKey' => $document_key,
                                  ),
                             $options->asArray()
                            );

            $result = $this->client->getDocumentImageUrls($data);

            return $result;
            
        } 

        /*
         * 
         * Retrieves the supporting documents of an agreement
         * @param string $document_key An existing EchoSign document key
         * @param array $supporting_document_keys supporting document keys used to retrieve the documents
         * @param string $content_format Format to provide the document content
         * 
         */
        function getSupportingDocuments($document_key, array $supporting_document_keys = array(), $content_format = null){
            
            
            $allowed = array('NONE', 'ORIGINAL', 'CONVERTED_PDF', null);
            
            if(!in_array($content_format, $allowed)){
                throw new \InvalidArgumentException('supportingDocumentContentFormat must be one of: '.implode(', ', $allowed));
            }
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'documentKey' => $document_key,
                            'supportingDocumentKeys' => $supporting_document_keys,
                            'options' => array('supportingDocumentContentFormat' => (!empty($content_format)?$content_format:''))
                         );

            $result = $this->client->getSupportingDocuments($data);

            return $result;
            
        } 

        /*
         * 
         * Retrieves the data entered by the user into the interactive form fields at document signing
         * @param string $document_key An existing EchoSign document key
         * 
         */
        function getFormData($document_key){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'documentKey' => $document_key,
                         );

            $result = $this->client->getFormData($data);

            return $result;
            
        } 

        /*
         * 
         * Retrieves the audit trail for a document
         * @param string $document_key An existing EchoSign document key
         * 
         */
        function getAuditTrail($document_key){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'documentKey' => $document_key,
                         );

            $result = $this->client->getAuditTrail($data);

            return $result;
            
        } 

        /*
         * 
         * Retrieves the audit trail for a document
         * @param string $document_key An existing EchoSign document key
         * 
         */
        function getSigningUrl($document_key){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'documentKey' => $document_key,
                         );

            $result = $this->client->getSigningUrl($data);

            return $result;
            
        } 
        
    #User Methods
        
        /*
         * 
         * Used to create a new user
         * @param UserCreationInfo $user An instance of UserCreationInfo
         * 
         */
        function createUser(UserCreationInfo $user){
            
            $data = $user->asArray();
            $data['apiKey'] = $this->api_key;

            $result = $this->client->createUser($data);

            return $result;
            
        }
        
        /*
         * 
         * Confirm a user can be used as a sender in sendDocument Methods
         * @param string $email An EchoSign user's email
         * @param string $password The matching EchoSign user's password
         * 
         */
        function verifyUser($email, $password){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'email' => $email,
                            'password' => $password
                         );

            $result = $this->client->verifyUser($data);

            return $result;
            
        }
        
        /*
         * 
         * Lists agreements visible to the specified user
         * @param string $email An EchoSign user's email
         * @param string $password The matching EchoSign user's password
         * 
         */
        function getUserDocuments($email, $password){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'userCredentials' => array(
                                                        'email' => $email,
                                                        'password' => $password
                                                      )
                         );

            $result = $this->client->getUserDocuments($data);

            return $result;
            
        }
        
        /*
         * 
         * Lists agreements visible to the current API key user
         * 
         */
        function getMyDocuments(){
            
            $data = array('apiKey' => $this->api_key);
            $result = $this->client->getMyDocuments($data);

            return $result;
            
        }
        
        /*
         * 
         * Lists library documents available to the specified user
         * @param string $email An EchoSign user's email
         * @param string $password The matching EchoSign user's password
         * 
         */
        function getLibraryDocumentsForUser($email, $password){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'userCredentials' => array(
                                                        'email' => $email,
                                                        'password' => $password
                                                      )
                         );

            $result = $this->client->getLibraryDocumentsForUser($data);

            return $result;
            
        }
        
        /*
         * 
         * Lists library documents available to the current API key user
         * 
         */
        function getMyLibraryDocuments(){
            
            $data = array('apiKey' => $this->api_key);
            $result = $this->client->getMyLibraryDocuments($data);

            return $result;
            
        }
        
        /*
         * 
         * Lists widgets available to the specified user
         * @param string $email An EchoSign user's email
         * @param string $password The matching EchoSign user's password
         * 
         */
        function getWidgetsForUser($email, $password){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'userCredentials' => array(
                                                        'email' => $email,
                                                        'password' => $password
                                                      )
                         );

            $result = $this->client->getWidgetsForUser($data);

            return $result;
            
        }
        
        /*
         * 
         * Lists widgets available to the current API key user
         * 
         */
        function getMyWidgets(){
            
            $data = array('apiKey' => $this->api_key);
            $result = $this->client->getMyWidgets($data);

            return $result;
            
        }
                
        /*
         * 
         * Lists child documents of the specified master document
         * @param string $document_key an existing EchoSign document key for a MegaSignDocument
         * 
         */
        function getMegaSignDocument($document_key){
            
            $data = array(
                             'apiKey' => $this->api_key,
                             'documentKey' => $document_key,
                         );
            
            $result = $this->client->getMegaSignDocument($data);

            return $result;
            
        }
        
        /*
         * 
         * Lists all the users who are in the same account as that of the apiKey holder who makes the request
         * 
         */
        function getUsersInAccount(){
            
            $data = array('apiKey' => $this->api_key);
            $result = $this->client->getUsersInAccount($data);

            return $result;
            
        }
        
        /*
         * 
         * Create a paying account
         * @param UserCreationInfo $user The user who will be the administrator of the account
         * @param AccountCreationInfo $account The new account information
         * 
         */
        function createAccount(UserCreationInfo $user, AccountCreationInfo $account){
            
            $data = array_merge(
                                array('apiKey' => $this->api_key),
                                $user->asArray(),
                                $account->asArray()
                               );
            
            $result = $this->client->createAccount($data);
            
            return $result;
            
        }
        
        /*
         * 
         * Creates a new EchoSign group
         * @param string $name The name of the new group
         * 
         */
        function createGroup($name){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'groupName' => $name
                         );
            
            $result = $this->client->createGroup($data);
            
            return $result;
            
        }
        
        /*
         * 
         * Delete an existing EchoSign group
         * @param string $key The key of the existing group to delete
         * 
         */
        function deleteGroup($key){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'groupKey' => $key
                         );
            
            $result = $this->client->deleteGroup($data);
            
            return $result;
            
        }
        
        /*
         * 
         * Rename an existing EchoSign group
         * @param string $key The key of the existing group to rename
         * @param string $name The new name for the group
         * 
         */
        function renameGroup($key, $name){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'groupKey' => $key,
                            'groupName' => $name
                         );
            
            $result = $this->client->renameGroup($data);
            
            return $result;
            
        }
                
        /*
         * 
         * Lists the groups in the EchoSign account
         * 
         */
        function getGroupsInAccount(){
            
            $data = array('apiKey' => $this->api_key);
            $result = $this->client->getGroupsInAccount($data);

            return $result;
            
        }
                
        /*
         * 
         * Lists the users in an EchoSign group
         * @param string $key The key of the group to get users from
         * 
         */
        function getUsersInGroup($group_key){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'groupKey' => $group_key
                         );
            
            $result = $this->client->getUsersInGroup($data);

            return $result;
            
        }
                
        /*
         * 
         * Lists the users in an EchoSign group
         * @param string $key The key of the group to get users from
         * @param UsersToMoveInfo $users an instance of UsersToMoveInfo
         * 
         */
        function moveUsersToGroup($group_key, UsersToMoveInfo $users){
            
            $data = array(
                            'apiKey' => $this->api_key,
                            'groupKey' => $group_key
                         );
            
            $data = array_merge($data, $users->asArray()); 
            
            $result = $this->client->moveUsersToGroup($data);

            return $result;
            
        }
    
    #Widget Methods
        
        /**
         * 
         * Create an Embedded Widget to place on an internal custom page
         * @param WidgetCreationInfo $widget instance of WidgetCreationInfo
         * @param SenderInfo $sender instance of SenderInfo
         * 
         */        
        function createEmbeddedWidget(WidgetCreationInfo $widget, SenderInfo $sender = null){
            
            $data = array_merge(
                                    array('apiKey' => $this->api_key),
                                    $widget->asArray()
                                );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());

            $result = $this->client->createEmbeddedWidget($data);
            
            return $result;
            
        }
        
        /**
         * 
         * Create a Personalized Embedded Widget to place on an internal custom page
         * @param WidgetCreationInfo $widget instance of WidgetCreationInfo
         * @param EchosignWidgetPersonalization $personalization The personalization information for the widget
         * @param SenderInfo $sender instance of SenderInfo
         * 
         */          
        function createPersonalEmbeddedWidget(WidgetCreationInfo $widget, WidgetPersonalizationInfo $personalization, SenderInfo $sender = null){
           
            $data = array_merge(
                                            array('apiKey' => $this->api_key),
                                            $widget->asArray(), 
                                            $personalization->asArray()
                                        );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());
            
            $result = $this->client->createPersonalEmbeddedWidget($data);
            
            return $result;
            
        }
        
        /**
         * 
         * Personalize a previously created Embedded Widget
         * @param string $javascript The Embedded Widget javascript
         * @param WidgetPersonalizationInfo $personalization The personalization information for the widget
         * 
         */          
        function personalizeEmbeddedWidget($javascript, WidgetPersonalizationInfo $personalization){
            
            $data = array_merge(
                                            array(
                                                    'apiKey' => $this->api_key,
                                                    'widgetJavascript' => $javascript
                                                ), 
                                            $personalization->asArray()
                                        );

            $result = $this->client->personalizeEmbeddedWidget($data);
            
            return $result;
            
        }
        
        /**
         * 
         * Create an Url Widget to that returns a Url to redirect the user to sign
         * @param WidgetCreationInfo $widget instance of WidgetCreationInfo
         * 
         */        
        function createUrlWidget(WidgetCreationInfo $widget, SenderInfo $sender){
            
            $data = array_merge(
                                            array('apiKey' => $this->api_key),
                                            $widget->asArray()
                                        );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());

            $result = $this->client->createUrlWidget($data);
            
            return $result;
            
        }
        
        /**
         * 
         * Create a Personalized Url Widget
         * @param WidgetCreationInfo $widget instance of WidgetCreationInfo
         * @param EchosignWidgetPersonalization $personalization The personalization information for the widget
         * @param SenderInfo $sender instance of SenderInfo
         * 
         */          
        function createPersonalUrlWidget(WidgetCreationInfo $widget, WidgetPersonalizationInfo $personalization, SenderInfo $sender = null){
            
            $data = array_merge(
                                            array('apiKey' => $this->api_key),
                                            $widget->asArray(), 
                                            $personalization->asArray()
                                        );
            
            if(!is_null($sender)) $data = array_merge($data, $sender->asArray());
            
            $result = $this->client->createPersonalUrlWidget($data);
            
            return $result;
            
        }
        
        /**
         * 
         * Personalize a previously created Url Widget
         * @param string $url The  Url returned by createUrlWidget
         * @param WidgetPersonalizationInfo $personalization The personalization information for the widget
         * 
         */          
        function personalizeUrlWidget($url, Info\WidgetPersonalizationInfo $personalization){
            
            if(!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException($url . ' does not appear to be a valid Url');
            }
            
            $package_data = array_merge(
                                            array('apiKey' => $this->api_key),
                                            array('widgetUrl' => $url), 
                                            $personalization->asArray()
                                        );

            $result = $this->client->personalizeUrlWidget($package_data);
            
            return $result;
            
        }
        
        
    #Test Methods
        
                
        /**
         * 
         * Tests that you can successfully connect to EchoSign's API
         * 
         */
        function testPing(){
            
            $result = $this->client->testPing(array('apiKey' => $this->api_key));
            return $result;
        }
        
        /**
         * 
         * Tests that you can successfully send files to EchoSign
         * @param string $filepath Path to a local file to send to the Echo Test
         * 
         */
        function testEchoFile($filepath){
            
            $package = array(
                                'apiKey' => $this->api_key, 
                                'file' => file_get_contents($filepath)
                            );
            
            $result = $this->client->testEchoFile($package);
            
            return $result;
            
        }
        
    #Accessors
        
        static function setWSDL($wsdl){
            
            if(!filter_var($wsdl, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException($wdsl . ' does not appear to be a valid Url');
            }
            
            self::$wsdl = $wsdl;
        }
        
        static function getWSDL(){
            return self::$wsdl;
        }
        
    }
