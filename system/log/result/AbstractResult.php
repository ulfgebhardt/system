<?php

namespace SYSTEM\LOG;

class AbstractResult {		
    //Returns the result as a string
    public static function toString($json_array, $status , $start_time){
        throw new RuntimeException("Unimplemented");}
    //Return Exception as string
    public static function error(\Exception $e){
        throw new RuntimeException("Unimplemented");}
    //Returns OK status
    public static function ok(){
        throw new RuntimeException("Unimplemented");}
}