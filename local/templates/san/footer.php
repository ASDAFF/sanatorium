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

?>
<script type="text/javascript">
    var ZCallbackWidgetLinkId  = 'fda66b7ab4c3b906e73b3967115fbaaa';
    var ZCallbackWidgetDomain  = 'my.zadarma.com';
    (function(){
        var lt = document.createElement('script');
        lt.type ='text/javascript';
        lt.charset = 'utf-8';
        lt.async = true;
        lt.src = 'https://' + ZCallbackWidgetDomain + '/callbackWidget/js/main.min.js?unq='+Math.floor(Math.random(0,1000)*1000);
        var sc = document.getElementsByTagName('script')[0];
        if (sc) sc.parentNode.insertBefore(lt, sc);
        else document.documentElement.firstChild.appendChild(lt);
    })();
</script>
</body>
</html>