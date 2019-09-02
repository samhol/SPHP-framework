<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('/home/int48291/public_html/playground/manual/settings.php');
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$version = filter_input(INPUT_GET, 'version', FILTER_SANITIZE_STRING);

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Manual\Apps\Icons\IconInformation;
use Sphp\Manual\Apps\Icons\IconsData;

$raw = ParseFactory::fromFile('/home/int48291/public_html/playground/manual/snippets/icons/DevIcons.json');
$iconsData = new IconsData($raw);
echo '<pre>';
print_r($iconsData->toArray());
$iconInfo = new IconInformation();
echo '</pre>';
echo "icon: $name $type $version";
