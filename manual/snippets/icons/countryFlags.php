<?php

require_once('../../settings.php');

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;
use Sphp\Html\Media\Icons\SvgLoader;

\Sphp\Manual\md('## Country flags');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8"');
$grid->addCssClass('sphp-icon-examples');
echo '<div class="icon-example-popup grid-x small-up-3 medium-up-5 large-up-8">';
require_once 'country-flag-definitions.php';
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/home/int48291/public_html/data.samiholck.com/svg/flags'));
foreach ($objects as $name => $object) {
  if ($object->isFile()) {
    $content = Tags::div()->addCssClass('icon-container');
    $flagContainer = Tags::div()->addCssClass('icon national-flag');
    $content->append($flagContainer);
    $flagContainer->append(SvgLoader::fromFile($object->getRealPath()));
    $countryCode = strtoupper($object->getBasename('.svg'));
    $ext = Tags::div()->addCssClass('ext');
    $content->append($ext);
    if (array_key_exists($countryCode, $countries)) {
      $flagContainer->setAttribute('title', $countries[$countryCode]);
      $ext->append($countryCode);
    } else {
      $ext->append('UNKNOWN');
    }
    $grid->append($content);
  }
}
echo $grid;
