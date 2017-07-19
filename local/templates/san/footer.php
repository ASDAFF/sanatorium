<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CMain $APPLICATION */
$APPLICATION->IncludeComponent('tim:empty', 'main_managers', array());

?>
<?if($APPLICATION->GetCurDir() != '/'):?>
<div class="elIndexVideo">
    <div class="engBox-body">
        <div class="elIndexVideoSlider">
            <a href="#elAboutBox1-video" class="it-video elAboutBox_fancy">
                <div class="it-video-popap" id="elAboutBox1-video" style="display: none;">
                    <iframe src="https://www.youtube.com/embed/QS8tYQbUrNk" frameborder="0"  allowfullscreen=""></iframe>
                </div>
                <div class="it-video-body" style="background-image: url('/images/elIndexVideo-1.jpg">
                    <div class="it-video-body-stab">
                        <div class="it-text"><span>О сервисе бронирования</span></div>
                        <div class="it-play elIndexVideo_play"></div>
                    </div>
                </div>
            </a>
            <a href="#elAboutBox2-video" class="it-video elAboutBox_fancy">
                <div class="it-video-popap" id="elAboutBox2-video" style="display: none;">
                    <iframe src="https://www.youtube.com/embed/8tQOxiI08mI" frameborder="0" allowfullscreen=""></iframe>
                </div>
                <div class="it-video-body" style="background-image: url('/images/elIndexVideo-2.jpg');">
                    <div class="it-video-body-stab">
                        <div class="it-text"><span>Ваши выгоды покупки</span></div>
                        <div class="it-play elIndexVideo_play"></div>
                    </div>
                </div>
            </a>
            <a href="#elAboutBox3-video" class="it-video elAboutBox_fancy">
                <div class="it-video-popap" id="elAboutBox3-video" style="display: none;">
                    <iframe src="https://www.youtube.com/embed/e6NP0C7wEDc" frameborder="0"></iframe>
                </div>
                <div class="it-video-body" style="background-image: url('/images/elIndexVideo-3.jpg');">
                    <div class="it-video-body-stab">
                        <div class="it-text"><span>Отзыв о сервисе</span></div>
                        <div class="it-play elIndexVideo_play"></div>
                    </div>
                </div>
            </a>
            <a href="#elAboutBox4-video" class="it-video elAboutBox_fancy">
                <div class="it-video-popap" id="elAboutBox4-video" style="display: none;">
                    <iframe src="https://www.youtube.com/embed/lN4UeTJ4Xpg" frameborder="0"></iframe>
                </div>
                <div class="it-video-body" style="background-image: url('https://i.ytimg.com/vi/lN4UeTJ4Xpg/sddefault.jpg');">
                    <div class="it-video-body-stab">
                        <div class="it-text"><span>Отзыв о сервисе</span></div>
                        <div class="it-play elIndexVideo_play"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<?endif;?>
<div id="phone">
    <div class="engBox-body">
        <div class="phone"><i class="icon-phome-mega"></i><a>8 800 775 2604</a></div>
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
                <a href="/contacts/">Контакты</a><br />
                <a href="/maps/">Санатории на карте</a>
                <!--<a href=""><img src="/images/webmaster.png"></a>-->
            </div>
            <div class="right">
                <span class="it-city">г. Пятигорск, пр. Кирова, 90</span>
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
</html><?


$value = $APPLICATION->GetPageProperty('og_title');
if (!$value)
{
	$value = $APPLICATION->GetPageProperty('title');
	$APPLICATION->SetPageProperty('og_title', $value);
}

$value = $APPLICATION->GetPageProperty('og_description');
if (!$value)
{
	$value = $APPLICATION->GetPageProperty('description');
	$APPLICATION->SetPageProperty('og_description', $value);
}

$value = $APPLICATION->GetPageProperty('og_url');
if (!$value)
{
	$value = 'https://putevochka.com' . $APPLICATION->GetCurPage();
	$APPLICATION->SetPageProperty('og_url', $value);
}

$value = $APPLICATION->GetPageProperty('og_image');
if (!$value)
{
	$value = 'https://putevochka.com/images/logo_new.png';
	$APPLICATION->SetPageProperty('og_image', $value);
}

$value = $APPLICATION->GetPageProperty('og_type');
if (!$value)
{
	$value = 'website';
	$APPLICATION->SetPageProperty('og_type', $value);
}