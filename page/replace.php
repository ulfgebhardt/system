<?php
namespace SYSTEM\PAGE;
class replace {
    public static function replace($text, $vars){
        if(!$vars){
            $vars = array();}
        $search = array();
        $replace = array();

        foreach($vars as $key=>$value){
            if(!is_array($value)){
                $search[] = '/\${'.$key.'}/';
                $replace[] = $value;}
        }
        return @preg_replace($search, $replace, $text);
    }
    public static function replaceFile($path, $vars){
        $buffer = file_get_contents($path);            
        return self::replace($buffer, $vars);}

    //removes all Variable Handles
    public static function clean($text){
        return preg_replace('/\${.*?}/', '', $text);}
}