<?php
class TextParser{

    private static function parseSqlQuote($str){

        return str_replace("'", "\'", $str);
    }

    public static function ParseEntityQuotes($obj){
        $vars=get_object_vars($obj);
        foreach($vars as $key=>$val){
            //if(is_string($val)) $obj->$key=htmlentities($val, ENT_QUOTES);
            if(is_string($val)) $obj->$key=self::parseSqlQuote($val);
        }
    }

    public static function ParseQuotes($str){
        return str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'), utf8_encode($str)); 
        //$bad = array_merge( array_map('chr', range(0,31)), array("<", ">", ":", '"', "/", "\\", "|", "?", "*", "'", "\""));
        //return str_replace($bad, "", iconv('UTF-8', 'ASCII//TRANSLIT', $str));
    }

    public static function FormatMoney($number, $sign=NULL){
        global $WEBSITE;

        $sign=!isset($sign)? (isset($WEBSITE['MONEDA'])? $WEBSITE['MONEDA']: 'S/.'): $sign;

        return ($number<0?'-':'').$sign.'&nbsp;'.number_format(abs($number), 2, '.', ',');
    }

    public static function FormatNumber($number, $nroDec=0){
        return number_format($number, $nroDec, '.', ',');
    }

    public static function nl2BR($str){
        $str=nl2br($str);
        return str_replace(array("\r\n", "\n", "\r"), '', $str);
    }

    public static function UpperCase($str){
        return mb_strtoupper($str);
        //return strtoupper(str_replace(array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'), utf8_encode($str)));
    }

    public static function GetLetters(){
        return array( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
    }

    public static function parseFileName($fileName){
        $fileName=self::ParseQuotes($fileName);
        $fileName=str_replace(' ', '_', $fileName);
        $fileName=strtolower($fileName);
        return $fileName;
    }

}
?>