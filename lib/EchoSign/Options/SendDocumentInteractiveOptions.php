<?php

    namespace EchoSign\Options;
    
    class SendDocumentInteractiveOptions
    {
        
        protected $authoring_requested;
        protected $auto_login_user;
        protected $chrome;
        
        function setAuthoringRequested($authoring){
            
            if (filter_var($authoring, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $authoring === false) {
                $this->authoring_requested = $authoring;
                return $this;
            }

            throw new \InvalidArgumentException('AuthoringRequested must be a boolean');
            
        }
        
        function getAuthoringRequested(){
            return $this->authoring_requested;
        }
        
        function setAutoLoginUser($auto_login){
            
            if (filter_var($auto_login, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $auto_login === false) {
                $this->auto_login_user = $auto_login;
                return $this;
            }
            
            throw new \InvalidArgumentException('AutoLoginUser must be a boolean');
            
        }
        
        function getAutoLoginUser(){
            return $this->auto_login_user;
        }   
        
        function setChrome($chrome){
            
            if (filter_var($chrome, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $chrome === false) {
                $this->chrome = $chrome;
                return $this;
            }
            
            throw new \InvalidArgumentException('Chrome must be a boolean');
            
        }
        
        function getChrome(){
            return $this->chrome;
        } 
        
        function asArray(){
            
            $properties = array(
                                    'authoringRequested' => $this->authoring_requested,
                                    'autoLoginUser' => $this->auto_login_user,
                                    'chrome' => $this->chrome
                               );
            
            return array('sendDocumentInteractiveOptions' => $properties);
            
        }
        
    }
