<?php
class OWASP{

    public static function RequestString($field, $default=''){
        if(!isset($_REQUEST[$field])) return $default;
        return isset($_POST[$field]) ? filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING): filter_input(INPUT_GET, $field, FILTER_SANITIZE_STRING);
    }
    public static function RequestInt($field, $default=0){
        if(!isset($_REQUEST[$field])) return $default;
        return isset($_POST[$field]) ? filter_input(INPUT_POST, $field, FILTER_SANITIZE_NUMBER_INT): filter_input(INPUT_GET, $field, FILTER_SANITIZE_NUMBER_INT);
    }
    public static function RequestBoolean($field, $default=false){
        if(!isset($_REQUEST[$field])) return $default;
        return isset($_POST[$field]) ? filter_input(INPUT_POST, $field, FILTER_VALIDATE_BOOLEAN): filter_input(INPUT_GET, $field, FILTER_VALIDATE_BOOLEAN);
    }
    public static function RequestArray($field, $default=array()){
        if(!isset($_REQUEST[$field])) return $default;
        return isset($_POST[$field]) ? filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY): filter_input(INPUT_GET, $field, FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    }
    public static function RequestHTML($field, $default=''){
        if(!isset($_REQUEST[$field])) return $default;
        $rules=array('#<script(.*?)>(.*?)</script>#is', '#<style(.*?)>(.*?)</style>#is');
        return isset($_REQUEST[$field])? preg_replace($rules, '', $_REQUEST[$field]): NULL;
    }
    public static function ValidateString($value){
        return filter_var($value, FILTER_SANITIZE_STRING);
    }
    public static function ValidateInt($value){
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }
    public static function CleanText($str){
        return strip_tags($str);
    }

}
?>