<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CMain $APPLICATION */
$APPLICATION->IncludeComponent('tim:empty', 'main_managers', array());

?>
<div id="phone">
    <div class="engBox-body">
        <div class="phone"><i class="icon-phome-mega"></i>8 800 800 00 00</div>
        <div class="text">Исходящие вызовы по России бесплатны.<br>
            Проконсультируем вас по любому вопросу, поможем подобрать подходящие путевки для вас и вашей семьи
        </div>
    </div>
</div>
<footer>
    <div class="engBox-body">
        <div>
            <div class="left">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php",array(),array("MODE"=>"html"));?>
            </div>
            <div class="center">Сервис бронирования путевок в санатории</div>
            <div class="right">
                <a href=""><img src="/images/webmaster.png"></a>
            </div>
        </div>
    </div>
</footer><?

$APPLICATION->IncludeComponent('tim:empty', 'bottom_filter', array());

// Всю шнягу типа счетчиков, трекеров - сюда:
$APPLICATION->IncludeFile(SITE_DIR . 'include/tmpl_body_bot.php');

?>
<div id="engBtnTop"></div>
</body>
</html>