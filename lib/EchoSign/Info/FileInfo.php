<?php

    namespace EchoSign\Info;
    
    class FileInfo
    {
        
        protected $filename;
        protected $mime_type;
        protected $file;
        protected $url;
        protected $library_document_key;
        protected $library_document_name;
        
        static function createFromFile($file, $filename = null){
            
            $f = pathinfo($file);
            
            $fileInfo = new self;
            $fileInfo->setFile($file)
                     ->setMimeType(static::getMimeByExtension($f['extension']))
                     ->setFilename((!empty($filename) ? $filename : $f['filename'].'.'.$f['extension']));
            return $fileInfo;
        }
        
        static function createFromLibraryDocumentKey($library_document_key){
            $fileInfo = new self;
            $fileInfo->setLibraryDocumentKey($library_document_key);
            return $fileInfo;
        }
        
        static function createFromLibraryDocumentName($library_document_name){
            $fileInfo = new self;
            $fileInfo->setLibraryDocumentName($library_document_name);
            return $fileInfo;
        }
        
        function setFilename($filename){
            $this->filename = $filename;
            return $this;
        }
        
        function getFilename(){
            return $this->filename;
        }
        
        function setMimeType($mime_type){
            
            if(!in_array($mime_type, static::getMimeTypes())){
                throw new \InvalidArgumentException($mime_type . ' is not a supported mime type');
            }
            
            $this->mime_type = $mime_type;
            return $this;
        }
        
        function getMimeType(){
            return $this->mime_type;
        }
        
        function setFile($file){
            
            $f = pathinfo($file);
            
            $this->file = $file;
            $this->setMimeType(static::getMimeByExtension($f['extension']));
            
            return $this;
        }
        
        function getFile(){
            return $this->file;
        }
        
        function setUrl($url){
            $this->url = $url;
            return $this;
        }
        
        function getUrl(){
            return $this->url;
        }
        
        function setLibraryDocumentKey($library_document_key){
            $this->library_document_key = $library_document_key;
            return $this;
        }
        
        function getLibraryDocumentKey(){
            return $this->library_document_key;
        }
        
        function setLibraryDocumentName($library_document_name){
            $this->library_document_name = $library_document_name;
            return $this;
        }
        
        function getLibraryDocumentName(){
            return $this->library_document_name;
        }
        
        function asArray(){
            
            $properties = array(
                            'fileName' => $this->filename,
                            'mimeType' => $this->mime_type,
                            'file' => (!empty($this->file) ? file_get_contents($this->file):''),
                            'url' => $this->url,
                            'libraryDocumentKey' => $this->library_document_key,
                            'libraryDocumentName' => $this->library_document_name
                        );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('FileInfo' => $properties);
            
        }
        
        static function getMimeByExtension($ext){
            
            $types = static::getMimeTypes();
            
            if(in_array($ext, array_keys($types))){
                return $types[$ext];
            }
            
            throw new \InvalidArgumentException('.' .$ext. ' is not a supported extension');
            
        }
        
        protected static function getMimeTypes(){
            
            return array(
                            'pdf' => 'application/pdf',
                            'doc' => 'application/msword',
                            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'xls' => 'application/vnd.ms-excel',
                            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'ppt' => 'application/vnd.ms-powerpoint',
                            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                          );
        }
        
    }
