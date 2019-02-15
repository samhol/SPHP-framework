<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');
require_once 'country-flag-definitions.php';

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;
use Sphp\Html\Media\Icons\SvgLoader;

\Sphp\Manual\md('## Country flags');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8"');
$grid->addCssClass('country-flags', 'icon-examples');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/home/int48291/public_html/playground/manual/svg/flags'));
$array = iterator_to_array($objects);
ksort($array);
foreach ($array as $name => $object) {
  if ($object->isFile()) {
    $content = Tags::div()->addCssClass('icon-container');
    $iconContainer = Tags::div()->addCssClass('icon national-flag');
    $content->append($iconContainer);
    $iconContainer->append(SvgLoader::fromFile($object->getRealPath()));
    $countryCode = strtoupper($object->getBasename('.svg'));
    $ext = Tags::div()->addCssClass('ext');
    $content->append($ext);
    if (array_key_exists($countryCode, $countries)) {
      $iconContainer->setAttribute('title', $countries[$countryCode]);
      $ext->append($countryCode);
    } else {
      $ext->append('UNKNOWN');
    }
    $grid->append($content);
  }
}
echo $grid;
