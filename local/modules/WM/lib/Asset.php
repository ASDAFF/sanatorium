<?php

namespace WM;


/**
 * Class Asset
 * @package WM
 */
class Asset extends BitrixInstances
{
    /**
     *
     */
    public static function setInstance()
    {
        static::$instance = \Bitrix\Main\Page\Asset::getInstance();
    }

    /**
     * @return \Bitrix\Main\Page\Asset
     */
    public static function get()
    {
        return parent::get();
    }
}