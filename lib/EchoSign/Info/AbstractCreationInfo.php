<?php

    namespace EchoSign\Info;

    class AbstractCreationInfo
    {

		const SIGNATURE_FLOW_SENDER_SIGNATURE_NOT_REQUIRED = 'SENDER_SIGNATURE_NOT_REQUIRED';
		const SIGNATURE_FLOW_SENDER_SIGNS_LAST = 'SENDER_SIGNS_LAST';
		const SIGNATURE_FLOW_SENDER_SINGS_FIRST = 'SENDER_SIGNS_FIRST';

        protected $name;
        protected $file_infos;
        protected $filename;
        protected $locale;
        protected $signature_flow;
        protected $security_options;
        protected $callback_info;
        protected $merge_fields;

        function __construct($name, FileInfo $file = null){
            $this->name = $name;
			$this->file_infos = new FileInfos($file);
        }

        function setName($name){
            $this->name = $name;
            return $this;
        }

        function getName(){
            return $this->name;
        }

        function setFile(FileInfo $file){
			$this->file_infos = new FileInfos($file);
            return $this;
        }

        function getFile(){
            return $this->file_infos->getFile();
        }

		function addFile(FileInfo $file) {
			$this->file_infos->addFile($file);
			return $this;
		}

		function getFiles() {
			return $this->file_infos;
		}

		function setFiles(FileInfos $files) {
			$this->file_infos = $files;
			return $this;
		}

        function setLocale($locale){
            $this->locale = $locale;
            return $this;
        }

        function getLocale(){
            return $this->locale;
        }

        function setSignatureFlow($signature_flow){

            $allowed = array(self::SIGNATURE_FLOW_SENDER_SIGNATURE_NOT_REQUIRED, self::SIGNATURE_FLOW_SENDER_SIGNS_LAST, self::SIGNATURE_FLOW_SENDER_SINGS_FIRST);

            if(!in_array($signature_flow, $allowed)){
                throw new \InvalidArgumentException('signatureFlow must be one of: '.implode(', ', $allowed));
            }

            $this->signature_flow = $signature_flow;
            return $this;
        }

        function getSignatureFlow(){
            return $this->signature_flow;
        }

        function setSecurityOptions(SecurityOptions $security_options){
            $this->security_options = $security_options;
            return $this;
        }

        function getSecurityOptions(){
            return $this->security_options;
        }

        function setCallbackInfo($callback_url){

            if (!filter_var($callback_url, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException("The callback url is invalid.");
            }

            if(!preg_match('#^(http://|https://)#', $callback_url)){
                $callback_url = 'http://'.$callback_url;
            }

            $this->callback_info = $callback_url;
            return $this;
        }

        function getCallbackInfo(){
            return $this->callback_info;
        }

        function setMergeFields(MergeFieldInfo $merge_fields){
            $this->merge_fields = $merge_fields;
            return $this;
        }

        function getMergeFields(){
            return $this->merge_fields;
        }

        function asArray(){

            $properties = array(
                                    'name' => $this->name,
                                    'fileInfos' => $this->file_infos->asArray(),
                                    'locale' => $this->locale,
                                    'signatureFlow' => $this->signature_flow
                               );

            if(!empty($this->callback_info)) $properties['callbackInfo']['signedDocumentUrl'] = $this->callback_info;
            if(!empty($this->security_options)) $properties = array_merge($properties, $this->security_options->asArray());
            if(!empty($this->merge_fields)) $properties = array_merge($properties, array('mergeFieldInfo' => array('mergeFields' => $this->merge_fields->asArray())));

            return $properties;

        }
    }
