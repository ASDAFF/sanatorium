<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	
	$arResult['GALLERY'] = $arImage = array();
	
	if ($arResult && isset($arResult['DISPLAY_PROPERTIES']['PHOTOS']) && is_array($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'])) {
		foreach ($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'] as $value) {
			$arImage = CFile::GetFileArray($value);
			$arResult['GALLERY']['BIG'][] = CFile::ResizeImageGet($value, array( 'width' => 1500, 'height' => 1500 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
			$arResult['GALLERY']['NORMAL'][] = CFile::ResizeImageGet($value, array( 'width' => 276, 'height' => 207 ), BX_RESIZE_IMAGE_EXACT, true);
			$arResult['GALLERY']['DESCRIPTION'][] = $arImage['DESCRIPTION'];
		}
	}
?>
