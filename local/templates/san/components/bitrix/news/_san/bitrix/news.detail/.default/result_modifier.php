<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Loader::includeModule('iblock');

//current sanatorium url without tab
$arResult['TAB_URL'] = preg_replace('~#ELEMENT_SECTION#/~ui', '', $arResult['DETAIL_PAGE_URL']);

//possible tabs
$tabs = array('about', 'rooms', 'profiles', 'programms', 'infrastructure', 'food', 'child', 'video', 'actions');
if(!empty($_GET['ELEMENT_SECTION']) && in_array($_GET['ELEMENT_SECTION'], $tabs))
    $arResult['ACTIVE_TAB'] = $_GET['ELEMENT_SECTION'];
else
    LocalRedirect($arResult['TAB_URL'] . $tabs[0] . '/', true, '301 Moved permanently');

//check active tab
if(!function_exists('activeTabClass'))
{
    function activeTabClass($tab, $activeTab, $addClass = false)
    {
        return isActiveTab($tab, $activeTab) ? ($addClass ? ' class="active"' : ' active') : '';
    }
    function isActiveTab($tab, $activeTab) {
        return $tab == $activeTab;
    }
}

//programms
$arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['PROPERTIES_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['ALL_PROPERTIES_VALUE'] = array();
//rooms
$arResult['DISPLAY_PROPERTIES']['PRICES']['FIELDS_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PRICES']['ALL_PROPERTIES_VALUE'] = array();
$arResult['DISPLAY_PROPERTIES']['PRICES']['ICONS'] = array();
//infrastructure
$arResult['DISPLAY_PROPERTIES']['INFRASTRUCTURE']['ICONS'] = array();
//gallery photos
$arResult['PROPERTIES']['PHOTOS']['VALUE_PATH'] = array();

//set infrastructure icons
if(!empty($arResult['PROPERTIES']['INFRASTRUCTURE']['VALUE_XML_ID']))
{
    $dir = SITE_TEMPLATE_PATH . '/images/icon/';
    foreach($arResult['PROPERTIES']['INFRASTRUCTURE']['VALUE_XML_ID'] as $k => $xmlId)
    {
        $path = $dir . strtoupper($xmlId) . '.png';
        $value = is_file($_SERVER['DOCUMENT_ROOT'] . $path) ? $path : false;
        $key = strtolower($arResult['PROPERTIES']['INFRASTRUCTURE']['VALUE'][$k]);
        $arResult['DISPLAY_PROPERTIES']['INFRASTRUCTURE']['ICONS'][$key] = $value;
    }
}

//set photo path instead id
if(!empty($arResult['PROPERTIES']['PHOTOS']['VALUE']))
{
    $arResult['PROPERTIES']['PHOTOS']['VALUE_PATH'] = array_map(function ($v) {
        return CFile::GetPath($v);
    }, $arResult['PROPERTIES']['PHOTOS']['VALUE']);
}


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
    $comfortProps = array(
        'TOILET', 'SHOWER', 'TOILETRIES', 'TOWELS', 'SLIPPERS', 'ROBE', 'TV', 'SATELLITE', 'REFRIGERATOR', 'ELECTRIC_KETTLE', 'BATH',
        'FEN', 'AIR_CONDITION', 'SAFE', 'PHONE', 'CUPBOARD', 'WARDROBE', 'WIFI', 'WINDOW_VIEW', 'ROOM_BREAKFAST', 'WAKE_UP_SERVICE',
    );
    while ($row = $res->GetNextElement())
    {
        $props = $icons = array();
        foreach ($row->GetProperties() as $prop)
        {
            if (empty($prop['VALUE']))
                continue;
            //check icon for prop
            $path = $dir . mb_strtoupper($prop['CODE'], 'UTF-8') . '.png';
            $prop['ICON'] = is_file($_SERVER['DOCUMENT_ROOT'] . $path) ? $path : false;

            //set photo path instead id
            if($prop['CODE'] == 'MORE_PHOTO')
            {
                $prop['VALUE_PATH'] = array_map(function ($v) {
                    return CFile::GetPath($v);
                }, $prop['VALUE']);
            }
            //add prop to array
            $props[$prop['CODE']] = $prop;

            if (in_array($prop['CODE'], $comfortProps))
                $icons[mb_strtolower($prop['NAME'], 'UTF-8')] = $prop['ICON'];
        }
        $arResult['DISPLAY_PROPERTIES']['PRICES']['PROPERTIES_VALUE'][] = $props;
        $arResult['DISPLAY_PROPERTIES']['PRICES']['ALL_PROPERTIES_VALUE'][] = $row->GetProperties();
        $arResult['DISPLAY_PROPERTIES']['PRICES']['FIELDS_VALUE'][] = $row->GetFields();
        $arResult['DISPLAY_PROPERTIES']['PRICES']['ICONS'][] = $icons;
    }
}

//programms
if(!empty($arResult['PROPERTIES']['PROGRAMMS']['VALUE']))
{
    $res = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID' => $arResult['PROPERTIES']['PROGRAMMS']['LINK_IBLOCK_ID'], 'ID' => array_map('intval', $arResult['PROPERTIES']['PROGRAMMS']['VALUE']), 'ACTIVE' => 'Y'),
        false,
        false,
        array('ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_TEXT', 'DETAIL_PAGE_URL')
    );
    
    while ($row = $res->GetNext())
        $arResult['DISPLAY_PROPERTIES']['PROGRAMMS']['PROPERTIES_VALUE'][] = $row;
}