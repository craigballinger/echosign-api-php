<?php

    namespace EchoSign\Info;  
    
    class LibraryDocumentCreationInfo
    {
        
        protected $name;
        protected $file;
        protected $filename;
        protected $signature_flow;
        protected $signature_type;
        protected $library_sharing_mode;
                
        function __construct($name, FileInfo $file){
            $this->name = $name;
            $this->file = $file;
        }
        
        function setName($name){
            $this->name = $name;
            return $this;
        }
        
        function getName(){
            return $this->name;
        }
        
        function setFile(FileInfo $file){
            $this->file = $file;
            return $this;
        }
        
        function getFile(){
            return $this->file;
        }
        
        function setSignatureFlow($signature_flow){
            
            $allowed = array('SENDER_SIGNATURE_NOT_REQUIRED', 'SENDER_SIGNS_LAST', 'SENDER_SIGNS_FIRST');
            
            if(!in_array($signature_flow, $allowed)){
                throw new \InvalidArgumentException('signatureFlow must be one of: '.implode(', ', $allowed));
            }
            
            $this->signature_file = $signature_flow;
            return $this;
        }
        
        function getSignatureFlow(){
            return $this->signature_flow;
        }
        
                
        function setSignatureType($signature_type){
            
            $allowed = array('ESIGN', 'WRITTEN');
            
            if(!in_array($signature_type, $allowed)){
                throw new \InvalidArgumentException('signatureType must be one of: '.implode(', ', $allowed));
            }
            
            $this->signature_type = $signature_type;
            return $this;
        }
        
        function getSignatureType(){
            return $this->signature_type;
        }
        
        function setLibrarySharingMode($library_sharing_mode){
            
            $allowed = array('USER', 'GROUP', 'ACCOUNT');
            
            if(!in_array($library_sharing_mode, $allowed)){
                throw new \InvalidArgumentException('LibrarySharingMode must be one of: '.implode(', ', $allowed));
            }
            
            $this->library_sharing_mode = $library_sharing_mode;
            return $this;
        }
        
        function getLibrarySharingMode(){
            return $this->library_sharing_mode;
        }
        
        function asArray(){
            
            $properties = array(
                            
                            'name' => $this->name,
                            'fileInfos' => $this->file->asArray(),
                            'signatureType' => $this->signature_type,
                            'signatureFlow' => $this->signature_flow,
                            'librarySharingMode' => $this->library_sharing_mode
                        );
            
            return array('libraryDocumentCreationInfo' => $properties);
            
        }
        
    }
