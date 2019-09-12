<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');
require_once '/home/int48291/public_html/playground/manual/snippets/icons/country-flag-definitions.php';

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\NationalFlags;

$data = ParseFactory::fromFile('/home/int48291/public_html/playground/manual/snippets/icons/countrycodes.json');

//echo '<pre>';
//print_r($data);
//echo '</pre>';

function getCountry(string $iso): string {
  if (!array_key_exists($iso, $countries)) {
    $iconContainer->setAttribute('title', $countries[$countryCode]);
    $ext->append(" $countries[$countryCode]");
  }
  return $countries[$countryCode];
}

$section = Tags::section();
$section->addCssClass('example icons');
$section->appendH2('Country flags <small>as SVG icons</small>')->addCssClass('country-flags');
$grid = new BlockGrid('small-up-2', 'medium-up-4', 'large-up-5');
$grid->addCssClass('country-flags', 'icon-examples');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/home/int48291/public_html/playground/manual/svg/flags'));
$array = iterator_to_array($objects);
ksort($array);
$flagFactory = new NationalFlags('/home/int48291/public_html/playground/manual/svg/flags/');
foreach ($data as $countryData) {
  $countryCode = $countryData['Code'];
  $countryName = $countryData['Name'];
  $svg = $flagFactory->getFlagOf(strtolower($countryData['Code']));
  //$svg->setHeight(100);
  $cellContent = Tags::div()->addCssClass('icon-container');
  $iconContainer = Tags::div()->addCssClass('icon', 'national-flag', 'svg');
  $cellContent->append($iconContainer);
  $iconContainer->append("<span>$svg</span>");
  $ext = Tags::div()->addCssClass('ext');
  $cellContent->append($ext);
  $ext->append("<strong>$countryCode:</strong>");
  $iconContainer->setAttribute('title', $countryName);
  $ext->append(" $countryName");
  $grid->append($cellContent);
}
$section->append($grid);
echo $section;
