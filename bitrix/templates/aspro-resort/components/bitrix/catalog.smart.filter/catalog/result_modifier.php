<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!$arParams["PROP_1"] && !$arParams["PROP_2"] && !$arParams["PROP_3"])
	$arShowProp=array("SIZE", "FILTER_PRICE", "TYPE_BUILDINGS");
else{
	for($i=1;$i<=3;$i++){
		if($arParams["PROP_".$i]){
			$arShowProp[]=$arParams["PROP_".$i];
		}
	}
}

		

foreach($arResult["ITEMS"] as $key => $arItem)
{
	if(!$arItem["VALUES"] || ($arItem["VALUES"] && ($arItem["DISPLAY_TYPE"]=="A" && ($arItem["VALUES"]["MAX"]["VALUE"]-$arItem["VALUES"]["MIN"]["VALUE"])<= 0)) || ($arItem["CODE"]=="TYPE_BUILDINGS" && count($arItem["VALUES"])<=1)/* || (in_array($arItem["CODE"],$arShowProp) && $arParams["FILTER_VIEW_MODE"]=="HORIZONTAL")*/){
		/*if(in_array($arItem["CODE"],$arShowProp) && $arParams["FILTER_VIEW_MODE"]=="HORIZONTAL"){
			print_r($arItem);
			$arResult["ITEMS"]["TOP_BLOCK"][]=$arItem;
		}*/
		unset($arResult["ITEMS"][$key]);
	}
	
}
if($arParams["FILTER_VIEW_MODE"]=="HORIZONTAL"){
	foreach($arResult["ITEMS"] as $key => $arItem){
		if(in_array($arItem["CODE"],$arShowProp) && $arItem["CODE"]!="TYPE_BUILDINGS"){
			$arResult["ITEMS"]["TOP_BLOCK"][]=$arItem;
			unset($arResult["ITEMS"][$key]);
		}
		if($arItem["CODE"]=="TYPE_BUILDINGS" && count($arItem["VALUES"])>1){
			$arResult["ITEMS"]["TOP_BLOCK"][]=$arItem;
		}
	}
}