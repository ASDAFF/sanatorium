<?php

namespace WM;

/**
 * Class App
 * @package WM
 */
class App extends GlobalVars
{
    /**
     * set global variable name
     */
    public static function setVarName()
    {
        static::$varName = 'APPLICATION';
    }

    /**
     * @return \Bitrix\Main\Application
     */
    public static function get()
    {
        return parent::get();
    }
}