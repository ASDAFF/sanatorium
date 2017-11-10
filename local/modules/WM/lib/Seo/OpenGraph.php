<?php

namespace WM\Seo;

/**
 * Class OpenGraph
 * @package WM\Seo
 */
class OpenGraph extends \WM\Base\Markup
{
    /**
     * Set prefix for meta tags
     *
     * @return void
     *
     * @access public
     */
    public function setPrefix()
    {
        static::$PREFIX = 'og:';
    }
}