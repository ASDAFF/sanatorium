<?

namespace Local\Catalog;

use Bitrix\Iblock\InheritedProperty\ElementValues;
use Local\Sale\Package;
use Local\Sale\Postals;
use Local\System\ExtCache;

/**
 * Class Sanatorium Санатории
 * @package Local\Catalog
 */
class Sanatorium
{
    const IBLOCK_ID = 21;
    const IB_ROOMS = 26;
    const CACHE_TIME = 86400;

    /**
     * Путь для кеширования
     */
    const CACHE_PATH = 'Local/Catalog/Sanatorium/';

    /**
     * Возвращает все санатории со свойствами, которые нужны для построения панели фильтров
     * @param bool|false $refreshCache
     * @return array
     */
    public static function getAll($count,$refreshCache = false)
    {
        $count_el = array();
        if(!empty($count)){
            $count_el = array("nTopCount" => $count);
        }
        $return = array();

        $extCache = new ExtCache(
            array(
                __FUNCTION__,
            ),
            static::CACHE_PATH . __FUNCTION__ . '/',
            static::CACHE_TIME
        );
        if (!$refreshCache && $extCache->initCache()) {
            $return = $extCache->getVars();
        } else {
            $extCache->startDataCache();

            $select = array(
                'ID',
                'NAME',
                'IBLOCK_SECTION_ID',
                'PROPERTY_PRICE',
                'PROPERTY_PROFILES',
                'PREVIEW_PICTURE',
                'CITY_NAME',
                'PROPERTY_PRICES',
                'PROPERTY_DISTANCE',
                'PROPERTY_INFRASTRUCTURES',
                'PROPERTY_PROGRAMMS',
                'PROPERTY_VIDEO',
                #'PROPERTY_FOOD',
                'PROPERTY_FOR_CHILD',
                'PROPERTY_FOOD1',
                'PROPERTY_SHARES',
                'PROPERTY_LINK_MAPS',
                'PROPERTY_ADDRESS',
            );
            $flagsSelect = Flags::getForSelect();
            $select = array_merge($select, $flagsSelect);
            $codes = Flags::getCodes();

            $iblockElement = new \CIBlockElement();
            $rsItems = $iblockElement->GetList(array(), array(
                'IBLOCK_ID' => self::IBLOCK_ID,
                'ACTIVE' => 'Y',
            ), false, $count_el, $select);
            while ($item = $rsItems->Fetch()) {
                $cityId = intval($item['IBLOCK_SECTION_ID']);
                $city = City::getById($cityId);
                $product = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'CITY' => intval($city['ID']),
                    'PROFILES' => $item['PROPERTY_PROFILES_VALUE'],
                    'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
                    'PREVIEW_PICTURE' => \CFile::GetPath($item['PREVIEW_PICTURE']),
                    'CITY_NAME' => $city['NAME'],
                    'PRICES' => $item['PROPERTY_PRICES_VALUE'],
                    'DISTANCE' => $item['PROPERTY_DISTANCE_VALUE'],
                    'INFRASTRUCTURES' => $item['PROPERTY_INFRASTRUCTURES_VALUE'],
                    'PROGRAMMS' => $item['PROPERTY_PROGRAMMS_VALUE'],
                    'VIDEO' => $item['PROPERTY_VIDEO_VALUE'],
                    #'FOOD' => $item['PROPERTY_FOOD_VALUE'],
                    'FOOD1' => $item['PROPERTY_FOOD1_VALUE'],
                    'FOR_CHILD' => $item['PROPERTY_FOR_CHILD_VALUE'],
                    'SHARES' => $item['PROPERTY_SHARES_VALUE'],
                    'LINK_MAPS' => $item['PROPERTY_LINK_MAPS_VALUE'],
                    'ADDRESS' => $item['PROPERTY_ADDRESS_VALUE'],
                );

                foreach ($codes as $code)
                    $product[$code] = intval($item['PROPERTY_' . $code . '_VALUE']);

                $return[$item['ID']] = $product;
            }

            $extCache->endDataCache($return);
        }

