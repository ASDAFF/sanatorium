<?

namespace Local\Catalog;

use Bitrix\Iblock\InheritedProperty\ElementValues;
use Local\System\ExtCache;

/**
 * Class Sanatorium Санатории
 * @package Local\Catalog
 */
class Sanatorium
{
    const IBLOCK_ID = 21;
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
    public static function getAll($refreshCache = false)
    {
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
                'PROPERTY_INFRASTRUCTURE',
            );
            $flagsSelect = Flags::getForSelect();
            $select = array_merge($select, $flagsSelect);
            $codes = Flags::getCodes();

            $iblockElement = new \CIBlockElement();
            $rsItems = $iblockElement->GetList(array(), array(
                'IBLOCK_ID' => self::IBLOCK_ID,
                'ACTIVE' => 'Y',
            ), false, false, $select);
            while ($item = $rsItems->Fetch()) {
                $cityId = intval($item['IBLOCK_SECTION_ID']);
                $city = City::getById($cityId);
                $product = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'CITY' => intval($city['ID']),
                    'PROFILES' => $item['PROPERTY_PROFILES_VALUE'],
                    'INFRA' => $item['PROPERTY_INFRASTRUCTURE_VALUE'],
                    'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
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
	 * @return mixed
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

		$extCache = new ExtCache(array(
				__FUNCTION__,
				$filter,
			), static::CACHE_PATH . __FUNCTION__ . '/', static::CACHE_TIME);
		if (!$refreshCache && $extCache->initCache())
		{
			$return = $extCache->getVars();
		}
		else
		{
			$extCache->startDataCache();

			$all = self::getAll($refreshCache);
			foreach ($all as $productId => $product)
			{
				$ok = true;
				foreach ($filter as $key => $value)
				{
					if ($key == 'ID')
					{
						if (!$value[$productId])
						{
							$ok = false;
							break;
						}
					}
					elseif ($key == 'PRICE')
					{
						if (isset($value['FROM']) && $product['PRICE'] < $value['FROM'] ||
							isset($value['TO']) && $product['PRICE'] > $value['TO'])
						{
							$ok = false;
							break;
						}
					}
					elseif ($key == 'CITY')
					{
						if (!$value[$product['CITY']])
						{
							$ok = false;
							break;
						}
					}
					elseif ($key == 'PROFILE')
					{
						$ex = false;
						foreach ($product['PROFILES'] as $pr)
						{
							if ($value[$pr])
							{
								$ex = true;
								break;
							}
						}
						if (!$ex)
						{
							$ok = false;
							break;
						}
					}
					elseif ($key == 'INFRA')
					{
						foreach ($product['INFRA'] as $infra)
							if (isset($value[$infra]))
								unset($value[$infra]);
						if (count($value))
						{
							$ok = false;
							break;
						}
					}
					else
					{
						if (!$product[$key])
						{
							$ok = false;
							break;
						}
					}

				}

				if ($ok)
				{
					$return['COUNT']++;
					$return['IDS'][] = $product['ID'];

					if (!isset($return['PRICE']['MIN']) || $return['PRICE']['MIN'] > $product['PRICE'])
						$return['PRICE']['MIN'] = $product['PRICE'];
					if (!isset($return['PRICE']['MAX']) || $return['PRICE']['MAX'] < $product['PRICE'])
						$return['PRICE']['MAX'] = $product['PRICE'];

					if (!isset($return['CITY'][$product['CITY']]))
						$return['CITY'][$product['CITY']] = 0;
					$return['CITY'][$product['CITY']]++;

					foreach ($product['PROFILES'] as $pr)
					{
						if (!isset($return['PROFILES'][$pr]))
							$return['PROFILES'][$pr] = 0;
						$return['PROFILES'][$pr]++;
					}
					foreach ($product['INFRA'] as $infra)
					{
						if (!isset($return['INFRA'][$infra]))
							$return['INFRA'][$infra] = 0;
						$return['INFRA'][$infra]++;
					}

					foreach (Flags::getCodes() as $code)
					{
						if ($product[$code])
						{
							if (!isset($return[$code]))
								$return[$code] = 0;
							$return[$code]++;
						}
					}
				}
			}

			if ($filter['ID'])
			{
				$ids = array();
				foreach ($return['IDS'] as $id)
					$ids[$id] = true;
				$res = array();
				foreach ($filter['ID'] as $id)
				{
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

            $return['NAV'] = array(
                'COUNT' => count($productIds), // Если массив айдишников пустой - то нам и не пригодится это поле
                'PAGE' => $nav['iNumPage'],
            );

            // В случае поиска - ручная пагинация
	        $manualSort = false;
	        if ($sort['SEARCH'] == 'asc' && $nav && $productIds)
	        {
		        $l = $nav['nPageSize'];
		        $offset = ($nav['iNumPage'] - 1) * $l;
		        $productIds = array_slice($productIds, $offset, $l);
		        $nav = false;
		        $manualSort = true;
		        $sort = array();
	        }

	        if (!$manualSort && !isset($sort['ID']))
		        $sort['ID'] = 'DESC';

	        $filter = array(
		        'IBLOCK_ID' => self::IBLOCK_ID,
		        'ACTIVE' => 'Y',
	        );
	        if ($productIds)
		        $filter['=ID'] = $productIds;

            // Товары
            $iblockElement = new \CIBlockElement();
            $rsItems = $iblockElement->GetList($sort, $filter, false, $nav, array(
                'ID', 'NAME', 'CODE',
                'PREVIEW_PICTURE',
                'PROPERTY_DISTANCE',
                'PROPERTY_ROOMS_COUNT',
                'PROPERTY_RATING',
                'PROPERTY_YMAP',
				'PROPERTY_NEW_YEAR_TAB'
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
                $product['PREVIEW_PICTURE'] = $item['PREVIEW_PICTURE'];
                $product['DISTANCE'] = $item['PROPERTY_DISTANCE_VALUE'];
                $product['ROOMS_COUNT'] = $item['PROPERTY_ROOMS_COUNT_VALUE'];
                $product['YMAP'] = $item['PROPERTY_YMAP_VALUE'];
                $product['RATING'] = round($item['PROPERTY_RATING_VALUE'] / 2) / 10;
                $product['NEW_YEAR_TAB'] = $item['~PROPERTY_NEW_YEAR_TAB_VALUE']['TEXT'];

                $return['ITEMS'][$item['ID']] = $product;
            }

            // Восстановление сортировки
	        if ($manualSort)
	        {
		        $items = array();
		        foreach ($productIds as $id)
		        {
			        if ($return['ITEMS'][$id])
				        $items[$id] = $return['ITEMS'][$id];
		        }
		        $return['ITEMS'] = $items;
	        }
	        else
		        $return['PAGINATION'] = $rsItems->GetPageNavStringEx($navComponentObject, '', 'reviews');

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
        //return Filter::$CATALOG_PATH . $city . '/' . ($item['CODE'] ? $item['CODE'] : $item['ID']) . '/';
        $host = \COption::GetOptionInt('main', 'server_name');
        return 'https://' . $item['CODE'] . '.' . $host . '/';
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
            static::CACHE_PATH . __FUNCTION__ . '2/',
            static::CACHE_TIME
        );
        if (!$refreshCache && $extCache->initCache()) {
            $return = $extCache->getVars();
        } else {
            $extCache->startDataCache();

            $seoProps = array('MAIN', 'ROOMS', 'PROGRAMMS', 'INFRA', 'CHILD', 'VIDEO', 'ACTION', 'DOCS', 'REVIEWS', 'MAP','RESERVATION');
            $seoPos = array('TITLE', 'DESCR', 'KW');

            $iblockElement = new \CIBlockElement();
            $filter = array(
                'IBLOCK_ID' => self::IBLOCK_ID,
                'ID' => $id,
            );
            $select = array(
                'ID', 'NAME', 'CODE', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'DETAIL_TEXT',
                'PROPERTY_PHOTOS',
                'PROPERTY_ADDRESS',
                'PROPERTY_PROGRAMMS',
                'PROPERTY_RATING',
                'PROPERTY_FEEDING_TAB',
                'PROPERTY_CHILD_TAB',
                'PROPERTY_NEW_YEAR_TAB',
                'PROPERTY_VIDEO',
                'PROPERTY_YMAP',
                'PROPERTY_PRICE_PDF',
				'PROPERTY_SEO_MAIN_TITLE',
				'PROPERTY_SEO_MAIN_DESCR',
				'PROPERTY_SEO_MAIN_KW',
				'PROPERTY_SEO_ROOMS_TITLE',
				'PROPERTY_SEO_ROOMS_DESCR',
				'PROPERTY_SEO_ROOMS_KW',
				'PROPERTY_SEO_PROGRAMMS_TITLE',
				'PROPERTY_SEO_PROGRAMMS_DESCR',
				'PROPERTY_SEO_PROGRAMMS_KW',
				'PROPERTY_SEO_INFRA_TITLE',
				'PROPERTY_SEO_INFRA_DESCR',
				'PROPERTY_SEO_INFRA_KW',
				'PROPERTY_SEO_CHILD_TITLE',
				'PROPERTY_SEO_CHILD_DESCR',
				'PROPERTY_SEO_CHILD_KW',
				'PROPERTY_SEO_VIDEO_TITLE',
				'PROPERTY_SEO_VIDEO_DESCR',
				'PROPERTY_SEO_VIDEO_KW',
				'PROPERTY_SEO_ACTION_TITLE',
				'PROPERTY_SEO_ACTION_DESCR',
				'PROPERTY_SEO_ACTION_KW',
				'PROPERTY_SEO_DOCS_TITLE',
				'PROPERTY_SEO_DOCS_DESCR',
				'PROPERTY_SEO_DOCS_KW',
				'PROPERTY_SEO_REVIEWS_TITLE',
				'PROPERTY_SEO_REVIEWS_DESCR',
				'PROPERTY_SEO_REVIEWS_KW',
				'PROPERTY_SEO_MAP_TITLE',
				'PROPERTY_SEO_MAP_DESCR',
				'PROPERTY_SEO_MAP_KW',
            );
            $rsItems = $iblockElement->GetList(array(), $filter, false, false, $select);
            if ($item = $rsItems->GetNext())
            {
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
	            foreach ($item['PROPERTY_PHOTOS_VALUE'] as $picId)
                    $pictures[] = $picId;
                $rooms = Room::getBySanatorium($item['ID']);
	            $programms = Programms::getByIds($item['PROPERTY_PROGRAMMS_VALUE']);
	            $seo = array();
	            foreach ($seoProps as $prop)
					foreach ($seoPos as $pos)
						$seo[$prop][$pos] = $item['PROPERTY_SEO_' . $prop . '_' . $pos . '_VALUE'];

                $return = array(
                    'ID' => $item['ID'],
                    'NAME' => $item['NAME'],
                    'TITLE' => $title,
                    'DESCRIPTION' => $desc,
                    'CODE' => $item['CODE'],
                    'DETAIL_PAGE_URL' => $detail,
                    'PREVIEW_TEXT' => $item['~PREVIEW_TEXT'],
                    'DETAIL_TEXT' => $item['~DETAIL_TEXT'],
                    'ADDRESS' => $item['PROPERTY_ADDRESS_VALUE'],
                    'YMAP' => $item['PROPERTY_YMAP_VALUE'],
                    'RATING' => round($item['PROPERTY_RATING_VALUE'] / 2) / 10,
                    'FEEDING_TAB' => $item['~PROPERTY_FEEDING_TAB_VALUE']['TEXT'],
                    'CHILD_TAB' => $item['~PROPERTY_CHILD_TAB_VALUE']['TEXT'],
                    'NEW_YEAR_TAB' => $item['~PROPERTY_NEW_YEAR_TAB_VALUE']['TEXT'],
                    'VIDEO' => $item['~PROPERTY_VIDEO_VALUE'],
                    'PRICE_PDF' => $item['PROPERTY_PRICE_PDF_VALUE'],
                    'CITY' => $city,
                    'PICTURES' => $pictures,
                    'PRODUCT' => $product,
                    'ROOMS' => $rooms,
                    'PROGRAMMS' => $programms,
					'SEO' => $seo,
                );

                $extCache->endDataCache($return);
            }
            else
                $extCache->abortDataCache();

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
        if ($tabCode == 'main')
        {
	        echo $sanatorium['DETAIL_TEXT'];

			?>
            <div class="programs"><noindex><?
			foreach ($sanatorium['PRODUCT']['PROFILES'] as $pr)
			{
				$profile = Profiles::getById($pr);
				?>
                <div class="programs-item">
                <div class="programs-title"><span class="icon icon-<?= $profile['CODE']
					?>"></span><span><?= $profile['NAME'] ?></span></div>
                <ul class="programs-list"><?

					foreach ($profile['SUBITEMS'] as $item)
					{
						?>
                        <li><?= $item ?></li><?
					}
					?>
                </ul>
                </div><?
			}
			?>
			</noindex></div><?

			echo $sanatorium['FEEDING_TAB'];

			?>
			<a href="javascript:void(0);" id="content-top">Местоположение: <span itemprop="address"><?= $sanatorium['ADDRESS'] ?></span></a>
			<script type="text/javascript">var yMapPoint = [<?= $sanatorium['YMAP'] ?>];</script>
			<div id="dmap" style="width:100%; height:500px"></div><?
            // *  Форма
            if(isset($_GET['test'])): ?>
                <div class="block__form">
                    <div class="block__form__left">
                        На этой старнице вы можете расчитать стоимость
                    </div>
                    <div class="block__form__right">
                        <form class="calculator" id="price-form">
                            <input type="hidden" name="san" value="<?= $product['ID'] ?>" />
                            <div class="form-title" style="margin-top:10px;">
                                <span class="form-title-first" style="font-size:20px; padding-top:10px;">Введите свои данные</span>
                                <span class="form-title-second">чтобы узнать стоимость путевки</span>
                            </div>
                            <div class="first-person" style="padding-top: 10px">
                                <div class="form-body float-body">
                                    <div class="float-block">
                                        <div class="who-you-are">
                                            <div class="number-type"><span>Возраст </span>
                                                <div class="list-input calc-form form-body-right">
                                                    <select name="age[]" class="form-body-right js-age"><?
                                                        foreach ($ages as $code => $age)
                                                        {
                                                            ?>
                                                            <option value="<?= $code ?>"><?= $age ?></option><?
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="number-type">
                                                <span>Размещение </span>
                                                <div class="list-input calc-form form-body-right">
                                                    <select name="place[]" class="form-body-right js-place">
                                                        <option value="M">На основном месте</option>
                                                        <option value="A">На дополнительном месте</option>
                                                        <option value="F">Весь номер</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="number-type first-number-type">
                                                <span>Программа </span>
                                                <div class="list-input calc-form form-body-right">
                                                    <select name="programm[]" class="form-body-right js-programm">
                                                        <option value="0">(выберите программу)</option><?
                                                        foreach ($product['PROGRAMMS'] as $pr)
                                                        {
                                                            ?>
                                                            <option value="<?= $pr['ID'] ?>"><?= $pr['NAME'] ?></option><?
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="delete-user">
                            <span class="people-delete"><span>Удалить</span><img src="/images/calc/people.png"><img
                                        src="/images/calc/minus.png"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="calendar">
                                    <div class="left-block">
                                        Дата заезда<br>
                                        <input name="date_on" type="text" class="data-form-input" placeholder="дд.мм.гг" id="datepicker">
                                    </div>
                                    <div class="middle-block">
                                        <img src="/images/calc/strelka.png">
                                    </div>
                                    <div class="right-block">
                                        Дата выезда<br>
                                        <input name="date_off" type="text" class="data-form-input" placeholder="дд.мм.гг" id="datepicker2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="number-type"><span>Тип номера </span>
                                    <div class="list-input calc-form form-body-right">
                                        <select name="room[]" class="form-body-right js-room">
                                            <option value="0">(выберите номер)</option><?
                                            foreach ($product['ROOMS'] as $room)
                                            {
                                                $selected = ($room['ID'] == $component->room['ID']) ? ' selected="selected"' : '';
                                                ?>
                                                <option value="<?= $room['ID'] ?>"<?= $selected ?>><?= $room['NAME'] ?></option><?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="number-type">
                                    <img src="/images/calc/people.png">
                                    <input class="selector" type="number" id="count-people" min="1" max="6" value="1" />
                                </div>
                            </div>
                            <div class="other-persons"></div>

                            <div class="form-footer"><?

                                //
                                // Тут показываем результат
                                //
                                ?>
                                <div class="form-footer-title">
                                    <small class="js-persons"></small>
                                    <br>
                                    <span class="js-sum"></span>
                                </div><?

                                ?>
                                <div class="form-footer-body" style="margin: 5px 0 0;">
                                    <input name="name" class="selector" placeholder="Введите имя" required />
                                    <br>
                                    <input name="phone" id="numb-phone" class="selector" placeholder="Введите телефон" required />
                                </div>
                                <div class="confidentiality">
                                    <label>
                                        <input type="checkbox" onclick="$('#sub_form').toggleClass('unchecked')" required />
                                    </label>Настоящим подтверждаю, что я ознакомлен и согласен с условиями
                                    <a href="<?= P_HREF ?>/upload/conf.docx">политики конфиденциальности</a>
                                </div>
                                <div class="form-submit">
                                    <button id="calc-submit" type="submit">
                                        <div class="form-submit-text" style="padding:18px 5px 18px 35px;">
                                            Узнать цену
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div id="reserve-results" class="okno" style="display:none;"></div>
                        </form>
                    </div>
                </div>
            <? endif; ?>
            <?
        }
        elseif ($tabCode == 'rooms')
        {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/prices/' . $sanatorium['CODE'] . '/';
            $files = scandir($path);
            $priceFilename = '';
            foreach ($files as $filename)
            {
                if ($filename != '.' && $filename != '..')
                {
					$priceFilename = $filename;
					break;
                }
            }
			if ($priceFilename)
			{
				?>
                <div>
                    <div class="elPriceDocumentBtn">Посмотреть цены с учетом сезонности и программы лечения можно <a
                                href="/<?= $sanatorium['CODE'] ?>/<?= $priceFilename ?>" target="_blank">здесь</a></div>
                </div><?
			}

			foreach ($sanatorium['ROOMS'] as $room)
				Room::printRoom($room, $sanatorium['NAME']);
        }
        elseif ($tabCode == 'profiles')
        {

        }
        elseif ($tabCode == 'programms')
        {
			?>
	        <div class="posts"><?
		        foreach ($sanatorium['PROGRAMMS'] as $pr)
		        {
			        ?>
			        <div class="item">
				        <div class="title"><?= $pr['NAME'] ?></div>
				        <div class="text preview-text">
					        <div class="preview-text-inner"><?= $pr['PREVIEW_TEXT'] ?></div>
					        <a href="#">Подробнее</a>
				        </div>
				        <div class="text okno detail-text hidden" style="display: none;">
					        <?= $pr['DETAIL_TEXT'] ?>
				        </div>
			        </div><?
		        }
		        ?>
	        </div><?
        }
        elseif ($tabCode == 'infra')
        {
	        $items = array();
	        $i = 0;
	        $buvet = false;
	        foreach ($sanatorium['PRODUCT']['INFRA'] as $infra)
	        {
		        $item = Infra::getById($infra);
		        if (!$item)
		            continue;

		        $name = $item['NAME'];
		        if ($item['CODE'] == 'buvet')
		        {
			        $buvet = true;
			        if ($sanatorium['DISTANCE'])
				        $name = 'Расстояние до бювета: ' . $sanatorium['DISTANCE'] . 'м';
		        }


		        $k = $i % 3;
		        $items[$k][$item['CODE']] = $name;
		        $i++;
	        }
	        if (!$buvet && $sanatorium['DISTANCE'])
		        $items[$i % 3]['buvet'] = 'Расстояние до бювета: ' . $sanatorium['DISTANCE'] . 'м';

	        ?>
	        <h2>Инфраструктура</h2>
	        <div class="infra-box"><?
		        foreach ($items as $column)
		        {
			        ?>
			        <ul class="infra-list"><?
				        foreach ($column as $code => $name)
				        {
					        ?>
					        <li><i class="in-icon icon-<?= $code ?>"></i><span><?= $name ?></span></li><?
				        }
			            ?>
			        </ul>
                    <?
		        }
				?>
	        </div><?
        }
        elseif ($tabCode == 'feed')
        {

        }
        elseif ($tabCode == 'child')
        {
	        echo $sanatorium['CHILD_TAB'];
        }
		elseif ($tabCode == 'newyear')
		{
			?><noindex><?= $sanatorium['NEW_YEAR_TAB'] ?></noindex><?
		}
        elseif ($tabCode == 'video')
        {
			foreach ($sanatorium['VIDEO'] as $video)
			{
				?>
				<div class="card-video"><?= $video ?></div><?
			}
        }elseif ($tabCode == 'reservation')
        {
			?><div></div><?
        }
        elseif ($tabCode == 'action')
        {
	        $actions = Action::getBySanatorium($sanatorium['ID']);
			?>
	        <div class="tab-actions"><?
	            foreach ($actions as $item)
	            {
		            ?>
		            <div class="tab-actions-item">
			            <div class="tab-actions-title"><?= $item['NAME'] ?></div><?
			            $period = '';
			            if ($item['ACTIVE_FROM'])
				            $period .= ' с ' . $item['ACTIVE_FROM'];
			            if ($item['ACTIVE_TO'])
				            $period .= ' по ' . $item['ACTIVE_TO'];
			            if ($period)
			            {
				            ?>
				            <div class="tab-actions-time"><b>Период действия:</b> <span><?= $period ?></span></div><?
			            }
		                ?>
			            <div class="tab-actions-descr">
				            <b>Описание акции:</b>
				            <?= $item['TEXT'] ?>
			            </div>
		            </div><?
	            }
		        ?>
	        </div><?
        }
        elseif ($tabCode == 'docs')
        {
	        ?>
	        <h2>Документы, необходимые для заезда в санаторий.</h2>
	        <h3>Взрослому</h3>
	        <ul>
		        <li>путевка на санаторно-курортное лечение;</li>
		        <li>паспорт;</li>
		        <li>полис обязательного медицинского страхования;</li>
		        <li>санаторно-курортная карта (учетная форма 072/у, утвержденная Приказом №834н);</li>
		        <li>страховое свидетельство обязательного пенсионного страхования (при наличии);</li>
		        <li> договор (полис) добровольного медицинского страхования (при наличии).</li>
	        </ul>
	        <h3>Ребенку</h3>
	        <ul>
		        <li>путевка на санаторно-курортное лечение;</li>
		        <li>свидетельство о рождении (для детей в возрасте до 14 лет);</li>
		        <li>полис обязательного медицинского страхования;</li>
		        <li>справка врача-педиатра или врача-эпидемиолога об отсутствии контакта с больными инфекционными заболеваниями</li>
		        <li>сертификат прививок;</li>
		        <li>санаторно-курортная карта ребенка (учетная форма 076/у, утвержденная Приказом №834н).</li>
	        </ul>
	        <p>До заезда в санаторий, необходимо заранее проконсультироваться с врачом и оформить санаторно-курортную карту, это сэкономит Ваше время и обеспечит возможность начать курс лечения в соответствии со сроком пребывания по путевке.</p>
	        <p>При отсутствии санаторно-курортной карты при заезде в санаторий, у гостей есть возможность оформить ее за дополнительную плату. Срок оформления санаторно-курортной карты в этом случае может занимать от 1 до 3 рабочих дней. Дни по путевке, в течение которых оформляется санаторно-курортная карта в санатории, не продлеваются и не компенсируются. </p>
	        <a class="docs-link" href="<?= P_HREF ?>/upload/voucher.docx" download>Ваучер (обменная путевка)</a>
	        <a class="docs-link" href="<?= P_HREF ?>/upload/contract.doc" download>Договор с туристом</a><?
        }
        elseif ($tabCode == 'reviews')
		{
		    global $APPLICATION;
			$APPLICATION->IncludeComponent('tim:empty', 'reviews.list', array(
				'ID' => $sanatorium['ID'],
			));
		}
        elseif ($tabCode == 'map')
		{
			?>
            <script type="text/javascript">var yMapPoint = [<?= $sanatorium['YMAP'] ?>];</script>
            <div id="dmap" style="width:100%; height:500px"></div><?
		}

    }

	/**
	 * Корректировка цены санатория (но минимальной цене номера)
	 * Дополнительно подсчет количества типов номеров
	 * @param $id
	 * @param int $excludeRoomId
	 */
	public static function correctPrice($id, $excludeRoomId = 0)
	{
		$rooms = Room::getBySanatorium($id);
		$price = false;
		$count = 0;
		foreach ($rooms as $room)
		{
			if ($room['PRICE'] && $room['ID'] != $excludeRoomId)
			{
				if ($price === false || $price > $room['PRICE'])
					$price = $room['PRICE'];
				$count++;
			}
		}

		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList(array(), array(
			'IBLOCK_ID' => self::IBLOCK_ID,
			'ID' => $id,
		), false, false, array(
			'ID',
			'PROPERTY_PRICE',
			'PROPERTY_ROOMS_COUNT',
		));
		if ($item = $rsItems->Fetch())
		{
			$update = array();
			$oldPrice = intval($item['PROPERTY_PRICE_VALUE']);
			$oldCount = intval($item['PROPERTY_ROOMS_COUNT_VALUE']);
			if ($price && $price != $oldPrice)
				$update['PRICE'] = $price;
			if ($count != $oldCount)
				$update['ROOMS_COUNT'] = $count;

			if ($update)
				$iblockElement->SetPropertyValuesEx($id, self::IBLOCK_ID, $update);
		}
	}

	/**
	 * Возвращает санатории блока "рекомендуем"
	 * @param bool $refreshCache
	 * @return int|mixed
	 */
	public static function getTop($refreshCache = false)
	{
		$return = 0;

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
			);

			$iblockElement = new \CIBlockElement();
			$ids = [];
			$rsItems = $iblockElement->GetList(array(), array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
				'PROPERTY_TOP' => 1,
			), false, false, $select);
			while ($item = $rsItems->Fetch())
				$ids[] = $item['ID'];

			if ($ids)
			{
				$items = self::get(
					array('PROPERTY_RATING' => 'desc'),
					$ids,
					array('nPageSize' => 30, 'iNumPage' => 1)
				);

				$return = $items['ITEMS'];
			}

			$extCache->endDataCache($return);
		}

		return $return;
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

	public static function checkRedirect($code)
	{
		$ar = [
			'30-letiya-pobedy' => 'sanatoriy-30-letiya-pobedy',
			'bukovaya-roshcha' => 'sanatoriy-bukovaya-roshcha',
			'geolog-kazakhstan' => 'sanatoriy-geolog-kazakhstan',
			'gorkogo' => 'sanatoriy-gorkogo',
			'goryachiy-klyuch' => 'sanatoriy-goryachiy-klyuch',
			'dzhinal-' => 'sanatoriy-dzhinal',
			'dimitrova' => 'sanatoriy-dimitrova',
			'don' => 'sanatoriy-don',
			'dubovaya-roshcha' => 'sanatoriy-dubovaya-roshcha',
			'dubrava' => 'sanatoriy-dubrava',
			'zarya' => 'sanatoriy-zarya',
			'zdorove' => 'sanatoriy-zdorove',
			'istok' => 'sanatoriy-istok',
			'istochnik' => 'sanatoriy-istochnik',
			'kavkaz' => 'sanatoriy-kavkaz',
			'kazakhstan' => 'sanatoriy-kazakhstan',
			'kalinina' => 'sanatoriy-kalinina',
			'kolos' => 'sanatoriy-kolos',
			'krepost' => 'sanatoriy-krepost',
			'krugozor' => 'sanatoriy-krugozor',
			'lermontova' => 'sanatoriy-lermontova',
			'metallurg' => 'sanatoriy-metallurg',
			'moskva' => 'sanatoriy-moskva',
			'nadezhda' => 'sanatoriy-nadezhda',
			'narzan' => 'sanatoriy-narzan',
			'niva' => 'sanatoriy-niva',
			'ordzhonikidze' => 'sanatoriy-ordzhonikidze',
			'piket' => 'sanatoriy-piket',
			'plaza' => 'sanatoriy-plaza',
			'plazaspa' => 'sanatoriy-plaza-spa',
			'rodnik' => 'sanatoriy-rodnik',
			'rossiya' => 'sanatoriy-rossiya',
			'runo' => 'sanatoriy-runo',
			'rus' => 'sanatoriy-rus',
			'semashko' => 'sanatoriy-semashko',
			'sechenova' => 'sanatoriy-sechenova',
			'solnechnyy' => 'sanatoriy-solnechnyy',
			'uzbekistan' => 'sanatoriy-uzbekistan',
			'ukraina' => 'sanatoriy-ukraina',
			'tsentrooyuz' => 'sanatoriy-tsentro-syuz',
			'tsentrosoyuz-kislovodsk-' => 'sanatoriy-tsentrosoyuz-kislovodsk',
			'shakher' => 'sanatoriy-shahter',
			'elbrus' => 'sanatoriy-elbrus',
		];

		if ($ar[$code])
			return $ar[$code];

		return false;
	}

}

