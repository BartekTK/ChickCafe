<?php

/**
    The MIT License (MIT)

    Copyright (c) 2015 Bartlomiej Kliszczyk

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 */

/**
 * @author Bartlomiej Kliszczyk
 * @date 12-02-2015
 * @version 1.0
 * @license The MIT License (MIT)
 */


interface Auth_Interface{
    public function isAuth();
    public function auth($aUserData);
}

class Auth_Core implements Auth_Interface{

    public static function init()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new self;
        }

        return $instance;
    }

    public function isAuth($redirect = false){
        if(isset($_SESSION['ak']) && $_SESSION['ak'] == sha1(md5($_SESSION['user']))){
            return true;
        }else{
            //var_dump(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
            $req = array_filter(explode('/', $_SERVER['REQUEST_URI']));
            if(!empty($req)){
                if($redirect) {
                    header('Location: /');
                    exit();
                }
            }

            return false;
        }
    }

    /**
     * @todo Change password encryption: user methods below
     * @param $aUserData
     */
    public function auth($aUserData){
        $_SESSION['ak'] = sha1(md5($aUserData));
        $_SESSION['user'] = $aUserData;

    }



//    /**
//     * Generates a secure, pseudo-random password with a safe fallback.
//     */
//    function pseudo_rand($length) {
//        if (function_exists('openssl_random_pseudo_bytes')) {
//            $is_strong = false;
//            $rand = openssl_random_pseudo_bytes($length, $is_strong);
//            if ($is_strong === true) return $rand;
//        }
//        $rand = '';
//        $sha = '';
//        for ($i = 0; $i < $length; $i++) {
//            $sha = hash('sha256', $sha . mt_rand());
//            $chr = mt_rand(0, 62);
//            $rand .= chr(hexdec($sha[$chr] . $sha[$chr + 1]));
//        }
//        return $rand;
//    }
//
//    /**
//     * Creates a very secure hash. Uses blowfish by default with a fallback on SHA512.
//     */
//    function create_hash($string, &$salt = '', $stretch_cost = 10) {
//        $salt = pseudo_rand(128);
//        $salt = substr(str_replace('+', '.', base64_encode($salt)), 0, 22);
//        if (function_exists('hash') && in_array($hash_method, hash_algos())) {
//		return crypt($string, '$2a$' . $stretch_cost . '$' . $salt);
//    }
//        return _create_hash($string, $salt);
//    }
//
//    /**
//     * Fall-back SHA512 hashing algorithm with stretching.
//     */
//    function _create_hash($password, $salt) {
//        $hash = '';
//        for ($i = 0; $i < 20000; $i++) {
//            $hash = hash('sha512', $hash . $salt . $password);
//        }
//        return $hash;
//    }*/



} 