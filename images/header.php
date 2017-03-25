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
    $assets->addJs(SITE_TEMPLATE_PATH . '/js/scripts.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/js/catalog.js');
    $assets->addJs(SITE_TEMPLATE_PATH . '/js/jquery.js');
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
</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<header class="header">
	<div class="header-line_wbg engBox-body">
		<div class="header-logo"><img src="../images/logo_head.png"></div>
		<div class="header-time-work">Без праздников и выходных</div>
		<div class="header-adress">г. Пятигорск, пр. Кирова, 90</div>
		<div class="header-account"><a href="#">Личный кабинет</a></div>
		<div class="header-phone">
			<a class="header-phone-link" href="tel:+1234567890">8 800 800 00 00</a>
			<p>Звонок бесплатный</p>
		</div>
	</div>
	<div class="head_full">
		<nav class="engBox-body main-menu p-head">
			<ul>
				<li><a>О сервисе</a></li>
				<li class="menu_parent"><a>Снатории</a>
					<ul class="submenu">
						<li><a>Пятигорск</a></li>
						<li><a>Железноводск</a></li>
						<li><a>Еcсентуки</a></li>
						<li><a>Кисловодск</a></li>
					</ul>
				</li>
				<li><a>Акции</a></li>
				<li><a>Отзывы</a></li>
				<li><a>Рейтинг санаториев</a></li>
				<li><a>Цены</a></li>
				<li><a>Контакты</a></li>
			</ul>
			<div class="nav_search">
				<form class="searchbox">
					<input type="search" placeholder="Введите название санатория......" name="search" class="searchbox-input" onkeyup="buttonUp();" required>
					<input type="submit" class="searchbox-submit" value="">
					<span class="searchbox-icon"><img src="/images/icon_serch_btn.jpg"></span>
				</form>
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

<div class="engBox-body">