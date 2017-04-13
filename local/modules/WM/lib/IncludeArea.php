<?php

namespace WM;

class IncludeArea extends Component
{
    protected static $componentName = 'bitrix:main.include';
    protected static $params = array(
        'AREA_FILE_SHOW' => 'file',
        'PATH' => 'include/file.php',
    );
}
