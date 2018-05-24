<?php

class ConfigParam{
    private static  $params = null;  

    public static function getparam($key){
        if(is_null(self::$params)){
             self::$params = array();
             //initialize param array here from file, db, or just hardcoded values...
        }
        return isset(self::$params[$key])?self::$params[$key]:null;
     }

    public static function setparam($key, $value){
        if(is_null(self::$params)){
             self::$params = array();
             //initialize array here
        }
        self::$params[$key] = $value;
     }
 }

?>