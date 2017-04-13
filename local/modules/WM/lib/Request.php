<?php

namespace WM;


/**
 * Class Request
 * @package WM
 */
class Request extends BitrixInstances
{
    /**
     *
     */
    public static function setInstance()
    {
        static::$instance = Context::get()->getRequest();
    }

    /**
     * @return \Bitrix\Main\HttpRequest
     */
    public static function get()
    {
        return parent::get();
    }
}