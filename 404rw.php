<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
header('Location: '.SITE_SERVER_NAME.'/');
exit();

$url = explode("/", $_SERVER['REQUEST_URI']);
$str = "Location: http://u0995325.isp.regruhosting.ru/".$url[1]."/".$url[2].".html";
//echo $str;
header("Location: http://www.example.com/");
exit();

?>