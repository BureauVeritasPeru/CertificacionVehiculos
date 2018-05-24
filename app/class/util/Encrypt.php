<?php

class Encrypt{
    
    public static function encrypt($str, $key){
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($str), MCRYPT_MODE_CBC, md5(md5($key))), "\0");;
    }

    public static function decrypt($str, $key)
    {   
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $str, MCRYPT_MODE_CBC, md5(md5($key))));
    }
}

?>
