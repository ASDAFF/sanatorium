<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//$slideCity = \Local\Catalog\SlideCity::getAll(array(), array(), array());

$return = array();

$iblockElement = new \CIBlockElement();
$rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
    'IBLOCK_ID' => 7,
    'ACTIVE' => 'Y',
), false, Array("nTopCount" => 2), array(
    'ID',
    'NAME',
    'PREVIEW_TEXT',
));
while ($item = $rsItems->Fetch()) {
    $return[$item['ID']] = array(
        'ID' => $item['ID'],
        'NAME' => $item['NAME'],
        'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
    );
}

?>

<div id="comments">
    <div class="engBox-body">
        <div class="title">
            Отзывы
        </div>
        <? foreach ($return as $item) {?>
            <div class="item mobile icon-comment-full">
                <div class="date icon-comment">
                    26 октября 2016
                </div>
                <div class="title">
                    <?=$item['NAME']?>
                </div>
                <div class="city">
                    г. Санкт-Петербург
                </div>
                <div class="text">
                    <?=$item['PREVIEW_TEXT']?>
                </div>
                <div class="btn">
                    <a href="#">Читать далее</a>
                </div>
            </div>
        <?}?>
        <div class="btn">
            <a href=""> Все отзывы</a>
        </div>
    </div>
</div>