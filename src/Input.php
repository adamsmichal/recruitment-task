<?php

namespace blog;

class Input
{
    //check if the input exist
    public static function exist($type = 'post')
    {
        switch ($type) {
            case 'post':
                return !empty($_POST);
                break;
            case 'get':
                return !empty($_GET);
                break;
            default:
                return false;
                break;
        }
    }

    //getting value from input
    public static function get($item)
    {
        if(isset($_POST[$item])) {
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        }

        return '';
    }
}