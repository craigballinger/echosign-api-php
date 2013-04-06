<?php

    namespace EchoSign\Info;
    
    class AccountCreationInfo
    {
        
        protected $company_name;
        protected $account_type;
        protected $num_seats;
        
        function __construct($company_name, $account_type, $num_seats){
            $this->setCompanyName($company_name)
                 ->setAccountType($account_type)
                 ->setNumSeats($num_seats);
        }
        
        function setCompanyName($company_name){
            $this->company_name = $company_name;
            return $this;
        }
        
        function getCompanyName(){
            return $this->company_name;
        }
        
        function setAccountType($account_type){
            
            $allowed = array('PRO', 'TEAM', 'TEAM_TRIAL', 'ENTERPRISE', 'ENTERPRISE_TRIAL', 'GLOBAL', 'GLOBAL_TRIAL');
            
            if(!in_array($account_type, $allowed)){
                throw new \InvalidArgumentException('AccountType must be one of: '.implode(', ', $allowed));
            }
            
            $this->account_type = $account_type;
            
            $this->confirmSeatRequirements();
            
            return $this;
        }
        
        function getAccountType(){
            return $this->account_type;
        }
        
        function setNumSeats($num_seats){

            if(!filter_var($num_seats, FILTER_VALIDATE_INT)) {
                throw new \InvalidArgumentException('NumSeats must be an integer');
            }
            
            $this->num_seats = $num_seats;
            
            $this->confirmSeatRequirements();
            
            return $this;
            
        }
        
        protected function confirmSeatRequirements(){
            
            if(empty($this->account_type) || empty($this->num_seats)){
                return;
            }
            
            if($this->account_type === 'PRO' && $this->num_seats !== 1){
                throw new \InvalidArgumentException($this->account_type.' accounts must have exactly 1 seat');
            }elseif(in_array($this->account_type, array('TEAM', 'TEAM_TRIAL')) && $this->num_seats < 2){
                throw new \InvalidArgumentException($this->account_type.' accounts must have at least 2 seats');
            }elseif(in_array($this->account_type, array('ENTERPRISE', 'ENTERPRISE_TRIAL', 'GLOBAL', 'GLOBAL_TRIAL')) && $this->num_seats < 10){
                throw new \InvalidArgumentException($this->account_type.' accounts must have at least 10 seats');
            }
            
        }
        
        function asArray(){
            
            $properties = array(
                                    'companyName' => $this->company_name,
                                    'accountType' => $this->account_type,
                                    'numSeats' => $this->num_seats
                               );
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('accountCreationInfo' => $properties);
        }
        
    }