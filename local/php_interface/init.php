<?

// Константы
require('const.php');

// Функции
require('func.php');

// Классы
require('classes.php');

// Модули битрикса
\Bitrix\Main\Loader::IncludeModule('iblock');

// Обработчики событий
\Local\System\Handlers::addEventHandlers();

//include wm modules
defined('_DS_') or define('_DS_', DIRECTORY_SEPARATOR);
$wmLibPath = realpath(__DIR__ . _DS_ . '..' . _DS_ . 'modules' . _DS_ . 'WM') . _DS_ . 'autoloader.php';
if(is_file($wmLibPath))
    require_once $wmLibPath;