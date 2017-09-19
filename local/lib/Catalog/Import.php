<?
namespace Local\Catalog;
use Local\System\Log;

/**
 * Class Import Импорт цен
 * @package Local\Catalog
 */
class Import
{

	/**
	 * Путь до файлов
	 */
	const PATH = '/upload/prices/';

	/**
	 * @var Log Лог
	 */
	private $_log;

	/**
	 * Старт импорта цен
	 */
	public function price()
	{
		$this->_log = new Log('import/' . date('Y_m') . '.log');
		$this->log(date('d.m.Y') . ' Начало импорта');

		$all = 0;
		$price = 0;

		$iblockElement = new \CIBlockElement();
		$filter = array(
			'IBLOCK_ID' => Sanatorium::IBLOCK_ID,
		);
		$select = array(
			'ID', 'NAME', 'CODE',
			'PROPERTY_PROGRAMMS',
			'PROPERTY_PRICE_PDF',
		);
		$rsItems = $iblockElement->GetList(array(), $filter, false, false, $select);
		while ($item = $rsItems->GetNext())
		{
			$programms = Programms::getByIds($item['PROPERTY_PROGRAMMS_VALUE']);
			$progs = array();
			foreach ($programms as $prog)
				$progs[trim($prog['NAME'])] = $prog['ID'];
			$rooms = Room::getBySanatorium($item['ID']);
			$rms = array();
			foreach ($rooms as $room)
				$rms[$room['NAME']] = array(
				    'ID' => $room['ID'],
				    'PRICES' => $room['PRICES_ORIG'],
                );
		    $sanatorium = array(
				'ID' => $item['ID'],
				'NAME' => $item['NAME'],
				'PRICE_PDF' => $item['PROPERTY_PRICE_PDF_VALUE'],
				'PROGRAMMS' => $progs,
                'ROOMS' => $rms,
			);

			if ($sanatorium['PRICE_PDF'])
            {
            	if ($sanatorium['ID'] != 476)
            		continue;

                $price++;
				$this->importSanatorium($sanatorium);
            }
			$all++;
		}

		$this->log('Всего санаториев: ' . $all);
		$this->log('Из них с файлами цен: ' . $price);

    }

