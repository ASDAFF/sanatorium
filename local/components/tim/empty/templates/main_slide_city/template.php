<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//$slideCity = \Local\Catalog\SlideCity::getAll(array(), array(), array());

$return = array();

$iblockElement = new \CIBlockElement();
$rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
    'IBLOCK_ID' => 29,
    'ACTIVE' => 'Y',
), false, Array("nTopCount" => 4), array(
    'ID',
    'NAME',
    'IBLOCK_ID',
    'PREVIEW_PICTURE',
    'PREVIEW_TEXT',
));
while ($item = $rsItems->Fetch()) {
    $return[$item['ID']] = array(
        'ID' => $item['ID'],
        'NAME' => $item['NAME'],
        'PREVIEW_PICTURE' => \CFile::GetPath($item['PREVIEW_PICTURE']),
        'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
    );
}


?>


<div class="el-lech engBox-body">
    <div class="title">
        О лечении в городах КМВ
    </div>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <? foreach ($return as $item) {?>
            <li><a href="" class="item">
                    <div class="img">
                        <img src="<?=$item['PREVIEW_PICTURE']?>">
                    </div>
                    <div class="inf">
                        <b><?=$item['NAME']?></b>
                        <?=$item['NAME']?>
                        <p>
                            <?=$item['PREVIEW_TEXT']?>
                        </p>
                    </div>
                </a>
            </li>
            <?}?>
        </ul>
    </div>

    <div id="carousel" class="flexslider">
        <ul class="slides el-lech-page">
            <? foreach ($return as $item) {?>
                <li>
                    <div class="line">
                    </div>
                    <?=$item['NAME']?>
                </li>
            <?}?>
        </ul>
    </div>
</div>


