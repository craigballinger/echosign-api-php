<?php

    namespace EchoSign\Info;
    
    class UsersToMoveInfo
    {
        
        protected $preserve_group_admins;
        protected $user_emails;
        
        function setPreserveGroupAdmins($preserve){
            
            if (filter_var($preserve, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $preserve === false) {
                $this->preserveGroupAdmins = ((bool)$preserve?'YES':'NO');
                return $this;
            }
            
            throw new \InvalidArgumentException('PreserveGroupAdmins must be a boolean');
        }
        
        function getPreserveGroupAdmins(){
            return $this->preserve_group_admins;
        }
        
        function setUserEmails(array $emails){
            
            $this->user_emails = array();
            return $this->addUserEmails($emails);
            
        }
        
        function getUserEmails(){
            return $this->user_emails;
        }
        
        function addUserEmail($email){
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException($email. ' is not a valid email');
            }
            
            $this->user_emails[] = $email;
            return $this;
            
        }
        
        function addUserEmails(array $emails){
            foreach($emails as $e){
                $this->addUserEmail($e);
            }
            return $this;
        }
        
        function asArray(){
            
            $properties = array(
                                    'preserveGroupAdmins' => $this->preserve_group_admins,
                                    'userEmails' => $this->user_emails
                               );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('usersToMoveInfo' => $properties);
            
        }
        
    }
