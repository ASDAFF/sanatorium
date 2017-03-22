<?
namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class Shares акции карточки
 * @package Local\Catalog
 */
class Shares
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Shares/';

	/**
	 * Возвращает акции
	 * @param bool|false $refreshCache
	 * @return array
	 */
	public static function getAll($refreshCache = false)
	{
		$return = array();

		$extCache = new ExtCache(
			array(
				__FUNCTION__,
			),
			static::CACHE_PATH . __FUNCTION__ . '/',
			86400000
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

            $iblockElement = new \CIBlockElement();
            $rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
                'IBLOCK_ID' => 33,
                'ACTIVE' => 'Y',
            ), false, Array("nTopCount" => 4), array(
                'ID',
                'NAME',
                'IBLOCK_ID',
                'PREVIEW_PICTURE',
            ));
            while ($item = $rsItems->Fetch()) {
                $return[$item['ID']] = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'PREVIEW_PICTURE' => \CFile::GetPath($item['PREVIEW_PICTURE']),
                );
            }

			$extCache->endDataCache($return);
		}

		return $return;
	}
}