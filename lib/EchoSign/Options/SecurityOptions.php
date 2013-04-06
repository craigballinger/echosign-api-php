<?php

    namespace EchoSign\Options;
    
    class SecurityOptions
    {
        
        protected $password;
        protected $protect_open;
        protected $password_protection;
        protected $web_identity_protection;
        protected $kba_protection;
        
        function setPassword($password){
            $this->password = $password;
        }
        
        function getPassword(){
            return $this->password;
        }
        
        function setProtectOpen($protect_open){
            
            if (filter_var($protect_open, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $protect_open === false) {
                $this->protect_open = (bool)$protect_open;
                return $this;
            }
            
            throw new \InvalidArgumentException('ProtectOpen must be a boolean');
        }
        
        function getProtectOpen(){
            return $this->protect_open;
        }
        
        function setPasswordProtection($protection){
            
            $allowed = $this->getAllowedProtection();
            
            if(!in_array($protection, $allowed)){
                throw new \InvalidArgumentException('PasswordProtection must be one of: '.implode(', ', $allowed));
            }
            
            $this->password_protection = $protection;
            return $this;
            
        }
        
        function getPasswordProtection(){
            return $this->password_protection;
        }
        
        function setWebIdentityProtection($protection){
            
            $allowed = $this->getAllowedProtection();
            
            if(!in_array($protection, $allowed)){
                throw new \InvalidArgumentException('WebIdentityProtection must be one of: '.implode(', ', $allowed));
            }
            
            $this->web_identity_protection = $protection;
            return $this;
            
        }
        
        function getWebIdentityProtection(){
            return $this->web_identity_protection;
        }
        
        function setKbaProtection($protection){
            
            $allowed = $this->getAllowedProtection();
            
            if(!in_array($protection, $allowed)){
                throw new \InvalidArgumentException('KbaProtection must be one of: '.implode(', ', $allowed));
            }
            
            $this->kba_protection = $protection;
            return $this;
            
        }
        
        function getKbaProtection(){
            return $this->kba_protection;
        }
        
        protected function getAllowedProtection(){
            return array('NONE', 'EXTERNAL_USERS', 'INTERNAL_USERS', 'ALL_USERS');
        }
        
        function asArray(){
            
            $properties = array(
                                    'password' => $this->password,
                                    'protectOpen' => $this->protect_open,
                                    'passwordProtection' => $this->password_protection,
                                    'webIdentityProtection' => $this->web_identity_protection,
                                    'kbaProtection' => $this->kba_protection
                               );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('securityOptions' => $properties);
            
        }
        
    }