        return $return;
    }

    /**
     * Возвращает санаторий по ID
     * @param $id
     */
    public static function getSimpleById($id)
    {
        $all = self::getAll();
        return $all[$id];
    }

    /**
     * Возвращает данные по фильтру
     * (сначала получает все getAll - потом фильтрует)
     * @param $filter
     * @param bool|false $refreshCache
     * @return array
     */
    public static function getDataByFilter($filter, $refreshCache = false)
    {
        $return = array(
            'COUNT' => 0,
        );

        $extCache = new ExtCache(
            array(
                __FUNCTION__,
                $filter,
            ),
            static::CACHE_PATH . __FUNCTION__ . '/',
            static::CACHE_TIME
        );
        if (!$refreshCache && $extCache->initCache()) {
            $return = $extCache->getVars();
        } else {
            $extCache->startDataCache();

            $all = self::getAll($refreshCache);
            foreach ($all as $productId => $product) {
                $ok = true;
                foreach ($filter as $key => $value) {
                    if ($key == 'ID') {
                        if (!$value[$productId]) {
                            $ok = false;
                            break;
                        }
                    } elseif ($key == 'PRICE') {
                        if (isset($value['FROM']) && $product['PRICE'] < $value['FROM'] ||
                            isset($value['TO']) && $product['PRICE'] > $value['TO']
                        ) {
                            $ok = false;
                            break;
                        }
                    } elseif ($key == 'CITY') {
                        if (!$value[$product['CITY']]) {
                            $ok = false;
                            break;
                        }
                    } elseif ($key == 'PROFILE') {
                        $ex = false;
                        foreach ($product['PROFILES'] as $pr) {
                            if ($value[$pr]) {
                                $ex = true;
                                break;
                            }
                        }
                        if (!$ex) {
                            $ok = false;
                            break;
                        }
                    } else {
                        if (!$product[$key]) {
                            $ok = false;
                            break;
                        }
                    }

                }

                if ($ok) {
                    $return['COUNT']++;
                    $return['IDS'][] = $product['ID'];

                    if (!isset($return['PRICE']['MIN']) || $return['PRICE']['MIN'] > $product['PRICE'])
                        $return['PRICE']['MIN'] = $product['PRICE'];
                    if (!isset($return['PRICE']['MAX']) || $return['PRICE']['MAX'] < $product['PRICE'])
                        $return['PRICE']['MAX'] = $product['PRICE'];

                    if (!isset($return['CITY'][$product['CITY']]))
                        $return['CITY'][$product['CITY']] = 0;
                    $return['CITY'][$product['CITY']]++;

                    foreach ($product['PROFILES'] as $pr) {
                        if (!isset($return['PROFILES'][$pr]))
                            $return['PROFILES'][$pr] = 0;
                        $return['PROFILES'][$pr]++;
                    }

                    foreach (Flags::getCodes() as $code) {
                        if ($product[$code]) {
                            if (!isset($return[$code]))
                                $return[$code] = 0;
                            $return[$code]++;
                        }
                    }
                }
            }

            if ($filter['ID']) {
                $ids = array();
                foreach ($return['IDS'] as $id)
                    $ids[$id] = true;
                $res = array();
                foreach ($filter['ID'] as $id) {
                    if ($ids[$id])
                        $res[] = $id;
                }
                $return['IDS'] = $res;
            }

            $extCache->endDataCache($return);
        }

        return $return;
    }

    /**
     * Есть ли хоть один санаторий по фильтру?
     * @param $filter
     * @return bool
     */
    public static function exByFilter($filter)
    {
        $all = self::getAll();
        foreach ($all as $productId => $product) {
            $ok = true;
            foreach ($filter as $key => $value) {
                if ($key == 'CITY') {
                    if (!$value[$product['CITY']]) {
                        $ok = false;
                        break;
                    }
                } elseif ($key == 'PROFILE') {
                    $ex = false;
                    foreach ($product['PROFILE'] as $pr) {
                        if ($value[$pr]) {
                            $ex = true;
                            break;
                        }
                    }
                    if (!$ex) {
                        $ok = false;
                        break;
                    }
                } else {
                    if (!$product[$key]) {
                        $ok = false;
                        break;
                    }
                }
            }

            if ($ok)
                return true;
        }

        return false;
    }

    /**
     * Есть ли 3 санатория по фильтру?
     * @param $filter
     * @return bool
     */
    public static function ex3ByFilter($filter)
    {
        $all = self::getAll();
        $cnt = 0;
        foreach ($all as $productId => $product) {
            $ok = true;
            foreach ($filter as $key => $value) {
                if ($key == 'CITY') {
                    if (!$value[$product['CITY']]) {
                        $ok = false;
                        break;
                    }
                } elseif ($key == 'PROFILE') {
                    $ex = false;
                    foreach ($product['PROFILE'] as $pr) {
                        if ($value[$pr]) {
                            $ex = true;
                            break;
                        }
                    }
                    if (!$ex) {
                        $ok = false;
                        break;
                    }
                } else {
                    if (!$product[$key]) {
                        $ok = false;
                        break;
                    }
                }
            }

            if ($ok) {
                $cnt++;
                if ($cnt >= 3)
                    return true;
            }
        }

        return false;
    }

    /**
     * Возвращает санатории по фильтру. Сначала получаем айдишники товаров методом getSimpleByFilter
     * Результат уже должен быть закеширован (панелью фильтров)
     * @param $sort
     * @param $productIds
     * @param $nav
     * @param bool|false $refreshCache
     * @return array
     */
    public static function get($sort, $productIds, $nav, $refreshCache = false)
    {
        $return = array();

        $extCache = new ExtCache(
            array(
                __FUNCTION__,
                $sort,
                $productIds,
                $nav,
            ),
            static::CACHE_PATH . __FUNCTION__ . '/',
            static::CACHE_TIME
        );
        if (!$refreshCache && $extCache->initCache()) {
            $return = $extCache->getVars();
        } else {
            $extCache->startDataCache();

            if ($productIds) {
                $return['NAV'] = array(
                    'COUNT' => count($productIds),
                    'PAGE' => $nav['iNumPage'],
                );

                // В случае поиска - ручная пагинация
                if ($sort['SEARCH'] == 'asc' && $nav) {
                    $l = $nav['nPageSize'];
                    $offset = ($nav['iNumPage'] - 1) * $l;
                    $productIds = array_slice($productIds, $offset, $l);
                    $nav = false;
                }

                if (!isset($sort['ID']))
                    $sort['ID'] = 'DESC';

                // Товары
                $iblockElement = new \CIBlockElement();
                $rsItems = $iblockElement->GetList($sort, array(
                    '=ID' => $productIds,
                ), false, $nav, array(
                    'ID', 'NAME', 'CODE',
                    'PREVIEW_PICTURE',
                ));
                while ($item = $rsItems->GetNext()) {
                    $product = self::getSimpleById($item['ID']);

                    $ipropValues = new ElementValues(self::IBLOCK_ID, $item['ID']);
                    $iprop = $ipropValues->getValues();

                    $city = City::getById($product['CITY']);
                    $detail = self::getDetailUrl($item, $city['CODE']);

                    $product['NAME'] = $item['NAME'];
                    $product['PIC_ALT'] = $iprop['ELEMENT_PREVIEW_PICTURE_FILE_ALT'] ?
                        $iprop['ELEMENT_PREVIEW_PICTURE_FILE_ALT'] : $item['NAME'];
                    $product['PIC_TITLE'] = $iprop['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] ?
                        $iprop['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] : $item['NAME'];
                    $product['DETAIL_PAGE_URL'] = $detail;
                    $product['PREVIEW_PICTURE'] = \CFile::GetPath($item['PREVIEW_PICTURE']);

                    $return['ITEMS'][$item['ID']] = $product;
                }

                // Восстановление сортировки для поиска
                if ($sort['SEARCH'] == 'asc') {
                    $items = array();
                    foreach ($productIds as $id) {
                        if ($return['ITEMS'][$id])
                            $items[$id] = $return['ITEMS'][$id];
                    }
                    $return['ITEMS'] = $items;
                }
            }

            $extCache->endDataCache($return);
        }

        return $return;
    }

    /**
     * Возвращает ID санатория по коду
     * @param $code
     * @param bool|false $refreshCache
     * @return int|mixed
     */
    public static function getIdByCode($code, $refreshCache = false)
    {
        $return = 0;

        $extCache = new ExtCache(
            array(
                __FUNCTION__,
                $code,
            ),
            static::CACHE_PATH . __FUNCTION__ . '/',
            static::CACHE_TIME
        );
        if (!$refreshCache && $extCache->initCache()) {
            $return = $extCache->getVars();
        } else {
            $extCache->startDataCache();

            $iblockElement = new \CIBlockElement();
            $rsItems = $iblockElement->GetList(array(), array(
                'IBLOCK_ID' => self::IBLOCK_ID,
                '=CODE' => $code,
            ), false, false, array('ID'));
            if ($item = $rsItems->Fetch()) {
                $return = $item['ID'];
                $extCache->endDataCache($return);
            } else
                $extCache->abortDataCache();
        }

        return $return;
    }

    /**
     * Возвращает карточку санатория по коду
     * @param $code
     * @param bool|false $refreshCache
     * @return array|mixed
     */
    public static function getByCode($code, $refreshCache = false)
    {
        $id = self::getIdByCode($code, $refreshCache);
        if ($id)
            return self::getById($id, $refreshCache);
        else
            return array();
    }

    /**
     * Возвращает url карточки санатория
     * @param $item
     * @param $city
     * @return string
     */
    public static function getDetailUrl($item, $city)
    {
        return Filter::$CATALOG_PATH . $city . '/' . ($item['CODE'] ? $item['CODE'] : $item['ID']) . '/';
    }

    /**
     * Возвращает карточку санатория по ID
     * @param int $id
     * @param bool|false $refreshCache
     * @return array|mixed
     */
    public static function getById($id, $refreshCache = false)
    {
        $return = array();

        $id = intval($id);
        if (!$id)
            return $return;

        $extCache = new ExtCache(
            array(
                __FUNCTION__,
                $id,
            ),
            static::CACHE_PATH . __FUNCTION__ . '/',
            static::CACHE_TIME
        );
        if (!$refreshCache && $extCache->initCache()) {
            $return = $extCache->getVars();
        } else {
            $extCache->startDataCache();

            $iblockElement = new \CIBlockElement();
            $filter = array(
                'IBLOCK_ID' => self::IBLOCK_ID,
                'ID' => $id,
            );
            $select = array(
                'ID', 'NAME', 'CODE', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'DETAIL_TEXT',
                'PROPERTY_PHOTOS',
            );
            $rsItems = $iblockElement->GetList(array(), $filter, false, false, $select);
            if ($item = $rsItems->GetNext()) {
                $product = self::getSimpleById($item['ID']);

                $city = City::getById($product['CITY']);
                $detail = self::getDetailUrl($item, $city['CODE']);
                $ipropValues = new ElementValues(self::IBLOCK_ID, $item['ID']);
                $iprop = $ipropValues->getValues();
                $title = $iprop['ELEMENT_META_TITLE'] ? $iprop['ELEMENT_META_TITLE'] :
                    $item['NAME'] . ' - (здесь будет шаблон для заголовка)';
                $desc = $iprop['ELEMENT_META_DESCRIPTION'] ? $iprop['ELEMENT_META_DESCRIPTION'] :
                    'Шаблон для описания ' . $item['NAME'] . '. (шаблон)';
                $pictures = array();
                $file = new \CFile();
                foreach ($item['PROPERTY_PHOTOS_VALUE'] as $picId)
                    $pictures[] = $file->GetPath($picId);
                $offers = self::getRooms($item['ID']);
                $return = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'TITLE' => $title,
                    'DESCRIPTION' => $desc,
                    'CODE' => $item['CODE'],
                    'DETAIL_PAGE_URL' => $detail,
                    'PREVIEW_PICTURE' => $file->GetPath($item['PREVIEW_PICTURE']),
                    'PREVIEW_TEXT' => $item['~PREVIEW_TEXT'],
                    'DETAIL_TEXT' => $item['~DETAIL_TEXT'],
                    'CITY' => $city,
                    'PICTURES' => $pictures,
                    'PRODUCT' => $product,
                    'OFFERS' => $offers,
                );

                $extCache->endDataCache($return);
            } else
                $extCache->abortDataCache();

        }

        return $return;
    }

    /**
     * Возвращает номера санатория
     * @param $productId
     * @return array
     */
    public static function getRooms($productId)
    {
        $return = array();

        $iblockElement = new \CIBlockElement();
        $rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
            'IBLOCK_ID' => self::IB_ROOMS,
            'PROPERTY_SANATORIUM' => $productId,
            'ACTIVE' => 'Y',
        ), false, false, array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'PROPERTY_PRICE',
        ));
        while ($item = $rsItems->Fetch()) {
            $return[$item['ID']] = array(
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
            );
        }

        return $return;
    }

    public static function getRoomsByPrice($sanatoriumId)
    {
        $return = array();

        $iblockElement = new \CIBlockElement();
        $rsItems = $iblockElement->GetList(array('property_PRICES' => 'ASC'), array(
            'IBLOCK_ID' => self::IB_ROOMS,
            'PROPERTY_SANATORIUM' => $sanatoriumId,
            'ACTIVE' => 'Y',
        ), false, Array("nTopCount" => 1), array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'PROPERTY_PRICE',
            'PROPERTY_PROFILES',
        ));
        while ($item = $rsItems->Fetch()) {
            $return[$item['ID']] = array(
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
                'PROFILES' => $item['PROPERTY_PROFILES_VALUE'],
                'IBLOCK_ID' => $item['IBLOCK_ID'],
            );
        }

        return $return;
    }


    public static function getMinPriceRooms($roomsId)
    {
        $return = array();

        $iblockElement = new \CIBlockElement();
        $rsItems = $iblockElement->GetList(array('property_PRICE' => 'ASC'), array(
            'IBLOCK_ID' => self::IB_ROOMS,
            'ID' => $roomsId,
            'ACTIVE' => 'Y',
        ), false, Array("nTopCount" => 1), array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'PROPERTY_PRICE',
        ));
        while ($item = $rsItems->Fetch()) {
            $return[] = array(
                'ID' => $item['ID'],
                'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
            );
        }

        return $return;
    }

    public static function getInfo($count, $id)
    {
        $return = array();
        $count_el = array();

        if (!empty($count)) {
            $count_el = array("nTopCount" => $count);
        }

        $iblockElement = new \CIBlockElement();
        $rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
            'IBLOCK_ID' => 34,
            'ID' => $id,
            'ACTIVE' => 'Y',
        ), false, $count_el, array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'PREVIEW_PICTURE',
        ));
        while ($item = $rsItems->GetNext()) {
            $return[] = array(
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'PREVIEW_PICTURE' => \CFile::GetPath($item['PREVIEW_PICTURE']),
            );
        }

        return $return;
    }

    public static function getParam($id)
    {
        $return = array();

        $iblockElement = new \CIBlockElement();
        $rsItems = $iblockElement->GetList(array(), array(
            'IBLOCK_ID' => 24,
            'ID' => $id,
            'ACTIVE' => 'Y',
        ), false, array(), array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'DETAIL_TEXT',
            'PREVIEW_TEXT',

        ));
        while ($item = $rsItems->GetNext()) {
            $return[] = array(
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'DETAIL_TEXT' => $item['DETAIL_TEXT'],
                'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
            );
        }

        return $return;
    }
    public static function getShares($id)
    {
        $return = array();

        $iblockElement = new \CIBlockElement();
        $rsItems = $iblockElement->GetList(array(), array(
            'IBLOCK_ID' => 9,
            'ID' => $id,
            'ACTIVE' => 'Y',
        ), false, array(), array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'PROPERTY_PERIOD',
            'PREVIEW_TEXT',
            'DETAIL_TEXT',

        ));
        while ($item = $rsItems->GetNext()) {
            $return[] = array(
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'DETAIL_TEXT' => $item['DETAIL_TEXT'],
                'PROPERTY_PERIOD_VALUE' => $item['PROPERTY_PERIOD_VALUE'],
                'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
            );
        }

        return $return;
    }

    public static function getRo($id)
    {
        $return = array();

        $iblockElement = new \CIBlockElement();
        $rsItems = $iblockElement->GetList(array(), array(
            'IBLOCK_ID' => 26,
            'ID' => $id,
            'ACTIVE' => 'Y',
        ), false, array(), array(
            'ID',
            'NAME',
            'IBLOCK_ID',
            'PREVIEW_PICTURE',
            'PROPERTY_ROOM_SIZE',
            'PROPERTY_SINGLE_BED',
            'PROPERTY_DOUBLE_BED',
            'PROPERTY_PRICE',
            'PROPERTY_MORE_PHOTO',
            'PROPERTY_MAIN_PLACES',
            'PROPERTY_ADD_PLACES',
            'PROPERTY_PRICE_FULL',
            'PROPERTY_CHILD_PLACES_PRICE',
            'PROPERTY_PLACES_PRICE',
        ));
        while ($item = $rsItems->GetNext()) {
            $return[] = array(
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'PREVIEW_PICTURE' => \CFile::GetPath($item['PREVIEW_PICTURE']),
                'ROOM_SIZE' => $item['PROPERTY_ROOM_SIZE_VALUE'],
                'SINGLE_BED' => $item['PROPERTY_SINGLE_BED_VALUE'],
                'DOUBLE_BED' => $item['PROPERTY_DOUBLE_BED_VALUE'],
                'PRICE' => $item['PROPERTY_PRICE_VALUE'],
                'MORE_PHOTO' => $item['PROPERTY_MORE_PHOTO_VALUE'],
                'EXTRA' => $item['PROPERTY_EXTRA_VALUE'],
                'MAIN_PLACES' => $item['PROPERTY_MAIN_PLACES_VALUE'],
                'ADD_PLACES' => $item['PROPERTY_ADD_PLACES_VALUE'],
                'PRICE_FULL' => $item['PROPERTY_PRICE_FULL_VALUE'],
                'CHILD_PLACES_PRICE' => $item['PROPERTY_CHILD_PLACES_PRICE_VALUE'],
                'PROPERTY_PLACES_PRICE' => $item['PROPERTY_PLACES_PRICE_VALUE'],
            );
        }

        return $return;
    }

    /**
     * Увеличивает счетчики просмотров товара
     * @param $productId
     */
    public static function viewedCounters($productId)
    {
        \CIBlockElement::CounterInc($productId);
    }

    /**
     * Формирует поисковый контент для санатория
     * (добавляет город в заголовок и профили лечения в текст)
     * @param $arFields
     * @return mixed
     */
    public static function beforeSearchIndex($arFields)
    {
        $productId = intval($arFields['ITEM_ID']);
        if ($productId && array_key_exists('BODY', $arFields)) {
            $product = self::getSimpleById($productId);
            if ($product) {
                // Название города в заголовок
                $city = City::getById($product['CITY']);
                $arFields['TITLE'] .= ' ' . $city['NAME'];

                // Профили лечения в тело
                foreach ($product['PROFILES'] as $pid) {
                    $pr = Profiles::getById($pid);
                    $arFields['BODY'] .= ' ' . $pr['NAME'];
                }

                // Флаги в тело
                $flags = Flags::getAll();
                foreach ($flags as $group)
                    foreach ($group as $item)
                        if ($product[$item['CODE']])
                            $arFields['BODY'] .= ' ' . $item['NAME'];
            }
        }

        return $arFields;
    }

    public static function printTab($sanatorium, $tabCode)
    {
        if ($tabCode == 'main') {
            ?>
            Содержимое первой вкладки<?
        } elseif ($tabCode == 't2') {
            ?>
            Содержимое второй вкладки<?
        } elseif ($tabCode == 't3') {
            ?>
            Содержимое третьей вкладки<?
        } elseif ($tabCode == 't4') {
            ?>
            Содержимое четвертой вкладки<?
        }

    }

    /**
     * Очищает кеш каталога
     */
    public static function clearCatalogCache()
    {
        $phpCache = new \CPHPCache();
        $phpCache->CleanDir(static::CACHE_PATH . 'getAll');
        $phpCache->CleanDir(static::CACHE_PATH . 'getDataByFilter');
        $phpCache->CleanDir(static::CACHE_PATH . 'get');
        $phpCache->CleanDir(static::CACHE_PATH . 'getById');
    }

}

