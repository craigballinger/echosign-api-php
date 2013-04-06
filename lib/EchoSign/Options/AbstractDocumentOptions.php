<?php

    namespace EchoSign\Options;
    
    class AbstractDocumentOptions
    {
        
        protected $version_key;
        protected $participant_email;
        protected $attach_supporting_documents;
        
        function setVersionKey($version_key){
            $this->version_key = $version_key;
            return $this;
        }
        
        function getVersionKey(){
            return $this->version_key;
        }
        
        function setParticipantEmail($email){
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->email = $email;
                return $this;
            }
            
            throw new \InvalidArgumentException($email . ' is not a valid email address');
            
        }
        
        function getParticipantEmail(){
            return $this->participant_email;
        }
        
        function setAttachSupportingDocuments($attach){
            
            if (filter_var($attach, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $attach === false) {
                $this->attach_supporting_documents = $attach;
                return $this;
            }
            
            throw new \InvalidArgumentException('AttachSupportingDocuments must be a boolean');
            
        }
        
        function getAttachSupportingDocuments(){
            return $this->attach_supporting_documents;
        }
        
        function asArray(){
            
            $properties = array(
                            'versionKey' => $this->version_key,
                            'participantEmail' => $this->participant_email,
                            'attachSupportingDocuments' => $this->attach_supporting_documents,
                        );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('options' => $properties);
            
        }
        
    }