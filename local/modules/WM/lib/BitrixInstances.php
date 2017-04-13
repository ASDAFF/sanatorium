<?php

namespace WM;


/**
 * Class BitrixInstances
 * @package WM
 */
abstract class BitrixInstances
{
    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * @return mixed
     */
    abstract static function setInstance();

    /**
     * @return Object
     */
    public static function get()
    {
        static::setInstance();

        return static::$instance;
    }
}