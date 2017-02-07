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
