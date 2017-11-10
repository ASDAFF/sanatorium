<?php

namespace WM\Common;

/**
 * Class App
 * @package WM\Common
 */
class App extends \Wm\Base\GlobalVars
{
    /**
     * set global variable name
     *
     * @return void
     *
     * @access public
     */
    public static function setVarName()
    {
        static::$varName = 'APPLICATION';
    }

    /**
     * Returns instance of \Bitrix\Main\Application
     *
     * @return \Bitrix\Main\Application
     *
     * @access public
     */
    public static function get()
    {
        return parent::get();
    }
}