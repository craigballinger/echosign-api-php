<?php

    namespace EchoSign\Info;
    
    class WidgetPersonalizationInfo
    {
        
        protected $email;
        protected $comment;
        protected $expiration;
        protected $reusable;
        protected $allow_manual_verification;
        
        function __construct($email){
            $this->setEmail($email);
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
        
        function setComment($comment){
            $this->comment = $comment;
            return $this;
        }
        
        function getComment(){
            return $this->comment;
        }
        
        function setExpiration($expiration){
            
            $date = new DateTime($expiration);
            $this->expiration = $date;
            return $this;
            
        }
        
        function getExpiration(){
            return $this->expiration;
        }
        
        function setReusable($reusable){
            
            if (filter_var($reusable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $reusable === false) {
                $this->reusable = $reusable;
                return $this;
            }
            
            throw new \InvalidArgumentException('SetReusable must be a boolean');

        }
        
        function getReusable(){
            return $this->reusable;
        }
        
        function setAllowManualVerification($allow){
            
            if (filter_var($allow, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $allow === false) {
                $this->allow_manual_verification = $allow;
                return $this;
            }
            
            throw new \InvalidArgumentException('AllowManualVerification must be a boolean');
        }
        
        function getAllowManualVerification(){
            return $this->allow_manual_verification;
        }
        
        function asArray(){
            
            $properties = array(
                            'email' => $this->email,
                            'comment' => $this->comment,
                            'expiration' => (!empty($this->expiration)?$this->expiration->format('c'):''),
                            'reusable' => $this->reusable,
                            'allowManualVerification' => $this->allow_manual_verification
                        );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('personalizationInfo' => $properties);
            
        }
        
    }