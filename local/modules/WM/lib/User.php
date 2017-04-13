<?php

namespace WM;

/**
 * Class User
 * @package WM
 */
class User extends GlobalVars
{
    /**
     * set global variable name
     */
    public static function setVarName()
    {
        static::$varName = 'USER';
    }

    /**
     * @return \CUser
     */
    public static function get()
    {
        return parent::get();
    }

    /**
     * @return bool
     */
    public static function isGuest()
    {
        return !static::isAuthed();
    }

    /**
     * @return bool
     */
    public static function isAuthed()
    {
        return static::get()->IsAuthorized();
    }

    /**
     * @return bool
     */
    public static function isAdmin()
    {
        return static::get()->IsAuthorized() && static::get()->IsAdmin();
    }
}