<?php

    namespace EchoSign\Info;

    class MergeFieldInfo implements \Countable, \IteratorAggregate
    {
        
        protected $merge_fields;
        
        function __construct(array $merge_fields = null){
            if(!is_null($merge_fields)) $this->setMergeFields($merge_fields);
        }
        
        function setMergeFields(array $merge_fields){
            foreach($merge_fields as $k => $v){
                $this->addField($k, $v);
            }
            
            return $this;
        }
        
        function getMergeFields(){
            return $this->merge_fields;
        }
        
        function addField($property, $value){
            $this->merge_fields[] = array('fieldName' => $property, 'defaultValue' => $value);
        }
        
        function count(){
            return count($this->merge_fields);
        }
        
        function getIterator(){
            return new \ArrayIterator($this->merge_fields);
        }
        
        function asArray(){
            return $this->merge_fields;
        }
    }
