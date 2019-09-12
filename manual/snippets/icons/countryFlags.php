<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\NationalFlags;

$data = ParseFactory::fromFile('/home/int48291/public_html/playground/manual/snippets/icons/countrycodes.json');

$section = Tags::section();
$section->addCssClass('example icons');
$section->appendH2('Country flags <small>as SVG objects</small>');
$grid = new BlockGrid('small-up-2', 'medium-up-4', 'large-up-5');
$grid->addCssClass('country-flags', 'icon-examples');

$flagFactory = new NationalFlags('/home/int48291/public_html/playground/manual/svg/flags/');
foreach ($data as $countryData) {
  $countryCode = $countryData['Code'];
  $countryName = $countryData['Name'];
  $titleText = "$countryCode: $countryName";
  $svg = $flagFactory->img(strtolower($countryData['Code']));
  $svg->setAlt($titleText);
  //$svg->setHeight(100);
  $cellContent = Tags::div()->addCssClass('icon-container');
  $iconContainer = Tags::div()->addCssClass('icon', 'national-flag', 'svg');
  $cellContent->append($iconContainer);
  $iconContainer->append("<span>$svg</span>");
  $ext = Tags::div("<strong>$countryCode:</strong> $countryName")->addCssClass('ext');
  $cellContent->append($ext);
  $iconContainer->setAttribute('title', $titleText);
  $grid->append($cellContent);
}
$section->append($grid);
echo $section;
