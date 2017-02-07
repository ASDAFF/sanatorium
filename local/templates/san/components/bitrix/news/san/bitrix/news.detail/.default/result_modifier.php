<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Loader::includeModule('iblock');

//default empty array
$arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['PROPERTIES_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['ALL_PROPERTIES_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PRICES']['FIELDS_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE_STR'] = array();

if(!empty($arResult['PROPERTIES']['PRICES']['VALUE']))
{
    $res = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID' => $arResult['PROPERTIES']['PRICES']['LINK_IBLOCK_ID'], 'ID' => array_map('intval', $arResult['PROPERTIES']['PRICES']['VALUE']), 'ACTIVE' => 'Y'),
        false,
        false,
        array('ID', 'IBLOCK_ID', '*', 'PROPERTY_*')
    );
    
    $dir = SITE_TEMPLATE_PATH . '/images/icon/';
    
    while ($row = $res->GetNextElement())
    {
        $props = $values = array();
        foreach ($row->GetProperties() as $prop)
        {
            if (empty($prop['VALUE']))
                continue;
            //check icon for prop
            $path = $dir . strtoupper($prop['CODE']) . '.png';
            $prop['ICON'] = is_file($_SERVER['DOCUMENT_ROOT'] . $path) ? $path : false;
            $props[] = $prop;
            if (is_scalar($prop['VALUE']))
                $values[] = strtolower($prop['NAME']);
        }
        $arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'][] = $props;
        $arResult['DISPLAY_PROPERTIES']['PRICES']['ALL_PROPERTIES_VALUE'][] = $row->GetProperties();
        $arResult['DISPLAY_PROPERTIES']['PRICES']['FIELDS_VALUE'][] = $row->GetFields();
        $arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE_STR'][] = $values;
    }
}

if(!empty($arResult['PROPERTIES']['PROGRAMMS']['VALUE']))
{
    $res = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID' => $arResult['PROPERTIES']['PROGRAMMS']['LINK_IBLOCK_ID'], 'ID' => array_map('intval', $arResult['PROPERTIES']['PROGRAMMS']['VALUE']), 'ACTIVE' => 'Y'),
        false,
        false,
        array('ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_PAGE_URL')
    );
    
    while ($row = $res->GetNext())
        $arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['PROPERTIES_VALUE'][] = $row;
}