<?php

namespace Sphp\Html\Media\Icons;

require_once('../../settings.php');

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;

//$faData = Parser::fromFile('font-awesome.json');
$faData = Parser::fromFile('font-awesome.yml');
//$d = $json->fromFile('manual/snippets/icons.json');
//print_r($data);
$types = ['fas' => 'Solid', 'far' => 'Regular', 'fab' => 'Brand'];
$typeMap = ['solid' => 'fas', 'regular' => 'far', 'brands' => 'fab'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING, ['default' => null]);
var_dump($type, $typeMap[$type]);
$show = $typeMap[$type];

$headingNote = ucfirst($type);

\Sphp\Manual\md("##Font Awesome: <small>$headingNote icons</small>");

$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');
$grid->addCssClass('sphp-icon-examples');
$fa = new FA();
$fa->fixedWidth(true);
foreach ($faData as $name => $data) {
  $content = Tags::div()->addCssClass('icon-container');
  $flagContainer = Tags::div()->addCssClass('icon');
  $content->append($flagContainer);
  $ext = Tags::div()->addCssClass('ext');
  $content->append($ext);


  if (in_array($type, $data['styles'])) {
    $icon = $fa("$typeMap[$type] fa-$name");
    $flagContainer->append($icon);
    //$grid->append($content);
    $flagContainer->setAttribute('title', 'Unicode: ' . $data['unicode']);
    $grid->append($content);
  }

  //var_dump($icon, $data['styles']);
  //$flagContainer->append($icon);
}
echo $grid;

