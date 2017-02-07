					<?CResort::checkRestartBuffer();?>
					<?IncludeTemplateLangFile(__FILE__);?>
					<?if(!$isIndex):?>
								<?if(!$isMenu):?>
									</div><?// class=col-md-12 col-sm-12 col-xs-12 content-md?>
								<?elseif($isMenu && $arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
									</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
								<?elseif($isMenu && $arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
									</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
									<?if($APPLICATION->GetProperty("MENU")=="Y"){?>
										<div class="col-md-3 col-sm-3 col-xs-4 right-menu-md">
											<?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
												"ROOT_MENU_TYPE" => "left",
												"MENU_CACHE_TYPE" => "A",
												"MENU_CACHE_TIME" => "3600",
												"MENU_CACHE_USE_GROUPS" => "Y",
												"MENU_CACHE_GET_VARS" => array(
												),
												"MAX_LEVEL" => "4",
												"CHILD_MENU_TYPE" => "subleft",
												"USE_EXT" => "Y",
												"DELAY" => "N",
												"ALLOW_MULTI_SELECT" => "Y"
												),
												false
											);?>
											<div class="sidearea">
												<?$APPLICATION->ShowViewContent('under_sidebar_content');?>
												<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/under_sidebar.php"), false);?>
											</div>
										</div>
									<?}?>
								<?endif;?>
						<?if(!$isContacts):?>
							</div><?// class="maxwidth-theme?>
						</div><?// class=row?>
						<?endif;?>
					<?endif;?>
				</div><?// class=container?>
				<?if($isIndex):?>
					<?=$indexEpilog; // buffered from indexblocks.php?>
				<?endif;?>
				<?if($isPrices):?>
					<?@include(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'/priceblocks.php'));?>
					<?=$priceProlog; // buffered from priceblocks.php?>
				<?endif;?>
			</div><?// class=main?>
		</div><?// class=body?>
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="maxwidth-theme">
						<div class="top_block clearfix">
							<div class="col-md-3 hidden-sm hidden-xs">
								<div class="info">
									<div class="compass">
										<i class="fa"></i>
										<?$APPLICATION->IncludeFile(SITE_DIR."include/site-address.php", array(), array(
												"MODE" => "html",
												"NAME" => "Адрес",
											)
										);?>
									</div>
									<div class="contacts"><a class="btn btn-default" href="<?=SITE_DIR;?>contacts/"><?=GetMessage('CONTACTS_LINK');?></a></div>
								</div>
							</div>
							<div class="col-md-9 col-sm-12">
								<div class="row">
									<div class="col-md-9 col-sm-9">
										<?$APPLICATION->IncludeComponent(
											"bitrix:menu", 
											"bottom", 
											array(
												"ROOT_MENU_TYPE" => "bottom1",
												"MENU_CACHE_TYPE" => "A",
												"MENU_CACHE_TIME" => "3600000",
												"MENU_CACHE_USE_GROUPS" => "N",
												"MENU_CACHE_GET_VARS" => array(
												),
												"MAX_LEVEL" => "1",
												"CHILD_MENU_TYPE" => "bottom",
												"USE_EXT" => "N",
												"DELAY" => "N",
												"ALLOW_MULTI_SELECT" => "Y",
												"COMPONENT_TEMPLATE" => "bottom"
											),
											false
										);?>
									</div>
									<div class="col-md-3 col-sm-3">
										<div class="social pull-right">
											<?$APPLICATION->IncludeComponent("aspro:social.info.resort", "", array(
												"CACHE_TYPE" => "A",
												"CACHE_TIME" => "3600000",
												"CACHE_GROUPS" => "N"
												),
												false
											);?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="maxwidth-theme">
						<div class="bottom_block clearfix">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6 text-left">
									<div class="copy">
										<?$APPLICATION->IncludeFile(SITE_DIR."include/copy.php", Array(), Array(
												"MODE" => "php",
												"NAME" => "Copyright",
											)
										);?>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 text-right">
									<div id="bx-composite-banner"></div>
								</div>
							</div>
						</div>
					</div> 
				</div>
			</div>
		</footer>
		<div class="bx_areas">
			<?$APPLICATION->IncludeFile(SITE_DIR."include/invis-counter.php", Array(), Array(
					"MODE" => "text",
					"NAME" => "Counters place for Yandex.Metrika, Google.Analytics",
				)
			);?>
		</div>
		<?CResort::SetMeta();?>
	</body>
</html>