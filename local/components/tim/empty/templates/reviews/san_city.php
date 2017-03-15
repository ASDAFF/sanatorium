<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$iblock_id = $_POST["iblock_id"];

CModule::IncludeModule('iblock');
$res = '';
$select = array(
    'ID',
    'NAME',
    'PREVIEW_TEXT',
    'PROPERTY_SAN_NAME',
    'PROPERTY_CITY',
    'PROPERTY_MARK',
    'PROPERTY_DATE',
);

$iblockElement = new \CIBlockElement();
$rsItems = $iblockElement->GetList(array(), array(
    'IBLOCK_ID' => 30,
    'SECTION_ID' => $iblock_id,
    'ACTIVE' => 'Y',
), false, false, $select);

while ($item = $rsItems->Fetch()) { ?>
    <div class="rev-item">
        <div class="rev-item-date"><?=$item['PROPERTY_DATE_VALUE']?></div>
        <div class="rev-item-about"><?=$item['PROPERTY_SAN_NAME_VALUE']?></div>
        <div class="rev-item-rate">
            <div class="mark">
                <?for ($i = 5; $i>=1; $i--) { ?>
                    <input type="radio" name="<?="mark-".$i?>" value="<?=$i?>" <?= ($i == $item['PROPERTY_MARK_VALUE']) ? "checked" : "" ?>/><label title="<?=$i?>"><?=$i?></label>
                <?}?>
            </div>
        </div>

        <div class="rev-item-txt">
            <?=$item['PREVIEW_TEXT']?>
        </div>
        <div class="rev-item-autor">
            <span class="rev-item-autor-name"><?=$item['NAME']?></span>
            <span class="rev-item-autor-city"><?=$item['PROPERTY_CITY_VALUE']?></span>
        </div>

    </div>
<? } ?>