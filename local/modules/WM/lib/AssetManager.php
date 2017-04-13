<?php

namespace WM;


/**
 * Class AssetManager
 * @package WM
 */
class AssetManager extends StaticInstance
{
    /**
     * @var \Bitrix\Main\Page\Asset|null
     */
    private $assets = null;

    /**
     * AssetManager constructor.
     */
    public function __construct()
    {
        $this->assets = Asset::get();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function addJsArray(array $data = array())
    {
        foreach($data as $file)
            $this->assets->addJs($file);
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function addCssArray(array $data = array())
    {
        foreach($data as $file)
            $this->assets->addCss($file);
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function init(array $data = array())
    {
        \CJSCore::init($data);
        return $this;
    }

}