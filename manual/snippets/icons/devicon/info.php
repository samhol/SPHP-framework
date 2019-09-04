<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('/home/int48291/public_html/playground/manual/settings.php');
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$version = filter_input(INPUT_GET, 'version', FILTER_SANITIZE_STRING);

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Lists\Dl;
use Sphp\Html\Apps\HyperlinkGenerators\Factory;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Manual\Apps\Icons\DataFactory;

$iconsData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');
$iconData = $iconsData->getIcon($name);
$classLinker = $method = Factory::sami()->classLinker(DevIcons::class);
echo '<h3>Devicon information</h3>';
//echo '<pre>';
//print_r($iconsData->toArray());
$dl = new Dl();
$dl->appendTerm('<strong>SVG</strong> versions:');
$dl->appendDescriptions($iconData->getVersionsFor('svg'));
$dl->appendTerm('<strong>FONT</strong> versions:');
$dl->appendDescriptions($iconData->getVersionsFor('font'));
echo $dl;
//print_r($iconData->getVersionsFor('font'));
//echo '</pre>';
$link = $classLinker->getLink(DevIcons::class . "::i('" . $iconData->getName() . "-plain')");
echo "Font icon example: $link";
