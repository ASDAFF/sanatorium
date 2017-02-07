<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?ob_start();?>
	<div class="color_block">
		<div class="row">
			<div class="maxwidth-theme">
				<div class="col-md-12">
					<div class="block front">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-3 col-sm-3">
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
										<div class="col-md-7 col-sm-6">
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
										<div class="col-md-2 col-sm-3">
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
			</div>
		</div>
	</div>
<?$priceProlog = ob_get_clean();?>