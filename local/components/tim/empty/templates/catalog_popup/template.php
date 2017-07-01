<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @global CMain $APPLICATION */
/** @var array $arParams */

//if ($_GET['test'] != 'test')
//    return;

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
        <form method="post" action="<?=SITE_DIR?>ajax/catalog_full.php" class="ajax_catalog_pdf">
            <input type="text" name="catalog_full_email" required placeholder="Email">
            <div class="error"></div>
            <button type="submit">Получить</button>
        </form>
    </div>
    <div class="it-img"></div>
</div>

