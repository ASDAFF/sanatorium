<?

namespace Local\Catalog;
use Bitrix\Main\Loader;

/**
 * Каталог
 */
class TimCatalog extends \CBitrixComponent
{
	/**
	 * @var array параметры сортировки
	 */
	public $sortParams = array(
		'search' => array(
			'ORDER_DEFAULT' => 'asc',
			'FIELD' => 'SEARCH',
			'NAME' => 'релевантности',
		),
		'price' => array(
			'ORDER_DEFAULT' => 'asc',
			'FIELD' => 'PROPERTY_PRICE',
			'NAME' => 'цене путевки',
			'DEFAULT' => true,
		),
		'rating' => array(
			'ORDER_DEFAULT' => 'desc',
			'FIELD' => 'PROPERTY_RATING',
			'NAME' => 'рейтингу санатория',
		),
	);

	/**
	 * @var array Количество элементов на странице
	 */
	public $pageSizes = array(15, 25, 40);
	private $defaultPageSize = 25;

	/**
	 * @var array параметры в урле
	 */
	public $urlParams;

	/**
	 * @var array текущая сортировка
	 */
	private $sort;

	/**
	 * @var array параметры постранички
	 */
	public $navParams;

	/**
	 * @var string поисковый запрос
	 */
	public $searchQuery = '';

	/**
	 * @var array айдишники найденных товаров
	 */
	private $searchIds = array();

	/**
	 * @var array панель фильтров
	 */
	public $filter = array();

	/**
	 * @var array элемент детально
	 */
	public $product = array();

	/**
	 * @var string код вкладки
	 */
	public $tabCode = '';

	/**
	 * @var array номер
	 */
	public $room = array();

	/**
	 * @var array элементы
	 */
	public $products = array();

	/**
	 * @var array свойства SEO
	 */
	public $seo = array();

	/**
	 * @var string количество (2 варианта)
	 */
	public $countTitle = '';

	/**
	 * Запуск компонента
	 * @inherit
	 */
	public function executeComponent()
	{
		$url = urldecode($_SERVER['REQUEST_URI']);
		$urlDirs = explode('/', $url);

		if ($this->arParams['SANATORIUM_ID'])
		{
			$this->product = Sanatorium::getById($this->arParams['SANATORIUM_ID']);
			if ($this->product)
			{
				$this->tabCode = $urlDirs[1];
				if (substr($this->tabCode, 0, 1) == '?')
					$this->tabCode = '';

				if ($this->tabCode == 'rooms')
				{
					$roomCode = $urlDirs[2];
					if (substr($roomCode, 0, 1) == '?')
						$roomCode = '';

					if ($roomCode)
						$this->room = Room::getByCode($this->product, $roomCode);
				}
			}
		}
		else
		{
			$code = $urlDirs[3];
			if ($code && count($urlDirs) > 4)
			{
				$redirect = Sanatorium::checkRedirect($code);
				if ($redirect)
					LocalRedirect('https://' . $redirect . '.putevochka.com', true, '301 Moved Permanently');

				if (is_numeric($code))
					$this->product = Sanatorium::getById($code);
				else
					$this->product = Sanatorium::getByCode($code);
			}

			if ($this->product)
			{
				$this->tabCode = $urlDirs[4];
				if (substr($this->tabCode, 0, 1) == '?')
					$this->tabCode = '';

				$tabPath = '';
				if ($this->tabCode)
					$tabPath .= $this->tabCode . '/';

				LocalRedirect('https://' . $this->product['CODE'] . '.putevochka.com/' . $tabPath, true, '301 Moved Permanently');
			}
		}

		if ($this->product)
		{
			// Счетчик просмотренных
			Sanatorium::viewedCounters($this->product['ID']);
		}
		else
		{
			// Обработка входных данных (сортировка, постраничка...)
			$this->prepareParameters();

			// Поиск
			$empty = false;
			if ($this->searchQuery)
			{
				$this->searchIds = $this->search();
				if (!$this->searchIds)
					$empty = true;

				$this->arResult['NOT_FOUND'] = $empty;
			}

			if (!$empty)
			{
				$this->filter = Filter::getData($this->searchIds, $this->searchQuery, $this->urlParams);
				$this->products = Sanatorium::get($this->sort['QUERY'], $this->filter['PRODUCTS_IDS'], $this->navParams);
				$this->countTitle = $this->products['NAV']['COUNT'];
				$this->countTitle .= pluralize($this->countTitle, array(' вариант', ' варианта', ' вариантов'));
			}

			$this->SetPageProperties();
		}

		$this->includeComponentTemplate();
	}