	/**
     * Импорт цен для санатория
	 * @param $sanatorium
	 * @return bool
	 */
	private function importSanatorium($sanatorium)
	{
		$this->log('Санаторий "' . $sanatorium['NAME'] . '" [' . $sanatorium['ID'] . ']');

		$file = \CFile::GetPath($sanatorium['PRICE_PDF']);
		$this->log($file);

		require_once $_SERVER["DOCUMENT_ROOT"] . '/local/lib/PHPExcel.php';
		$excel = \PHPExcel_IOFactory::load($_SERVER["DOCUMENT_ROOT"] . $file);

		$sheet = $excel->getSheet(0);
		$ar = $sheet->toArray();

		$values = false;
		$programmId = 0;
		$dates = [];
		$persons = [];
		$result = [];
		$cnt = 0;
		foreach ($ar as $row)
		{
			if ($values)
			{
				if (trim($row[0]) == 'Программа лечения')
				{
					$programmId = 0;
					$progName = '';
					foreach ($row as $i => $td)
					{
						if (!$i)
							continue;

						$val = trim($td);
						if ($val)
						{
							$ar = explode('(', $val);
							$progName = trim($ar[0]);
							$progName = trim($progName, '*');
							$progName = str_replace('  ', ' ', $progName);
							$programmId = $sanatorium['PROGRAMMS'][$progName];
							break;
						}
					}
					if (!$progName)
						$this->log('Не найдена программа лечения');
					elseif (!$programmId)
						$this->log('Не найден ID программы лечения по названию: ' . $progName);

					if (!$programmId)
						$values = false;
				}
                elseif (trim($row[0]) == 'Категория номеров, согласно классификации санатория')
				{
					foreach ($row as $i => $td)
					{
					    if (!$i)
					        continue;
					    if (!$dates[$i])
					        continue;

						$val = trim($td);
						if (!$val)
						    continue;

						$code = '';
						if ($val == 'Весь номер при размещении в нём 1 человека')
							$code = 'F';
                        elseif ($val == 'Основное место в номере')
							$code = 'M';
                        elseif ($val == 'Доп. место')
							$code = 'A';
                        elseif ($val == 'Доп.  место')
							$code = 'A';
                        elseif (strpos($val, 'Основное место на ребенка') === 0)
						{
							$prt = explode('до', substr($val, 52));
							$prt1 = $prt[0];
							$prt2 = $prt[1];
							if (intval($prt1) || $prt1 === '0')
							    if (intval($prt2))
							        $code = 'M' . intval($prt1) . '-' . intval($prt2);
						}
                        elseif (strpos($val, 'Доп. место на ребенка') === 0)
						{
							$prt = explode('до', substr($val, 43));
							$prt1 = $prt[0];
							$prt2 = $prt[1];
							if (intval($prt1) || $prt1 === '0')
								if (intval($prt2))
							        $code = 'A' . intval($prt1) . '-' . intval($prt2);
						}

						if ($code)
							$persons[$i] = $code;
                        else
							$this->log('Не распознан заголовок: "' . $val . '"');
					}
				}
				elseif (trim($row[0]) == 'Период')
				{

				}
                elseif (trim($row[0]) == 'Стоимость указана на человека в сутки в рублях.')
				{
					$values = false;
				}
				elseif ($row[0])
				{
				    if ($programmId)
					{
						$val = trim($row[0]);
						$ar = explode('(', $val);
						$roomName = trim($ar[0]);
						$roomName = trim($roomName, '*');
						$room = $sanatorium['ROOMS'][$roomName];
						if (!$room)
							$this->log('Не найден ID номера по названию: ' . $roomName);
						else
						{
						    $roomId = $room['ID'];
							foreach ($row as $i => $td)
							{
								if ($persons[$i] && $dates[$i])
								{
									$val = trim($td);
									$val = str_replace(',', '', $val);

									$fval = intval($val);
									if ($fval)
									{
										$result[$roomId][$programmId][$dates[$i]][$persons[$i]] = $fval;
										$cnt++;
									}
								}
							}
						}
					}
				}
			}

			if (trim($row[0]) == 'Период')
			{
				$values = true;
				$dates = [];
				$persons = [];

				$sfrom = '';
				$sto = '';
				foreach ($row as $i => $td)
				{
					if (!$i)
						continue;

					$val = trim($td);
					if ($val)
					{
						$val = str_replace('с ', '', $val);
						$parts = explode(' по ', $val);
						if (count($parts) < 2)
							$parts = explode('по', $val);
						if (count($parts) < 2)
							$parts = explode(' - ', $val);
						if (count($parts) < 2)
							$parts = explode('-', $val);
						if (count($parts) < 2)
						{
							$this->log('Не распознаны даты для периода: ' . $val);
							$values = false;
						}
						else
						{

							$from = trim($parts[0]);
							$to = trim($parts[1]);
							$efrom = explode('.', $from);
							$eto = explode('.', $to);

							$sfrom = intval($efrom[0]) . '.' . intval($efrom[1]);
							$sto = intval($eto[0]) . '.' . intval($eto[1]);
						}
					}

					if ($sfrom)
						$dates[$i] = $sfrom . '-' . $sto;
				}
			}
		}

		$this->log('Всего цен распознано: ' . $cnt);

		foreach ($sanatorium['ROOMS'] as $room)
		{
			$newPrices = json_encode($result[$room['ID']], JSON_UNESCAPED_UNICODE);
			if ($newPrices != $room['PRICES'])
			{
				Room::updatePrices($room['ID'], $newPrices);
			}
		}

		return true;
	}

	private function log($s)
	{
		$this->_log->writeText($s);
		debugmessage($s);
	}

}