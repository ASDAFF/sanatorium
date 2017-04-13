<?php

namespace WM;

/**
 * Class OpenGraph
 * @package WM
 */
class OpenGraph extends Markup
{
    public function setPrefix()
    {
        static::$PREFIX = 'og:';
    }
}