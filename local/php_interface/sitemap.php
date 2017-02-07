<?
if (!$_SERVER['DOCUMENT_ROOT']) {
	error_reporting(0);
	setlocale(LC_ALL, 'ru.UTF-8');
	$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__) . '/../..');
	$bConsole = true;
}
else {
	$bConsole = false;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

set_time_limit(0);
ignore_user_abort(true);
ini_set("memory_limit", "1024M");

$map = new \Local\Catalog\Sitemap();
$map->start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');

