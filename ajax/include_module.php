<?
use Bitrix\Main\Loader;

Loader::includeModule('yenisite.core');

$moduleId = "yenisite.b2glass";	/// !!!!!!!!!!!!!!
$moduleCode = 'b2glass'; // !!!!!!!!
$settingsClass = 'CRZBitronic2Settings';

if (!Loader::includeModule($moduleId)) die("Module {$moduleId} not installed!");
