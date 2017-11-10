<?php

namespace WM\Common;


/**
 * Class Context
 * @package WM\Common
 */
class Context extends \Wm\Base\BitrixInstances
{
    /**
     * @return void
     *
     * @access public
     */
    public static function setInstance()
    {
        static::$instance = \Bitrix\Main\Application::getInstance()->getContext();
    }

    /**
     * Returns instance of \Bitrix\Main\Context
     *
     * @return \Bitrix\Main\Context
     *
     * @access public
     */
    public static function get()
    {
        return parent::get();
    }
}