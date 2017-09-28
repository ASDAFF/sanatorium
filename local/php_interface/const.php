<?
$host = \COption::GetOptionInt('main', 'server_name');
$href = 'https://' . $host;
define('P_HREF', $href);