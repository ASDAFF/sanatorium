<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$pagen = $_GET["PAGEN_1"];
$reviews = \Local\Catalog\Reviews::getAll($pagen, array(), array(), array());
$page = "";

$uri = $_SERVER['REQUEST_URI'];
$url = explode("/", $uri);
?>
<div id="cron_full" class="head_block">
    <div id="cron" class="engBox-body">

        <div class="nav-sections">
            <span class="nav-sections-title">Отзывы о санаториях:</span>
            <ul class="ul_city">
                <li class="<?= ($url[2] == "pyatigorsk" ? 'active' : '')?>"><a href="/reviews/pyatigorsk/">Пятигорск</a></li>
                <li class="<?= ($url[2] == "essentuki" ? 'active' : '')?>"><a href="/reviews/essentuki/">Ессентуки</a></li>
                <li class="<?= ($url[2] == "kislovodsk" ? 'active' : '')?>"><a href="/reviews/kislovodsk/">Кисловодск</a></li>
                <li class="<?= ($url[2] == "zheleznovodsk" ? 'active' : '')?>"><a href="/reviews/zheleznovodsk/">Железноводск</a></li>
             </ul>
        </div>
        <div id="cron-crox">
            <span>Главная</span> -
            <span>Пятигорск</span> -
            <a href="/reviews/">Отзывы</a>
        </div>
        <div id="cron-title"><h1>Отзывы</h1></div>
    </div>
</div>

<div class="engBox-body clearfix">
    <div class="engBox-center">
        <div id="content">
            <form class="feedback-form" id="form">
                <div class="feedback-form-ttl">Оставить отзыв о санатории</div>
                <div class="feedback-form-left">
                    <input type="text" class="feedback-form-name" name="name" placeholder="Ваше имя" required><span class="required"></span>
                    <input type="text" class="feedback-form-city" name="city" placeholder="Ваш город">
                    <input type="text" class="feedback-form-tel" name="mail" placeholder="E-mail" required><span class="required"></span>
                    <input type="text" class="feedback-form-tel" name="san" placeholder="Укажите санаторий" required><span class="required"></span>

                </div>
                <div class="feedback-form-right">
                    <textarea placeholder="Ваш комментарий" name="txt" required></textarea><span class="required"></span>
                </div>
                <div class="feedback-form-line">
                    <div class="feedback-form-star">
                        <span>Плохо</span>
                        <div class="mark">
                            <input type="radio" id="star5" name="mark" value="5"><label for="star5" title="5">5</label>
                            <input type="radio" id="star4" name="mark" value="4"><label for="star4" title="4">4</label>
                            <input type="radio" id="star3" name="mark" value="3"><label for="star3" title="3">3</label>
                            <input type="radio" id="star2" name="mark" value="2"><label for="star2" title="2">2</label>
                            <input type="radio" id="star1" name="mark" value="1"><label for="star1" title="1">1</label>
                        </div>
                        <span>Хорошо</span>
                    </div>
                    <input class="feedback-form-btn" type="submit" value="Оставить отзыв">
                </div>


            </form>
            <div id="for_city">
                <? foreach ($reviews as $item) {
                    $page = $item['PAGE'];
                    ?>

                    <div class="rev-item">
                        <div class="rev-item-date"><?=$item['DATE']?></div>
                        <div class="rev-item-about"><?=$item['SAN_NAME']?></div>
                        <div class="rev-item-rate">
                            <div class="mark">
                                <?for ($i = 5; $i>=1; $i--) { ?>
                                    <input type="radio" name="<?="mark-".$item['ID']?>" value="<?=$i?>" <?= ($i == $item['MARK']) ? "checked" : "" ?>/><label title="<?=$i?>"><?=$i?></label>
                                <?}?>
                            </div>
                        </div>

                        <div class="rev-item-txt">
                            <?=$item['TEXT']?>
                        </div>
                        <div class="rev-item-autor">
                            <span class="rev-item-autor-name"><?=$item['NAME']?></span>
                            <span class="rev-item-autor-city"><?=$item['CITY']?></span>
                        </div>

                    </div>

                <? } ?>
            </div>
        </div>
    </div>
    <div class="engBox-right">
        <div class="current-rate">
			<div class="rating">
				<div class="star star-1">
					<span class="on"></span>
				</div>
				<div class="star star-2">
					<span class="on"></span>
				</div>
				<div class="star star-3">
					<span class="on"></span>
				</div>
				<div class="star star-4">
					<span class="on" style="width: 50%"></span>
				</div>
				<div class="star star-5">
					<span class="off"></span>
				</div>
			</div>

            <div class="rate-num">Рейтинг 3.5</div>
        </div>
        <div id="right-ban">
			<a href=""><img src="/images/ban1.jpg"></a>
			<a href=""><img src="/images/ban2.jpg"></a>
			<a href=""><img src="/images/ban3.jpg"></a>
			<a href=""><img src="/images/ban4.jpg"></a>
        </div>
    </div>
</div>
</div>
<div class="el-full-bg-grey b-20">
    <div class="el-page engBox-body">
        <ul>

            <?for ($i=1; $i<=$page; $i++) {?>
            <li>
                <? if ($i == 1 && ($pagen == "" || $pagen == 1)){ ?>
                    <span>1</span>
                <?} else if ($pagen == $i) {?>
                    <span><?=$i?></span>
                <?}else{?>
                    <a href="?PAGEN_1=<?=$i?>"><?=$i?></a>
                <?}?>
            </li>
            <?}?>

        </ul>
        <?/*<a href="">Следующая страница<div class="eng-icon-right"></div></a>*/?>
    </div>
</div>

<script>
    $("#form").submit(function() {
        var form_data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/local/components/tim/empty/templates/reviews/add_rev.php",
            data: form_data,
            success: function() {
                $("#form")[0].reset();
            }});
        return false;
    });

    /*$('.ul_city li').click(function () {
        $('.ul_city li').removeClass("active");
        $(this).addClass("active");
        $.ajax({
            type: "POST",
            url: "/local/components/tim/empty/templates/reviews/san_city.php",
            data: "iblock_id="+$(this).attr('id'),
            success: function(msg) {
                $("#for_city").html(msg);
            }});
        return false;
    });*/
</script>