	/**
	 * Подготовка и обработка параметров
	 */
	private function prepareParameters()
	{
		// Без апача редиректы ведут себя странно, поэтому пришлось реализовать вручную
		$tmp = explode('?', $_SERVER['REQUEST_URI']);
		$this->urlParams = array();
		if (count($tmp) > 1)
		{
			$ar = explode('&', $tmp[1]);
			foreach ($ar as $param)
			{
				$ar1 = explode('=', $param);
				$this->urlParams[$ar1[0]] = urldecode($ar1[1]);
			}
		}

		//
		// Поиск
		//
		$query = $this->urlParams['q'];
		$this->arResult['~QUERY'] = $query;
		$this->searchQuery = htmlspecialchars($query);

		//
		// Сортировка
		//
		$defaultSortKey = '';
		foreach ($this->sortParams as $key => $params)
		{
			if ($params['DEFAULT'])
				$defaultSortKey = $key;
			if (!$defaultSortKey)
				$defaultSortKey = $key;
		}

		$sortKey = $this->urlParams['sort'];
		// Если задано непосредственно
		if ($this->sortParams[$sortKey])
		{
			$sortOrder = $this->sortParams[$sortKey]['ORDER_DEFAULT'];
			$this->sort = array(
				'KEY' => $sortKey,
				'ORDER' => $sortOrder,
			);
			$_SESSION['CATALOG']['SORT']['KEY'] = $sortKey;
			$_SESSION['CATALOG']['SORT']['ORDER'] = $sortOrder;
		}
		// Есть ли поиск?
		elseif ($this->searchQuery)
		{
			$this->sort = array(
				'KEY' => 'search',
				'ORDER' => 'asc',
			);
		}
		// Смотрим в сессии
		elseif ($_SESSION['CATALOG']['SORT']['KEY'])
		{
			$this->sort = array(
				'KEY' => $_SESSION['CATALOG']['SORT']['KEY'],
				'ORDER' => $_SESSION['CATALOG']['SORT']['ORDER'],
			);
		}
		// По-умолчанию
		else
		{
			$sortKey = $defaultSortKey;
			$this->sort = array(
				'KEY' => $sortKey,
				'ORDER' => $this->sortParams[$sortKey]['ORDER_DEFAULT'],
			);
		}
		$sortQuery = array();
		if ($this->sort['KEY'] == 'search')
		{
			$sortQuery['SEARCH'] = 'asc';
		}
		else
		{
			$sortQuery[$this->sortParams[$this->sort['KEY']]['FIELD']] = $this->sort['ORDER'];
			$this->sortParams[$this->sort['KEY']]['ORDER'] = $this->sort['ORDER'];
			$this->sortParams[$this->sort['KEY']]['CURRENT'] = true;
			unset($this->sortParams['search']);
		}
		$this->sort['QUERY'] = $sortQuery;

		//
		// Постраничная навигация
		//
		$page = $this->urlParams['page'];
		if (intval($page) <= 0)
			$page = 1;
		$size = intval($this->urlParams['size']);
		if (in_array($size, $this->pageSizes))
			$_SESSION['CATALOG']['SIZE'] = $size;
		elseif ($_SESSION['CATALOG']['SIZE'] && in_array($_SESSION['CATALOG']['SIZE'], $this->pageSizes))
			$size = $_SESSION['CATALOG']['SIZE'];
		else
			$size = $this->defaultPageSize;
		$this->navParams = array(
			'iNumPage' => $page,
			'nPageSize' => $size,
		);
	}

	/**
	 * Обработка поискового запроса
	 * @throws \Bitrix\Main\LoaderException
	 */
	private function search()
	{
		$return = array();

		if (Loader::includeModule('search'))
		{
			$search = new \CSearch();
			$params = array(
				'QUERY' => $this->searchQuery,
				'SITE_ID' => 's1',
				'MODULE_ID' => 'iblock',
				'PARAM1' => 'aspro_resort_catalog',
				'PARAM2' => array(
					Sanatorium::IBLOCK_ID,
				),
			);
			$sort = array(
				'TITLE_RANK' => 'DESC',
				'CUSTOM_RANK' => 'DESC',
				'RANK' => 'DESC',
				'DATE_CHANGE' => 'DESC',
			);

			// Поиск с морфологией
			$search->Search($params, $sort);
			if ($search->errorno == 0)
			{

				while ($item = $search->GetNext())
					$return[$item['ITEM_ID']] = $item['ITEM_ID'];
			}
		}

		return $return;
	}

	/**
	 * Установка параметров страницы (заголовк, ключевые слова...)
	 */
	private function setPageProperties()
	{
		$this->seo = array();
		if ($this->searchQuery)
		{
			$this->seo = $this->filter['SEO'];
		}
		elseif ($this->filter)
		{
			$this->seo = Seo::getByUrl($this->filter['SEO']['URL']);

			if (!$this->seo['H1'])
				$this->seo['H1'] = $this->filter['SEO']['H1'];
			if (!$this->seo['TITLE'])
				$this->seo['TITLE'] = $this->filter['SEO']['TITLE'];
			if (!$this->seo['DESCRIPTION'])
				$this->seo['DESCRIPTION'] = $this->filter['SEO']['DESCRIPTION'];
			if (!$this->seo['TEXT'])
				$this->seo['TEXT'] = $this->filter['SEO']['TEXT'];
			if (!$this->seo['TEXT1'])
				$this->seo['TEXT1'] = $this->filter['SEO']['TEXT1'];
			if (!$this->seo['NOINDEX'])
				$this->seo['NOINDEX'] = $this->filter['SEO']['NOINDEX'];
		}
	}
}
