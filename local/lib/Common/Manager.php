<?
namespace Local\Common;
use Local\System\ExtCache;


/**
 * Class Manager Менеджеры
 * @package Local\Common
 */
class Manager
{
    const IBLOCK_ID = 30;
    const CACHE_TIME = 86400;
    /**
     * Путь для кеширования
     */
    const CACHE_PATH = 'Local/Common/Manager/';

    /**
     * Возвращает все санатории со свойствами, которые нужны для построения панели фильтров
     * @param bool|false $refreshCache
     * @return array
     */

    public static function getAll($refreshCache = false)
    {
        $extCache = new ExtCache(
            array(
                __FUNCTION__,
            ),
            static::CACHE_PATH . __FUNCTION__ . '/',
            static::CACHE_TIME
        );
        if(!$refreshCache && $extCache->initCache()) {
            $return = $extCache->getVars();
        } else {
            $extCache->startDataCache();

            $return = array();

            $iblockElement = new \CIBlockElement();
            $rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
                'IBLOCK_ID' => self::IBLOCK_ID,
                'ACTIVE' => 'Y',
            ), false, false, array(
                'ID',
                'NAME',
                'CODE',
                'PREVIEW_PICTURE',
                'PROPERTY_MANAGER_PHONE',
            ));
            while ($item = $rsItems->Fetch()) {
                $return[] = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'PICTURE' => $item['PREVIEW_PICTURE'],
                    'PHONE' => $item['CODE'],
                );
            }
            $extCache->endDataCache($return);
        }

        return $return;
    }

}

