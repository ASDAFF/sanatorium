<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка: 404 - Страница не найдена");
?>
<div class="el404 engBox-body">
    <div class="images">
        <img src="/images/404.png" alt="404">
    </div>
    <div class="title">ОШИБКА <br> Страница не найдена </div>
    <div class="text">Неправильно набран адрес или такой страницы не существует</div>
    <div class="link"><a href="/">Перейти на главную</a></div>
    <div class="text">возможно Вас заинтересуют другие санатории</div>
    <div class="button"><a href="/sanatorium/">Выбрать санаторий</a></div>
</div>
<script type="text/javascript">
$(window).resize(function(){ //  BX.addCustomEvent('onWindowResize', function(eventdata) {
	try{
		var windowHeight = $(window).outerHeight();
		var panelHeight = $('#panel').outerHeight();
		var headerHeight = $('header').outerHeight();
		var footerHeight = $('footer').outerHeight();
		var mainPaddingTop = parseInt($('.main').css('padding-top'));
		var mainPaddingBottom = parseInt($('.main').css('padding-bottom'));
		var bodyMarginTop = parseInt($('.body').css('margin-top'));
		var bodyMarginBottom = parseInt($('.body').css('margin-bottom'));
		var page404Height = $('.page404').outerHeight();
		var part = Math.floor((windowHeight - panelHeight - headerHeight - footerHeight - page404Height) / 2);
		console.log(part);
		if(part < (mainPaddingTop + bodyMarginTop)){
			part = mainPaddingTop + bodyMarginTop;
		}
		if(part < (mainPaddingBottom + bodyMarginBottom)){
			part = mainPaddingBottom + bodyMarginBottom;
		}
		console.log(part);
		var top = (part - mainPaddingTop - bodyMarginTop);
		if(top < 0){
			top = 0;
		}
		var bottom = (part - mainPaddingBottom - bodyMarginBottom);
		if(bottom < 0){
			bottom = 0;
		}
		ignoreResize.push(true);
		$('.page404').css({'opacity': '1', 'margin-top': top + 'px', 'margin-bottom': bottom + 'px'});
		setTimeout(function() {
			$('.page404').css({'transition': 'none', '-moz-transition': 'none', '-ms-transition': 'none', '-o-transition': 'none', '-webkit-transition': 'none'});
		}, 400);
		ignoreResize.pop();
	}
	catch(e){}
});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>