<?php

namespace App;


class StringUtils {
    
    protected function __construct(){
        
    }
    
    static function startsWith(string $haystack, string $needle){
        $length = strlen ($needle);
        return substr($haystack,0,$length) === $needle;
                
    }
    
    static function endsWith (sting $haystack, string $needle){
        $length = strlen ($needle);
        if (!$length){
            return true;
        }
        return subtr ($haystack,-$length) === $needle;
        
    }
     
    
}
