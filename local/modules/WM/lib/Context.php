<?php

namespace WM;


/**
 * Class Context
 * @package WM
 */
class Context extends BitrixInstances
{
    /**
     *
     */
    public static function setInstance()
    {
        static::$instance = \Bitrix\Main\Application::getInstance()->getContext();
    }

    /**
     * @return \Bitrix\Main\Context
     */
    public static function get()
    {
        return parent::get();
    }
}