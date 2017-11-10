<?php

namespace WM\Common;


/**
 * Class Config
 * @package WM\Common
 */
class Config
{
    /**
     * Returns default or merged parameters of given component
     *
     * @param $componentName
     * @param array $params
     * @return array of params
     *
     * @access public
     */
    public static function getComponentParams($componentName, array $params = array())
    {
        $prefix = '\\WM\\Components\\';

        if(false === strpos($componentName, $prefix))
            $componentName = $prefix . $componentName;

        if(class_exists($componentName) && method_exists($componentName, 'getParams'))
            return $componentName::getParams($params);

        return $params;
    }
}