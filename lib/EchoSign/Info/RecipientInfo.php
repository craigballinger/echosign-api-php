<?php

    namespace EchoSign\Info;
    
    class RecipientInfo implements \Countable, \IteratorAggregate
    {
        
        protected $recipients;
        
     
        /**
         * 
         * Add a recipient to a document
         * @param string $send_to The email address or fax number for the recipient
         * @param string $role The role of the recipient
         * 
         */
        function addRecipient($send_to, $role = 'SIGNER'){
            
            $allowed_roles = array('SIGNER', 'APPROVER');
            
            if(!in_array($role, $allowed_roles)){
                throw new \InvalidArgumentException('Role must be one of: '.implode(', ', $allowed_roles));
            }
            
            if (filter_var($send_to, FILTER_VALIDATE_EMAIL)) {
                $this->addEmailRecipient($send_to, $role);
                return $this;
            }
            
            if($role !== 'SIGNER'){
                throw new \InvalidArgumentException('Role must be SIGNER for a fax recipient');
            }
            
            $clean_number = preg_replace('/[^0-9]/', '', $send_to);
            
            if(strlen($clean_number) == 10){
                $this->addFaxRecipient($clean_number, 'SIGNER');
                return $this;
            }
            
            throw new \InvalidArgumentException('You must provide either a valid email or 10 digit phone number for the recipient');
            
            
        }
        
        function addRecipients(array $recipients, $role = 'SIGNER'){
            foreach($recipients as $r){
                $this->addRecipient($r, $role);
            }
            return $this;
        }
        
        protected function addEmailRecipient($email, $role){
            $this->recipients[] = array('email' => $email, 'role' => $role);
        }
        
        protected function addFaxRecipient($fax, $role){
            $this->recipients[] = array('fax' => $fax, 'role' => $role);
        }
        
        function count(){
            return count($this->recipients);
        }
        
        function getIterator(){
            return new \ArrayIterator($this->recipients);
        }
        
        function asArray(){
            return $this->recipients;
        }
        
    }
