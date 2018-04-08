<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/8
 * Time: 11:27
 */

namespace classes;


class Config
{
    public static function get()
    {
        return include_once 'config/config.php';
    }
}