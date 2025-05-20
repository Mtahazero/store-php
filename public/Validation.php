<?php

class Validation{

    static function clean($str){
        $str = trim($str);
        $str = stripcslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
    static function validateFullname($str){
        $pattern = "/^[a-zA-Z-' ]{3,}$/";
        return preg_match($pattern,$str);
    }
    static function validateEmail($str){
        return filter_var($str,FILTER_VALIDATE_EMAIL);
    }
    public static function validatePassword($str){
        $pattern = "/^[A-Za-z\d!@#$%^&*]{6,}$/";
        return preg_match($pattern, $str);
    }
    public static function match($str1,$str2){
        return $str1===$str2;
    }
    
}


?>