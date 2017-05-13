<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$items = \Local\Catalog\Sanatorium::get(
	array('PROPERTY_RATING' => 'desc'),
	array(),
	array('nPageSize' => 12, 'iNumPage' => 1)
);

$file = new \CFile();

?>

<div class="elIndexVideo">
    <div class="engBox-body">
        <a href="#elAboutBox1-video" class="it-video elAboutBox_fancy">
            <div class="it-video-popap" id="elAboutBox1-video" style="display: none;">
                <iframe src="https://www.youtube.com/embed/QS8tYQbUrNk" frameborder="0"  allowfullscreen=""></iframe>
            </div>
            <div class="it-video-body" style="background-image: url('https://i.ytimg.com/vi/QS8tYQbUrNk/sddefault.jpg');">
                <div class="it-video-body-stab">
                    <div class="it-text">О сервисе бронирования</div>
                    <div class="it-play elIndexVideo_play"></div>
                </div>
            </div>
        </a>
        <a href="#elAboutBox2-video" class="it-video elAboutBox_fancy">
            <div class="it-video-popap" id="elAboutBox2-video" style="display: none;">
                <iframe src="https://www.youtube.com/embed/8tQOxiI08mI" frameborder="0" allowfullscreen=""></iframe>
            </div>
            <div class="it-video-body" style="background-image: url('https://i.ytimg.com/vi/8tQOxiI08mI/sddefault.jpg');">
                <div class="it-video-body-stab">
                    <div class="it-text">Ваши выгоды покупки</div>
                    <div class="it-play elIndexVideo_play"></div>
                </div>
            </div>
        </a>
        <a href="#elAboutBox3-video" class="it-video elAboutBox_fancy">
            <div class="it-video-popap" id="elAboutBox3-video" style="display: none;">
                <iframe src="https://www.youtube.com/embed/e6NP0C7wEDc" frameborder="0"></iframe>
            </div>
            <div class="it-video-body" style="background-image: url('https://i.ytimg.com/vi/e6NP0C7wEDc/sddefault.jpg');">
                <div class="it-video-body-stab">
                    <div class="it-text">Отзыв о сервисе</div>
                    <div class="it-play elIndexVideo_play"></div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="el-full-bg-ser">
    <div class="el-sanat-list engBox-body">
        <div class="title">
            Санатории - ТОП 12
            <span>Кавказские Минеральные Воды</span>
        </div><?
	    foreach ($items['ITEMS'] as $item)
	    {
		    $city = \Local\Catalog\City::getById($item['CITY']);
		    $img = $file->ResizeImageGet(
			    $item['PREVIEW_PICTURE'],
			    array(
				    'width' => 261,
				    'height' => 1000
			    ),
			    BX_RESIZE_IMAGE_PROPORTIONAL,
			    true
		    );
	        ?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="item">
                <div class="img"><img src="<?= $img['src'] ?>"></div>
                <div class="text eng-animations">
                    <b>Санаторий <?= $item['NAME'] ?></b>
	                <span>КМВ, <?= $city['NAME'] ?></span>
                    <i>Подробнее</i>
                </div>
                <div class="money"><b>от <?= $item['PRICE'] ?> р.</b><span>СУТКИ</span></div>
            </a><?
	    }
	    ?>
        <div class="top-s-searchbox">
            <div class="btn btn-all">
                <a href="/sanatorium/">смотреть все санатории</a>
            </div>
            <form class="s-searchbox" action="/sanatorium/">
                <input type="search" placeholder="Введите название санатория......" name="q"
                       class="s-searchbox-input">
                <input type="submit" class="s-searchbox-submit" value="Найти">
            </form>
        </div>
    </div>
</div>
