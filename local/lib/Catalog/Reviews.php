<?
namespace Local\Catalog;
use Local\System\ExtCache;


/**
 * Class Reviews Отзывы
 * @package Local\Catalog
 */
class Reviews
{
	/**
	 * Количество отзывов на странице
	 */
	const PAGE_SIZE = 12;

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 7;

	/**
	 * ID первого звездного варианта
	 */
	const STARS_ID = 132;

	/**
	 * Время кеширования
	 */
	const CACHE_TIME = 864000;

	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Reviews/';

	/**
	 * Возвращает отзывы
	 * @param $isService
	 * @param $cityId
	 * @param $page
	 * @param $size
	 * @param bool $refreshCache
	 * @return array|mixed
	 */
	public static function getList($isService, $cityId, $page, $size = 0, $refreshCache = false)
	{
		$return = array();

		$isService = intval($isService);

		$cityId = intval($cityId);

		$page = intval($page);
		if ($page < 1)
			$page = 1;

		if (!$size)
			$size = self::PAGE_SIZE;

		$extCache = new ExtCache(
			array(
				__FUNCTION__,
				$isService,
				$cityId,
				$page,
				$size,
			),
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$nav = array(
				'nPageSize' => $size,
				'iNumPage' => $page,
			);

			$filter = array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
				'PROPERTY_SERVICE' => $isService,
			);
			if ($cityId)
				$filter['PROPERTY_SANATORIUM_CITY'] = $cityId;

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList(array(
				'SORT' => 'ASC',
				'ID' => 'DESC'
			), $filter, false, $nav, array(
				'ID',
				'NAME',
				'PREVIEW_TEXT',
				'PROPERTY_SANATORIUM_ID',
				'PROPERTY_CITY',
				'PROPERTY_STARS',
				'PROPERTY_DATE',
			));
			while ($item = $rsItems->Fetch())
			{
				$return['ITEMS'][] = array(
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
                    'TEXT' => $item['PREVIEW_TEXT'],
                    'SANATORIUM' => $item['PROPERTY_SANATORIUM_ID_VALUE'],
                    'CITY' => $item['PROPERTY_CITY_VALUE'],
                    'STARS' => $item['PROPERTY_STARS_VALUE'],
                    'DATE' => $item['PROPERTY_DATE_VALUE'],
				);
			}
			$return['PAGINATION'] = $rsItems->GetPageNavStringEx($navComponentObject, '', 'reviews');

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает количество отзывов для каждого санатория
	 * @param bool $refreshCache
	 * @return array|\CIBlockResult|int|mixed
	 */
	public static function getCounts($refreshCache = false)
	{
		$return = array();

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

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList(array(), array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
				'PROPERTY_SERVICE' => 0,
			), array('PROPERTY_SANATORIUM_ID'));
			while ($item = $rsItems->Fetch())
			{
				$id = intval($item['PROPERTY_SANATORIUM_ID_VALUE']);
				if ($id)
					$return[$id] = intval($item['CNT']);
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает количество отзывов для санатория
	 * @param $sanatoriumId
	 * @return array|\CIBlockResult|int|mixed
	 */
	public static function getCountBySanatorium($sanatoriumId)
	{
		$counts = self::getCounts();
		return $counts[$sanatoriumId];
	}

	/**
	 * Возвращает отзывы о санатории
	 * @param $sanatoriumId
	 * @param bool $refreshCache
	 * @return array|mixed
	 */
	public static function getBySanatorium($sanatoriumId, $refreshCache = false)
	{
		$return = array();

		$sanatoriumId = intval($sanatoriumId);
		if (!$sanatoriumId)
			return $return;

		$extCache = new ExtCache(
			array(
				__FUNCTION__,
				$sanatoriumId,
			),
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList(array(), array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
				'PROPERTY_SERVICE' => 0,
				'PROPERTY_SANATORIUM_ID' => $sanatoriumId,
			), false, false, array(
				'ID',
				'NAME',
				'PREVIEW_TEXT',
				'PROPERTY_SANATORIUM_ID',
				'PROPERTY_CITY',
				'PROPERTY_STARS',
				'PROPERTY_DATE',
			));
			while ($item = $rsItems->Fetch())
			{
				$return['ITEMS'][] = array(
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'TEXT' => $item['PREVIEW_TEXT'],
					'SANATORIUM' => $item['PROPERTY_SANATORIUM_ID_VALUE'],
					'CITY' => $item['PROPERTY_CITY_VALUE'],
					'STARS' => $item['PROPERTY_STARS_VALUE'],
					'DATE' => $item['PROPERTY_DATE_VALUE'],
				);
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Добавление отзыва
	 * @return string (json encoded)
	 */
	public static function add()
	{
		$id = 0;

		$name = trim(htmlspecialchars($_POST['name']));
		$txt  = trim(htmlspecialchars($_POST['txt']));
		$city = trim(htmlspecialchars($_POST['city']));
		$mail = trim(htmlspecialchars($_POST['mail']));
		$mark = intval($_POST['mark']);
		$service = $_POST['service'] ? 1 : 0;
		$san = trim(htmlspecialchars($_POST['san']));

		$errors = array();

		//check fields
        if(empty($name))
            $errors[] = 'Введите имя';
        if(empty($txt))
            $errors[] = 'Введите текст отзыва';
        if(empty($mail))
            $errors[] = 'Введите E-mail';

		if (empty($errors))
		{
			$stars = 0;
			if ($mark >= 1 && $mark <= 5)
				$stars = $mark + self::STARS_ID - 1;
			$el = new \CIBlockElement();

			$date = ConvertTimeStamp();
			$fields = array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'NAME' => $name,
				'ACTIVE' => 'N',
				'PREVIEW_TEXT' => $txt,
				'PROPERTY_VALUES' => array(
					'CITY' => $city,
					'EMAIL' => $mail,
					'STARS' => $stars,
					'DATE' => $date,
					'SERVICE' => $service,
					'SANATORIUM' => $san,
				),
			);
			$id = $el->Add($fields);
			if ($id)
			{
				$eventFields = array(
					'NAME' => $name,
					'CITY' => $city,
					'EMAIL' => $mail,
					'STARS' => $mark,
					'DATE' => $date,
					'SERVICE' => $service ? 'да' : 'нет',
					'SANATORIUM' => $san,
				);
				\CEvent::Send('NEW_REVIEW', 's1', $eventFields);
			}
            else
                $errors[] = 'Ошибка добавления заявки. Свяжитесь с администрацией';
		}

        $gtm = new \WM\GTMFormSubmit();

        if(empty($errors))
        {
            return $gtm->getJson(array(
                'gtmObject' => $gtm->setEvent()->setElementId('review-form')->setElements(array($name, $mail, $txt))->getResult(),
                'id' => $id,
                'success' => true,
            ));
        }

        return $gtm->getJson(array(
            'errors' => $errors,
            'id' => $id,
            'success' => false,
        ));
	}

	/**
	 * обработчик изменения элемента - нужно обновить город санатория
	 * @param $id
	 */
	public static function onUpdate($id)
	{
		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array('SORT' => 'ASC'), array(
			'IBLOCK_ID' => self::IBLOCK_ID,
			'ID' => $id
		), false, false, array(
			'ID',
			'PROPERTY_SANATORIUM_ID',
			'PROPERTY_SANATORIUM_CITY',
		));
		if ($item = $rsItems->Fetch())
		{
			$sanId = $item['PROPERTY_SANATORIUM_ID_VALUE'];
			$cityId = 0;
			if ($sanId)
			{
				$san = Sanatorium::getSimpleById($sanId);
				$cityId = intval($san['CITY']);
			}

			if ($cityId != $item['PROPERTY_SANATORIUM_CITY_VALUE'])
			{
				$iblockElement->SetPropertyValuesEx($id, self::IBLOCK_ID, array(
					'SANATORIUM_CITY' => $cityId,
				));
			}

		}
	}
}

