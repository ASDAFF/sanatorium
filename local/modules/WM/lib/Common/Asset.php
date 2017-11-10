<?php

namespace WM\Common;

/**
 * Class Asset
 * @package WM\Common
 */
class Asset extends \Wm\Base\BitrixInstances
{
    /**
     * Set instance of current class
     *
     * @override
     *
     * @return void
     *
     * @access public
     */
    public static function setInstance()
    {
        static::$instance = \Bitrix\Main\Page\Asset::getInstance();
    }

    /**
     * Returns instance of \Bitrix\Main\Page\Asset
     *
     * @return \Bitrix\Main\Page\Asset
     *
     * @access public
     */
    public static function get()
    {
        return parent::get();
    }
}