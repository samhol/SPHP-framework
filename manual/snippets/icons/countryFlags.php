<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');
require_once 'country-flag-definitions.php';

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;
use Sphp\Html\Media\Icons\SvgLoader;

$section = Tags::section();
$section->addCssClass('container', 'country-flags');
$section->appendH2('Country flags <small>as SVG icons</small>')->addCssClass('country-flags');
$grid = new BlockGrid('small-up-3', 'medium-up-4', 'large-up-6', 'xlarge-up-8');
$grid->addCssClass('country-flags', 'icon-examples');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/home/int48291/public_html/playground/manual/svg/flags'));
$array = iterator_to_array($objects);
ksort($array);
foreach ($array as $name => $object) {
  if ($object->isFile()) {
    $cellContent = Tags::div()->addCssClass('icon-container');
    $iconContainer = Tags::div()->addCssClass('icon', 'national-flag', 'svg');
    $cellContent->append($iconContainer);
    $iconContainer->append('<div class="flag">'.SvgLoader::fileToString($object->getRealPath()).'</div>');
    $countryCode = strtoupper($object->getBasename('.svg'));
    $ext = Tags::div()->addCssClass('ext');
    $cellContent->append($ext);
    $ext->append("<strong>$countryCode</strong>");
    if (array_key_exists($countryCode, $countries)) {
      $iconContainer->setAttribute('title', $countries[$countryCode]);
      $ext->append(" $countries[$countryCode]");
    }
    $grid->append($cellContent);
  }
}
$section->append($grid);
echo $section;
