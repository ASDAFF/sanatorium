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


    $assets->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
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
<div class="engBox-body"></div>
<div id="head_full">
    <nav id="head" class="engBox-body main-menu">
        <ul>
            <li><a>О сервисе</a></li>
            <li><a>Снатории</a>
				<ul class='submenu'>
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
        <a href="#" id="pull">Меню</a>
    </nav>
</div>
<div id="head_pun_full">
    <div id="head_pun" class="engBox-body">
        <li><a class="icon1">Официальные цены санаториев</a></li>
        <li><a class="icon2">Бесплатный трансфер</a></li>
        <li><a href="" id="haad_pun-bnt">подробнее</a></li>
    </div>
</div>
<div id="cron_full">
    <div id="cron" class="engBox-body">
        <div id="cron-right">
            <div id="reviewStars-input">
                <input id="star-4" type="radio" name="reviewStars"/>
                <label title="gorgeous" for="star-4"></label>

                <input id="star-3" type="radio" name="reviewStars"/>
                <label title="good" for="star-3"></label>

                <input id="star-2" type="radio" name="reviewStars"/>
                <label title="regular" for="star-2"></label>

                <input id="star-1" type="radio" name="reviewStars"/>
                <label title="poor" for="star-1"></label>

                <input id="star-0" type="radio" name="reviewStars"/>
                <label title="bad" for="star-0"></label>
            </div>
            <div>
                Цена от <b>1500</b> руб<br><span>за номер в сутки</span>
            </div>
        </div><?

	    $APPLICATION->IncludeComponent('bitrix:breadcrumb', '', Array());

	    ?>
        <div id="cron-title"><h1><? $APPLICATION->ShowTitle(false, false); ?></h1></div>
    </div>
</div>

<div class="engBox-body">