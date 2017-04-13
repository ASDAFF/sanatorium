<?php

namespace WM;


/**
 * Class Config
 * @package WM
 */
class Config
{
    /**
     * @param $componentName
     * @param array $params
     * @return array of params
     */
    public static function getComponentParams($componentName, array $params = array())
    {
        $prefix = '\\WM\\';

        if(false === strpos($componentName, $prefix))
            $componentName = $prefix . $componentName;

        if(class_exists($componentName) && is_subclass_of($componentName, $prefix . 'Component'))
            return $componentName::getParams($params);

        return $params;
    }
}