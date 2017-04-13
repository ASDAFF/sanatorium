<?php

namespace WM;

class Breadcrumbs extends Component
{
    protected static $componentName = 'bitrix:breadcrumb';
    protected static $params = array(
        'START_FROM' => '0',
        'PATH' => '',
        'SITE_ID' => SITE_ID,
    );
}