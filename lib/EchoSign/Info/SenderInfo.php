<?php

    namespace EchoSign\Info;
    
    class SenderInfo
    {
        
        protected $user_key;
        protected $email;
        protected $password;
        
        static function createWithUserKey($user_key){
            $sender = new self;
            $sender->setUserKey($user_key);
            return $sender;
        }
        
        static function createWithEmail($email, $password){
            $sender = new self;
            $sender->setEmail($email);
            $sender->setPassword($password);
            return $sender;
        }
        
        function setUserKey($user_key){
            $this->user_key = $user_key;
            return $this;
        }
        
        function getUserKey(){
            return $this->user_key;
        }
        
        function setEmail($email){
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->email = $email;
                return $this;
            }
            
            throw new \InvalidArgumentException($email . ' does not appear to be a valid email address');
            
        }
        
        function getEmail(){
            return $this->email;
        }
        
        function setPassword($password){
            $this->password = $password;
            return $this;
        }
        
        function getPassword(){
            return $this->password;
        }
        
        function asArray(){
            
            $properties = array(
                            'userKey' => $this->user_key,
                            'email' => $this->email,
                            'password' => $this->password,
                        );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('senderInfo' => $properties);
            
        }
        
    }