<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @global CMain $APPLICATION */
/** @var array $arParams */

if ($_GET['test'] != 'test')
    return;

$catalog_cookie_name = 'FULL_CATALOG_POPUP_SHOWED';
if (isset($_COOKIE[$catalog_cookie_name]))
	return;

?>
<div class="elPopup-form" id="elPopup-form">
    <div class="it-title">
        Получите каталог санаториев
        <i>с самой полной информацией</i>
    </div>
    <div class="it-text">
        Введите e-mail  для получения
        <b>PDF файла на почту!</b>
    </div>
    <div class="it-input">
        <input type="text" placeholder="Email">
        <button>Получить</button>
    </div>
    <div class="it-img"></div>
</div>

