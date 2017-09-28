<?
$host = \COption::GetOptionInt('main', 'server_name');
$http = $_SERVER['REQUEST_SCHEME'];
$href = $http . '://' . $host;
define('P_HREF', $href);