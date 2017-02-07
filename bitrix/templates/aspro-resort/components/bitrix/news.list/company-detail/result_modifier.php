<?
foreach($arResult['ITEMS'] as $key=>$arItem){	
	if(!empty($arItem['PROPERTIES']['MORE_PHOTOS']['VALUE'])){
		foreach($arItem['PROPERTIES']['MORE_PHOTOS']['VALUE'] as $img){
			$arResult['ITEMS'][$key]['GALLERY'][] = array(
				'DETAIL' => ($arPhoto = CFile::GetFileArray($img)),
				'PREVIEW' => CFile::ResizeImageGet($img, array('width' => 800, 'height' => 500), BX_RESIZE_PROPORTIONAL, true),
				'THUMB' => CFile::ResizeImageGet($img , array('width' => 75, 'height' => 75), BX_RESIZE_IMAGE_EXACT, true),
				'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arItem['NAME'])),
				'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arItem['NAME'])),
			);
		}
	}
}
?>