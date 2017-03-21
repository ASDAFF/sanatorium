<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

/** @var CMain $APPLICATION */

?><!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><? $APPLICATION->ShowTitle(); ?></title><?
	
    $assets = \Bitrix\Main\Page\Asset::getInstance();
    
    CJSCore::init(array('jquery2'));
    $assets->addJs(SITE_TEMPLATE_PATH . '/js/jquery-ui.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/js/jquery.flexslider-min.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/js/fancybox/jquery.fancybox.js');
    $assets->addJs(SITE_DIR . 'js/scripts.js');
    
    $page = $APPLICATION->GetCurPage();
    if($page == "/"){
        $assets->addJs(SITE_DIR . 'js/filter.js');
    }else{
        $assets->addJs(SITE_DIR . 'js/catalog.js');
    }
    
    //$assets->addJs(SITE_TEMPLATE_PATH . '/js/jquery.js');
    $assets->addJs('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');


    $assets->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/css/media.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/js/jquery-ui.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/js/jquery-ui.structure.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/js/jquery-ui.theme.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/css/flexslider.css');
    $assets->addCss(SITE_TEMPLATE_PATH . '/js/fancybox/jquery.fancybox.css');
	
	$APPLICATION->ShowHead();
    ?>
	<script type="text/javascript" charset="utf-8">
		$(window).load(function() {
			// The slider being synced must be initialized first
			$('#carousel').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				itemWidth: 120,
				itemHeight: 50,
				itemMargin: 5,
				asNavFor: '#slider'
			});

			$('#slider').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				sync: "#carousel"
			});
		});
	</script>
</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<header class="header">
	<div class="header-line_wbg engBox-body">
		<div class="header-logo"><?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php",array(),array("MODE"=>"html"));?></div>
		<div class="header-time-work"><?$APPLICATION->IncludeFile(SITE_DIR."include/timeWork.php",array(),array("MODE"=>"text"));?></div>
		<div class="header-adress"><?$APPLICATION->IncludeFile(SITE_DIR."include/site-address.php",array(),array("MODE"=>"text"));?></div>
		<div class="header-account"><a href="#">Личный кабинет</a></div>
		<div class="header-phone">
			<?$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php",array(),array("MODE"=>"html"));?>
		</div>
	</div>
	<div class="head_full">
		<nav class="engBox-body main-menu p-head">
			<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"topHor", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "bottom",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "topHor"
	),
	false
);?>

			<div class="nav_search">
				<form class="searchbox">
					<input type="search" placeholder="Введите название санатория......" name="search" class="searchbox-input" onkeyup="buttonUp();" required>
					<input type="submit" class="searchbox-submit" value="Найти">
					<span class="searchbox-icon"><img src="<?=SITE_TEMPLATE_PATH;?>/images/icon_serch_btn.jpg"></span>
				</form>
				<div class="searchbox-close"></div>
			</div>
			<a href="#" id="pull">Меню</a>
		</nav>
	</div>
	<div class="head_pun_full">
		<ul class="engBox-body clearfix bl head_pun">
			<li><a class="icon1" href="#">Официальные цены санаториев</a></li>
			<li><a class="icon2" href="#">Бесплатный трансфер</a></li>
			<li class="sale">
				<p class="sale-text">
					<b>Нашли дешевле?</b>
					<span>Мы предложим вам СКИДКУ!</span>
				</p>
				<a class="sale-link" href="#" id="haad_pun-bnt">подробнее</a>
			</li>
		</ul>
	</div>
</header>
