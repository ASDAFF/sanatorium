<?php

namespace WM\Common;

/**
 * Class User
 * @package WM\Common
 */
class User extends \Wm\Base\GlobalVars
{
    /**
     * set global variable name
     *
     * @access public
     */
    public static function setVarName()
    {
        static::$varName = 'USER';
    }

    /**
     * Returns instance of \CUser
     *
     * @return \CUser
     *
     * @access public
     */
    public static function get()
    {
        return parent::get();
    }

    /**
     * @return bool
     *
     * @access public
     */
    public static function isGuest()
    {
        return !static::isAuthed();
    }

    /**
     * @return bool
     *
     * @access public
     */
    public static function isAuthed()
    {
        return static::get()->IsAuthorized();
    }

    /**
     * @return bool
     *
     * @access public
     */
    public static function isAdmin()
    {
        return static::get()->IsAuthorized() && static::get()->IsAdmin();
    }
}