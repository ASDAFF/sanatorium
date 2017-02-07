<?
namespace Local\Catalog;

/**
 * Class Sitemap Генерация карты сайта
 * @package Local\Catalog
 */
class Sitemap
{
	protected $error;
	protected $xml;
	protected $html;
	protected $fxml;
	protected $fhtml;
	protected $url;

	/**
	 * Обновляет файлы sitemap.xml и sitemap.html
	 * @return bool
	 */
	public function start()
	{
		$this->url = 'http://sanatorium.ru';
		$this->xml = $_SERVER["DOCUMENT_ROOT"] . '/sitemap.xml';
		$this->html = $_SERVER["DOCUMENT_ROOT"] . '/include/sitemap.html';

		$this->fxml = $this->prepareFile($this->xml. '.tmp');
		$this->fhtml = $this->prepareFile($this->html. '.tmp');
		if (!$this->fxml)
		{
			$this->error = 'Ошибка создания xml файла';
			return false;
		}
		if (!$this->fhtml)
		{
			$this->error = 'Ошибка создания html файла';
			return false;
		}

		$this->preWrite();

		$staticData = $this->getStatic();
		$this->writeStatic($staticData);
		$filtersData = Filter::getSiteMap();
		$this->writeXml($filtersData);
		$filtersData = Filter::getSimpleSiteMap();
		$this->writeHtml($filtersData);
		$products = Filter::getSiteMapProducts();
		$this->writeXml($products);
		$this->writeHtml($products);

		$this->postWrite();
		$this->closeFile();

		$this->moveFile();

		return true;
	}

	protected function prepareFile($filename)
	{
		CheckDirPath($filename);

		if ($fp = @fopen($filename, "w"))
			return $fp;
		else
			return false;
	}

	protected function preWrite()
	{
		@fwrite($this->fxml, '<?xml version="1.0" encoding="UTF-8"?>'."\n");
		@fwrite($this->fxml, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"');
		@fwrite($this->fxml, ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"');
		@fwrite($this->fxml, ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"');
		@fwrite($this->fxml, ">\n");

		@fwrite($this->fhtml, "<ul>\n");
	}

	protected function writeStatic($data)
	{
		foreach ($data as $url => $p) {
			@fwrite($this->fxml, "<url>\n");
			@fwrite($this->fxml, "\t<loc>" . $this->url . $url . "</loc>\n");
			@fwrite($this->fxml, "\t<priority>$p</priority>\n");
			@fwrite($this->fxml, "</url>\n");
		}
	}

	protected function writeXml($data)
	{
		foreach ($data as $url => $name) {
			@fwrite($this->fxml, "<url>\n");
			@fwrite($this->fxml, "\t<loc>" . $this->url . $url . "</loc>\n");
			@fwrite($this->fxml, "\t<priority>0.50</priority>\n");
			@fwrite($this->fxml, "</url>\n");
		}
	}

	protected function writeHtml($data)
	{
		foreach ($data as $url => $name) {
			@fwrite($this->fhtml, "<li>\n");
			@fwrite($this->fhtml, "\t<a href=\"$this->url$url\">$name</a>\n");
			@fwrite($this->fhtml, "</li>\n");
		}
	}

	protected function postWrite()
	{
		@fwrite($this->fxml, "</urlset>\n");

		@fwrite($this->fhtml, "</ul>\n");
	}

	protected function closeFile()
	{
		@fclose($this->fxml);
		@fclose($this->fhtml);
	}

	protected function moveFile()
	{
		unlink($this->xml);
		rename($this->xml. '.tmp', $this->xml);

		unlink($this->html);
		rename($this->html. '.tmp', $this->html);
	}

	public function getError()
	{
		return $this->error;
	}

	private function getStatic()
	{
		return array(
			'/' => '1.00',
			'/contacts/' => '0.80',
			'/news/' => '0.80',
		);
	}

}