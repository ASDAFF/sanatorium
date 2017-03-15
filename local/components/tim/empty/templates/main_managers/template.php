<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//$slideCity = \Local\Catalog\SlideCity::getAll(array(), array(), array());

$return = array();

$iblockElement = new \CIBlockElement();
$rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
    'IBLOCK_ID' => 32,
    'ACTIVE' => 'Y',
), false, Array("nTopCount" => 4), array(
    'ID',
    'NAME',
    'IBLOCK_ID',
    'PREVIEW_PICTURE',
    'PROPERTY_MANAGER_PHONE',
));
while ($item = $rsItems->Fetch()) {
    $return[$item['ID']] = array(
        'ID' => $item['ID'],
        'NAME' => $item['NAME'],
        'PREVIEW_PICTURE' => \CFile::GetPath($item['PREVIEW_PICTURE']),
        'MANAGER_PHONE' => $item['PROPERTY_MANAGER_PHONE_VALUE'],
    );
}


?>


<div class="engBox-body">
    <div id="people">
        <div class="title">Остались вопросы? Задайте их менеджеру!</div>
        <? foreach ($return as $item) {?>
        <div class="item">
            <div class="img"><img src="<?=$item['PREVIEW_PICTURE']?>"></div>
            <div class="name"><?=$item['NAME']?></div>
            <div class="phone icon-phone"><?=$item['MANAGER_PHONE']?></div>
            <div class="btn"><a href="">Заказать звонок</a></div>
        </div>
        <?}?>
    </div>
</div>


