<?php

/**
 * [<description>].
 *
 * @category [<category>]
 *
 * @author    Ishtiyaq Husain <ishtiyaq.husain@gmail.com>
 * @copyright 2017 Ishtiyaq Husain
 * @license   GPL http://ishtiyaq.com/license
 *
 * @version Release: 1.0.0
 *
 * @link  http://ishtiyaq.com
 * @since File available since Release 1.0.0
 */
class Cookie
{
    public static function exists($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }
    
    public static function get($name)
    {
        return $_COOKIE[$name];
    }
    
    public static function put($name, $value, $expiry)
    {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }

        return false;
    }
    
    public static function delete($name)
    {
        self::put($name, '', time() - 1);
    }
}
