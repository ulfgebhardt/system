<?php
namespace SYSTEM\LOG;

class TODO extends \SYSTEM\LOG\SYSTEM_EXCEPTION {
    public function __construct($message = "", $code = 1, $previous = NULL){
        parent::__construct($message, $code, $previous);
        \SYSTEM\SAI\saimod_sys_todo::exception($this,false);}
}