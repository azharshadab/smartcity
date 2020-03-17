<?php

/**
 * [<description>].
 *
 * @category [<category>]
 * @package [<package>] 
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
class Config
{
    public static function get($path = null)
    {
        if ($path) {
            $config = $GLOBALS['config'];

            $path = explode('/', $path);

            foreach ($path as $bit) {
                if (isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}
