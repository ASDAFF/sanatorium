<?if($arResult["PROPERTIES"]["MAPS"]["VALUE"]){
	$arCoord = explode(",", $arResult["PROPERTIES"]["MAPS"]["VALUE"]);
	?>
	<?$arPlacemarks[] = array(
		"LON" => $arCoord[1],
		"LAT" => $arCoord[0],
		"TEXT" => $arResult["NAME"]
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:map.google.view",
		"",
		Array(
			"COMPONENT_TEMPLATE" => ".default",
			"CONTROLS" => array("SMALL_ZOOM_CONTROL"),
			"INIT_MAP_TYPE" => "ROADMAP",
			"MAP_DATA" => serialize(array("google_lat" => $arCoord[0],"google_lon" => $arCoord[1], "google_scale" => 10, "PLACEMARKS" => $arPlacemarks)),
			"MAP_HEIGHT" => "500",
			"MAP_ID" => "",
			"MAP_WIDTH" => "100%",
			"OPTIONS" => array("ENABLE_DBLCLICK_ZOOM","ENABLE_DRAGGING","ENABLE_KEYBOARD")
		)
	);?>
<?}?>