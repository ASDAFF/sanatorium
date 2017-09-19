<?
namespace Local\Catalog;

/**
 * Class Programms Программы лечения
 * @package Local\Catalog
 */
class Programms
{

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 24;

	/**
	 * Возвращает программы по заданным ID
	 * @param $ids
	 * @return array
	 */
	public static function getByIds($ids)
	{
		$return = array();

		if (!$ids)
			return $return;

		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array(), array(
			'IBLOCK_ID' => self::IBLOCK_ID,
		    'ID' => $ids,
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
}