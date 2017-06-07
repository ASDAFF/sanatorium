<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

/** @var CMain $APPLICATION */

?><!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic" rel="stylesheet">
    <title><? $APPLICATION->ShowTitle(); ?></title><?
	
    $assets = \Bitrix\Main\Page\Asset::getInstance();

	 CJSCore::init(array('jquery2'));

	$assets->addJs(SITE_DIR . 'js/jquery-ui/jquery-ui.min.js');
    $assets->addJs(SITE_DIR . 'js/fancybox/jquery.fancybox.js');
	$assets->addJs(SITE_DIR . 'js/owl/owl.carousel.min.js');
	$assets->addJs(SITE_DIR . 'js/readmore.min.js');

    $assets->addJs(SITE_DIR . 'js/scripts.js');
    $assets->addJs(SITE_DIR . 'js/catalog.js');


    $assets->addCss(SITE_DIR . 'js/jquery-ui/jquery-ui.min.css');
    $assets->addCss(SITE_DIR . 'js/fancybox/jquery.fancybox.css');
	$assets->addCss(SITE_DIR . 'js/owl/owl.carousel.css');

	$assets->addCss(SITE_DIR . 'css/zcallback_widget.css');
	$assets->addCss(SITE_DIR . 'css/style.css');
    $assets->addCss(SITE_DIR . 'css/media.css');
	
	$APPLICATION->ShowHead();

	// Всю шнягу типа счетчиков, трекеров - сюда:
	$APPLICATION->IncludeFile(SITE_DIR . 'include/tmpl_head_bot.php');
?>
</head>
<body><?

// Всю шнягу типа счетчиков, трекеров - сюда:
$APPLICATION->IncludeFile(SITE_DIR . 'include/tmpl_body_top.php');

$APPLICATION->ShowPanel();

?>
<header class="header">
	<div class="header-line_wbg engBox-body">
		<div class="header-logo"><?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php",array(),array("MODE"=>"html"));?></div>
		<div class="header-time-work"><?$APPLICATION->IncludeFile(SITE_DIR."include/timeWork.php",array(),array("MODE"=>"text"));?></div>
        <div class="header-soc">
            <a href="tel:89197401215">
                <img src="/images/engIcon-whatsapp.png">
            </a>
            <a href="tel:89197401215">
                <img src="/images/engIcon-viber.png">
            </a>
            <a href="tg://resolve?domain=+79197401215"">
            <img src="/images/engIcon-telegram.png">
            </a>
        </div>
<!--            <div class="header-adress">--><?//$APPLICATION->IncludeFile(SITE_DIR."include/site-address.php",array(),array("MODE"=>"text"));?><!--</div>-->
<!--            <div class="header-account"><a href="#" data-link="https://26.u-on.ru/">Личный кабинет</a></div>-->

		<div class="header-phone">
			<?$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php",array(),array("MODE"=>"html"));?>
		</div>
	</div>
	<div class="head_full">
		<nav class='engBox-body main-menu p-head'>
			<?$APPLICATION->IncludeComponent(
				'bitrix:menu', 
				'topHor', 
				array(
					'ALLOW_MULTI_SELECT' => 'N',
					'CHILD_MENU_TYPE' => 'bottom',
					'DELAY' => 'N',
					'MAX_LEVEL' => '2',
					'MENU_CACHE_GET_VARS' => array(
					),
					'MENU_CACHE_TIME' => '3600',
					'MENU_CACHE_TYPE' => 'Y',
					'ROOT_MENU_TYPE' => 'top',
					'USE_EXT' => 'Y',
					'COMPONENT_TEMPLATE' => 'topHor'
				),
				false
			);

			?>
			<div class="nav_search">
				<form class="searchbox" action="/sanatorium/">
					<input type="search" placeholder="Введите название санатория......" name="q"
					       class="searchbox-input" onkeyup="buttonUp();" required>
					<input type="submit" class="searchbox-submit" value="Найти">
					<span class="searchbox-icon"></span>
				</form>
				<div class="searchbox-close"></div>
			</div>
			<a href="#" id="pull">Меню</a>
		</nav>
	</div>
	<div class="head_pun_full">
		<ul class="engBox-body clearfix bl head_pun">
			<li><a class="icon1" href="/about/vigody/">Путевки по цене санатория</a></li>
			<li><a class="icon2" href="/about/vigody/">Бесплатный трансфер</a></li>
			<li class="sale">
				<p class="sale-text">
					<b>Нашли дешевле?</b>
					<span>Предложим скидку!</span>
				</p>
				<a class="sale-link" href="/about/vigody/" id="haad_pun-bnt">
                    Оплата путевки в день заезда!
                </a>
			</li>
		</ul>
	</div>
</header><?

$APPLICATION->IncludeComponent('tim:empty','catalog_popup');
