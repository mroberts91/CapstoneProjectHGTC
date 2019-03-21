<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 3/20/2019
 * Time: 9:28 PM
 */

namespace Core;

 class PasswordUtils
{
     /**
      * @param string $string A raw string password
      * @return string The result of hashing the raw string.
      */
    public static function generateHash($string){
        return password_hash($string, 1);
    }

     /**
      * @param $string - A raw string password
      * @param $hash - A hashed password
      * @return bool - Returns a boolean whether the string password matches the hashed password.
      */
    public static function verifyPassword($string, $hash){
        return password_verify($string, $hash);
    }
}