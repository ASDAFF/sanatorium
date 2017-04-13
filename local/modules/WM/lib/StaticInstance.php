<?php

namespace WM;


abstract class StaticInstance
{
    /**
     * @var static instance of object
     */
    protected static $instance = null;

    /**
     * @return $this
     */
    public static function get()
    {
        if(static::$instance === null)
            static::$instance = new static();
        return static::$instance;
    }
}