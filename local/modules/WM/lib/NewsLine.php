<?php

namespace WM;

class NewsLine extends Component
{
    protected static $componentName = 'bitrix:news.line';
    protected static $params = array(
        'IBLOCK_TYPE' => 'news',
        'IBLOCKS' => Array('3'),
        'NEWS_COUNT' => '20',
        'FIELD_CODE' => Array('ID', 'CODE'),
        'SORT_BY1' => 'ACTIVE_FROM',
        'SORT_ORDER1' => 'DESC',
        'SORT_BY2' => 'SORT',
        'SORT_ORDER2' => 'ASC',
        'DETAIL_URL' => 'news_detail.php?ID=#ELEMENT_ID#',
        'ACTIVE_DATE_FORMAT' => 'd.m.Y',
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => '300',
        'CACHE_GROUPS' => 'N'
    );
}