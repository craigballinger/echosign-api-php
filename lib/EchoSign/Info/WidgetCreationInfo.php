<?php

    namespace EchoSign\Info;
    
    class WidgetCreationInfo extends AbstractCreationInfo
    {
        
        protected $widget_completion_info;
        protected $widget_auth_failure_info;
        
        function setWidgetCompletionInfo($url, $deframe = false, $delay = 0){
            
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException("The widget completion url is invalid.");
            }
            
            $this->widget_completion_info = array(
                                                    'url' => $url,
                                                    'deframe' => $deframe,
                                                    'delay' => $delay
                                                 );
            return $this;
        }
        
        function getWidgetCompletionInfo(){
            return $this->widget_completion_info;
        }
        
        function setWidgetAuthFailureInfo($url, $deframe = false, $delay = 0){
            
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new \InvalidArgumentException("The widget auth failure url is invalid.");
            }
            
            $this->widget_auth_failure_info = array(
                                                    'url' => $url,
                                                    'deframe' => $deframe,
                                                    'delay' => $delay
                                                 );
            return $this;
        }
        
        function getWidgetAuthFailureInfo(){
            return $this->widget_auth_failure_info;
        }
        
        function asArray(){
            
            $inherited = parent::asArray();
            
            $properties = array(                           
                            'widgetCompletionInfo' => $this->widget_completion_info,
                            'widgetAuthFailureInfo' => $this->widget_auth_failure_info
                        );
            
            $properties = array_merge($inherited, $properties);
            
            foreach($properties as $k => $v){
                if($v === null || $v === ''){
                    unset($properties[$k]);
                }
            }
            
            return array('widgetInfo' => $properties);
            
        }
        
    }