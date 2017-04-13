<?php

namespace WM;


/**
 * Class GTM
 * @package WM
 */
class GTMFormSubmit extends StaticInstance
{
    /**
     * @var event name
     */
    protected $event = null;
    /**
     * @var element classes
     */
    protected $elementClasses = null;
    /**
     * @var element classes
     */
    protected $elementId = null;
    /**
     * @var array of elements
     */
    protected $elements = array();

    /**
     * @param string $event event name
     * @return $this
     */
    public function setEvent($event = 'gtm.formSubmit')
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @param $classes element classes
     * @return $this
     */
    public function setElementClasses($classes)
    {
        $this->elementClasses = $classes;
        return $this;
    }

    /**
     * @param $classes element classes
     * @return $this
     */
    public function setElementId($id)
    {
        $this->elementId = $id;
        return $this;
    }

    /**
     * @param $index element index
     * @param $value element value
     * @return $this
     */
    public function setElement($index, $value)
    {
        $this->elements[$index] = $value;
        return $this;
    }

    /**
     * @param array $data array of element values
     * @return $this
     */
    public function setElements(array $data = array())
    {
        foreach($data as $index => $value)
            $this->setElement($index, $value);
        return $this;
    }
    /**
     * @return array of gtm.formSubmit
     */
    public function getResult($inJson = false)
    {
        $result = array(
            'event' => $this->event,
        );

        if(!empty($this->elementClasses))
            $result['gtm.elementClasses'] = $this->elementClasses;
        if(!empty($this->elementId))
            $result['formId'] = $this->elementId;

        foreach($this->elements as $index => $value)
            $result['gtm.element.' . $index . '.value'] = $value;
        return $inJson ? $this->getJson($result) : $result;
    }
    /**
     * @param bool $return
     * @return string
     */
    public function jsonResult($return = false)
    {
        $ret  = '<script type="text/javascript">window.dataLayer = window.dataLayer || [];' . PHP_EOL;
        $ret .= 'dataLayer.push(' . $this->getJson($this->getResult()) . ');' . PHP_EOL;
        $ret .= '</script>' . PHP_EOL;
        if($return)
            return $ret;
        echo $ret;
    }

    /**
     * @param array $data
     * @return string
     */
    public function getJson(array $data = array())
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}