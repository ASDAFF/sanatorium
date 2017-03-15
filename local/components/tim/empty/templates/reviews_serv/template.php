<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$pagen = $_GET["PAGEN_1"];
$page = "";
$reviews = \Local\Catalog\ReviewsServ::getAll($pagen, array(), array(), array());

?>
<div id="cron_full" class="head_block">
    <div id="cron" class="engBox-body">



        <div id="cron-crox">
            <span>Главная</span> -
            <span>Пятигорск</span> -
            <a href="">Отзывы о сервисе</a>
        </div>
        <div id="cron-title"><h1>Отзывы о сервисе</h1></div>
    </div>
</div>

<div class="engBox-body clearfix">
    <div class="engBox-center">
        <div id="content">
            <form class="feedback-form" id="form">
                <div class="feedback-form-ttl">Оставить отзыв о сервисе</div>
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
            <? foreach ($reviews as $item) {
                $page = $item['PAGE'];
                ?>

                <div class="rev-item">
                    <div class="rev-item-date"><?=$item['DATE']?></div>

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
    <div class="engBox-right">
        <div class="current-rate">
            <div class="mark">
                <input type="radio" name="mark-cur" value="5"><label title="5">5</label>
                <input type="radio" name="mark-cur" value="4" checked><label title="4">4</label>
                <input type="radio" name="mark-cur" value="3"><label title="3">3</label>
                <input type="radio" name="mark-cur" value="2"><label title="2">2</label>
                <input type="radio" name="mark-cur" value="1"><label title="1">1</label>
            </div>
            <div class="rate-num">Рейтинг 9.4</div>
        </div>
        <div id="right-ban">
            <a href=""><img src="images/ban1.jpg"></a>
            <a href=""><img src="images/ban2.jpg"></a>
            <a href=""><img src="images/ban3.jpg"></a>
            <a href=""><img src="images/ban4.jpg"></a>
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
            url: "/local/components/tim/empty/templates/reviews_serv/add_rev.php",
            data: form_data,
            success: function() {
                $("#form")[0].reset();
            }});
        return false;
    });
</script>
