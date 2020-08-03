<?php

namespace blog\userClasses;

//TO DO:
//    - add salt
//    - unique password for every user
//    - think about password_hash and password_verify

class Hash {

    public static function make($string) {
        return hash('sha512', $string);
    }

    public static function salt($length) {

    }

    public static function unique() {
        return self::make(uniqid());
    }
}