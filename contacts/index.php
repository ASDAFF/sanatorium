<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");?>

	<div id="cron_full" class="head_block">
		<div id="cron" class="engBox-body"><?

			$APPLICATION->IncludeComponent('bitrix:breadcrumb', '');

            ?>
			<div id="cron-title"><h1>Контакты</h1></div>
		</div>
	</div>


	<div class="engBox-body clearfix">
		<div class="page-contacts" itemscope itemtype="http://schema.org/Organization">
			<div class="page-contacts-box">
				<div class="block-inline-sm">
					<div class="company-name" itemprop="name">ООО туристическая компания "Ладья"</div><br>
					<div class="sm-title"><span class="place-icon"></span>Адрес</div>
                    <span itemprop="address">г. Пятигорск<br>проспект Кирова, 90</span><br><br>
				</div>
				<div class="block-inline-sm">
					<div class="sm-title"><span class="phone-icon"></span>Телефон</div>
                    <span itemprop="telephone">8(8793)39-17-17</span>, <span itemprop="telephone">8 800 775 2604</span>
				</div>
			</div>
			<div class="page-contacts-map">
				<iframe src="https://api-maps.yandex.ru/frame/v1/-/CZX9vZmR" width="100%" height="400" frameborder="0"></iframe>
			</div>
		</div>
	</div>

<?/*<div class="row contacts" itemscope itemtype="http://schema.org/Organization">
	<div class="col-md-12">
		<div class="row contacts">
			<div class="col-md-5"> 
				<div itemprop="description"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-about.php", Array(), Array("MODE" => "html", "NAME" => "Contacts about"));?></div>
			</div>
			<div class="col-md-7">
				<table cellpadding="0" cellspasing="0"> 
					<tbody> 
						<tr>
							<td align="left" valign="top"><i class="fa colored fa-map-marker"></i></td><td align="left" valign="top"><span class="dark_table">Адрес</span>
								<br />
								<span itemprop="address"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", Array(), Array("MODE" => "html", "NAME" => "Address"));?></span>
							</td>
							<td align="left" valign="top"><i class="fa colored fa-phone"></i></td><td align="left" valign="top"> <span class="dark_table">Телефон</span>
								<br />
								<span itemprop="telephone"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-phone.php", Array(), Array("MODE" => "html", "NAME" => "Phone"));?></span>
							</td>
						</tr>
						<tr>
						</tr>
						<tr>
							<td align="left" valign="top"><i class="fa colored fa-envelope"></i></td><td align="left" valign="top"> <span class="dark_table">E-mail</span>
								<br />
								<span itemprop="email"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-email.php", Array(), Array("MODE" => "html", "NAME" => "Email"));?></span>
							</td>
							<td align="left" valign="top"><i class="fa colored fa-clock-o"></i></td><td align="left" valign="top"> <span class="dark_table">Режим работы</span>
								<br />
								<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-schedule.php", Array(), Array("MODE" => "html", "NAME" => "Schedule"));?>
							</td>
						</tr>
						<tr>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="tabs contacts_tabs">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#contacts_map" data-toggle="tab">Расположение</a></li>
		<li><a href="#contacts_schema" data-toggle="tab">Как проехать</a></li>
	</ul>
</div>


		</div><?// class=col-md-12 col-sm-12 col-xs-12 content-md?>
	</div><?// class="maxwidth-theme?>
</div><?// class=row?>


<div class="tab-content contacts_tab_content">
	<div class="tab-pane active" id="contacts_map">
		<div class="map_block">
			<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("map-block");?>
			<?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view", 
	"resort", 
	array(
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:54.922085864972;s:10:\"google_lon\";d:59.22640090331993;s:12:\"google_scale\";i:7;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:13:\"Аспро: Курорт\";s:3:\"LON\";d:59.230728149414;s:3:\"LAT\";d:54.914908688182;}}}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array(
		),
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
			2 => "ENABLE_KEYBOARD",
		),
		"MAP_ID" => "",
		"COMPONENT_TEMPLATE" => "resort",
		'ZOOM_BLOCK' => array(
			'POSITION' => 'right bottom'
		)
	),
	false
);
			?>
			<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("map-block", "");?>
		</div>
	</div>
	<div class="tab-pane" id="contacts_schema">
		<div class="row">
			<div class="maxwidth-theme">
				<div class="col-md-12">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-schema.php", Array(), Array("MODE" => "html", "NAME" => "Schema"));?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="color_block">
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="block front">
					<div class="row">
						<div class="col-md-3 col-sm-3">
							<div class="front-text1">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/front-text1.php",
										"EDIT_TEMPLATE" => "standard.php"
									)
								);?>
							</div>
						</div>
						<div class="col-md-7 col-sm-6">
							<div class="front-text2">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/front-text2.php",
										"EDIT_TEMPLATE" => "standard.php"
									)
								);?>
							</div>
						</div>
						<div class="col-md-2 col-sm-3">
							<div class="front-text3">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/front-text3.php",
										"EDIT_TEMPLATE" => "standard.php"
									)
								);?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>*/?>
	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>