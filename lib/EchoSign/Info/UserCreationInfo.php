<?php

    namespace EchoSign\Info;
    
    class UserCreationInfo
    {
        
        protected $email;
        protected $password;
        protected $first_name;
        protected $last_name;
        protected $group_key;
        protected $phone;
        protected $company;
        protected $opt_in;
        protected $custom_field_1;
        protected $custom_field_2;
        protected $custom_field_3;
        
        function __construct($email, $password, $first_name, $last_name){
            $this->setEmail($email)
                 ->setPassword($password)
                 ->setFirstName($first_name)
                 ->setLastName($last_name);
        }
        
        function setEmail($email){
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->email = $email;
                return $this;
            }
            
            throw new \InvalidArgumentException($email . ' is not a valid email address');
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
        
        function setFirstName($first_name){
            $this->first_name = $first_name;
            return $this;
        }
        
        function getFirstName(){
            return $this->first_name;
        }
        
        function setLastName($last_name){
            $this->last_name = $last_name;
            return $this;
        }
        
        function getLastName(){
            return $this->last_name;
        }
        
        function setGroupKey($group_key){
            $this->group_key = $group_key;
            return $this;
        }
        
        function getGroupKey(){
            return $this->group_key;
        }
        
        function setPhone($phone){
            $this->phone = $phone;
            return $this;
        }
        
        function getPhone(){
            return $this->phone;
        }
        
        function setCompany($company){
            $this->company = $company;
            return $this;
        }
        
        function getCompany(){
            return $this->company;
        }
        
        function setOptIn($opt_in){
            
            if (filter_var($opt_in, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null || $opt_in === false) {
                $this->opt_in = ((bool)$opt_in?'YES':'NO');
            }
            
            return $this;
        }
        
        function getOptIn(){
            return $this->opt_in;
        }
        
        function setCustomField1($custom_field_1){
            $this->custom_field_1 = $custom_field_1;
            return $this;
        }
        
        function getCustomField1(){
            return $this->custom_field_1;
        }
        
        function setCustomField2($custom_field_2){
            $this->custom_field_1 = $custom_field_2;
            return $this;
        }
        
        function getCustomField2(){
            return $this->custom_field_2;
        }
        
        function setCustomField3($custom_field_3){
            $this->custom_field_3 = $custom_field_3;
            return $this;
        }
        
        function getCustomField3(){
            return $this->custom_field_3;
        }
        
        function asArray(){
            
            $properties = array(
                                
                                'email' => $this->email,
                                'password' => $this->password,
                                'firstName' => $this->first_name,
                                'lastName' => $this->last_name,
                                'groupKey' => $this->group_key,
                                'phone' => $this->phone,
                                'company' => $this->company,
                                'optIn' => $this->opt_in,
                                'customField1' => $this->custom_field_1,
                                'customField2' => $this->custom_field_2,
                                'customField3' => $this->custom_field_3
                
                               );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('userCreationInfo' => $properties);
            
        }
    }