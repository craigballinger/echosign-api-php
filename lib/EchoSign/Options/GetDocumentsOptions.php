<?php

    namespace EchoSign\Options;
    
    class GetDocumentsOptions extends AbstractDocumentOptions
    {
        
        protected $combine;
        protected $audit_report;
        
        function setCombine($combine){
            
            if (filter_var($combine, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $combine === false) {
                $this->combine = (bool)$combine;
                return $this;
            }
            
            throw new \InvalidArgumentException('Combine must be a boolean');
        }
        
        function getCombine(){
            return $this->combine;
        }
        
        function setAuditReport($report){
            
            if (filter_var($report, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $report === false) {
                $this->audit_report = (bool)$report;
                return $this;
            }
            
            throw new \InvalidArgumentException('Audit Report must be a boolean');
            
        }
        
        function getAuditReport(){
            return $this->audit_report;
        }
        
        function asArray(){
            
            $inherited = parent::asArray();
            
            $properties = array(
                                'combine' => $this->combine,
                                'auditReport' => $this->audit_report
                               );
            
            $properties = array_merge($inherited['options'], $properties);
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('options' => $properties);
            
        }
        
    }
