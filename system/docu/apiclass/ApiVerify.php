<?php

class ApiVerify extends \SYSTEM\verifyclass {
    public static function INPUTSOURCE      ($param){ return ($param == 'smartphone') || ($param == 'waspmote');}
    public static function SENSORTYPE       ($param){ return self::UINT($param) && $param > 0 & $param < 10;}
    public static function GOOGLEMAPCOORD   ($param){ return self::UINT($param);}
    public static function GOOGLEMAPZOOM    ($param){ return self::UINT($param) && $param < 20;}
    public static function WIERDTIMESTAMP   ($param){ return (strtotime($param)==false) ? false : true;}
    public static function SENSORPROVIDER   ($param){ return true;} //TODO remove this param
    public static function LATLONCOORD      ($param){ return self::FLOAT($param) && floatval($param) >= 0 && floatval($param) <= 180;}
    public static function USERNAME         ($param){ return self::STRING($param) && strlen($param) >=3 && strlen($param) <= 30;}
    public static function PASSWORD         ($param){ return self::STRING($param) && strlen($param) >=5 && strlen($param) <= 16;}
    public static function HASH             ($param){ return preg_match("^[0-9A-Fa-f]+$^", $param) != 0 && strlen($param) >=5;}
    public static function PASSHASH         ($param){ return self::PASSWORD($param) || self::HASH($param);}
    public static function EMAIL            ($param){ return filter_var($param, FILTER_VALIDATE_EMAIL);}
    public static function ARRAYINT         ($param){ return self::ARY($param) || self::INT($param);}
}