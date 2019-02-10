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
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING, ['default' => null]);
var_dump($types[$type]);
$show =$types[$type];

if (array_key_exists($type, $types)) {
  $headingNote = $types[$type];
} else {
  $headingNote = 'All';
}
\Sphp\Manual\md("##Font Awesome: <small>$headingNote icons</small>");

$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');
$grid->addCssClass('sphp-icon-examples');
$fa = new FA();
$fa->fixedWidth(true);
$fa->setSize('fa-lg');
foreach ($faData as $name => $data) {
  $content = Tags::div()->addCssClass('icon-container');
  $flagContainer = Tags::div()->addCssClass('icon');
  $content->append($flagContainer);
  $ext = Tags::div()->addCssClass('ext');
  $content->append($ext);
  if ($type === null) {
    echo "grWEAWgr";
    foreach ($data['styles'] as $style) {
      $icon = $fa("fas fa-$style");
      $flagContainer->append($icon);
      $grid->append($content);
    }
  } else {
    if (in_array('solid', $data['styles'])) {
      $icon = $fa("fas fa-$name");
      $flagContainer->append($icon);
      $grid->append($content);
    }
    if (in_array('brand', $data['styles'])) {
      $icon = $fa("fab fa-$name");
      $flagContainer->append($icon);
      $grid->append($content);
    }
    if (in_array('regular', $data['styles'])) {
      $icon = $fa("far fa-$name");
      $flagContainer->append($icon);
      $flagContainer->setAttribute('title', 'Unicode: ' . $data['unicode']);
      $grid->append($content);
    }
  }

  //var_dump($icon, $data['styles']);
  //$flagContainer->append($icon);
}
echo $grid;

