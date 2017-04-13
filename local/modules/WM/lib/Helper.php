<?php

namespace WM;

/**
 * Class Helper
 * @package WM
 */
class Helper
{
    /**
     * @param $n
     * @param array $items
     * @return bool|mixed
     */
    public static function pluralize($n, array $items)
    {
        if(!isset($items[0], $items[1], $items[2]))
            return false;
        if($n % 10 === 1 && $n % 100 !== 11)
            return $items[0];
        if($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 > 20))
            return $items[1];
        return $items[2];
    }
}