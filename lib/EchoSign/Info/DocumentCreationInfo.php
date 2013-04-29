<?php

    namespace EchoSign\Info;
    
    class DocumentCreationInfo extends AbstractCreationInfo
    {
        
        protected $recipients;
        protected $ccs;
        protected $message;
        protected $signature_type;
        protected $external_id;
        protected $reminder_frequency;
        protected $days_until_signing_deadline;
        
        function setRecipients(RecipientInfo $recipients){
            $this->recipients = $recipients;
            return $this;
        }
        
        function getRecipients(){
            return $this->recipients;
        }
        
        function setCCs(array $ccs){
            
            foreach($ccs as $e){
                if(!filter_var($e, FILTER_VALIDATE_EMAIL)) {
                    throw new \InvalidArgumentException($e. ' is not a valid email');
                }
            }
            
            $this->ccs = $ccs;
	    return $this;
        }
        
        function getCCs(){
            return $this->ccs;
        }
                
        function setMessage($message){
            $this->message = $message;
            return $this;
        }
        
        function getMessage(){
            return $this->message;
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
        
        function setExternalId($external_id){
            $this->external_id = $external_id;
            return $this;
        }
        
        function getExternalId(){
            return $this->external_id;
        }
                
        function setReminderFrequency($reminder_frequency){
            
            $allowed = array('DAILY_UNTIL_SIGNED', 'WEEKLY_UNTIL_SIGNED');
            
            if(!in_array($reminder_frequency, $allowed)){
                throw new \InvalidArgumentException('ReminderFrequency must be one of: '.implode(', ', $allowed));
            }
            
            $this->reminder_frequency = $reminder_frequency;
            return $this;
        }
        
        function getReminderFrequency(){
            return $this->reminder_frequency;
        }
                
        function setDaysUntilSigningDeadline($days){
            
            if(!filter_var($days, FILTER_VALIDATE_INT)) {
                throw new \InvalidArgumentException('DaysUntilSigningDeadline must be an integer');
            }
            
            $this->days_until_signing_deadline = $days;
            return $this;
        }
        
        function getDaysUntilSigningDeadline(){
            return $this->days_until_signing_deadline;
        }
        
        function asArray(){
            
            $inherited = parent::asArray();
            
            $properties = array(
                            
                            'recipients' => $this->recipients->asArray(),
                            'ccs' => $this->ccs,
                            'message' => $this->message,
                            'signatureType' => $this->signature_type,
                            'reminderFrequency' => $this->reminder_frequency,
                            'daysUntilSigningDeadline' => $this->days_until_signing_deadline
                
                        );
            
            $properties = array_merge($inherited, $properties);
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('documentCreationInfo' => $properties);
            
        }
        
    }
