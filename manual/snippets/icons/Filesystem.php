<?php

namespace Sphp\Html\Media\Icons;

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;

$d = Parser::fromFile('../filetypes.yml');


$section = Tags::section();
$section->addCssClass('container', 'filetypes');
$section->appendH2('Filetype icons')->addCssClass('filetypes');


foreach ($d as $name => $group) {

  $section->appendH3($name)->addCssClass('filetypes');
  $grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');
  $grid->addCssClass('sphp-icon-examples filetypes');
  $section->append($grid);
  foreach ($group as $extension => $description) {
    $content = Tags::div()->addCssClass('icon-container');
    $iconContainer = Tags::div()->addCssClass('icon', 'font', 'devicons');
    $content->append($iconContainer);
    $icon = Filetype::$extension($description)->setAttribute('title', "$extension: $description");
    $iconContainer->append($icon);
    $ext = Tags::div($extension)->addCssClass('ext', 'devicons');
    $content->append($ext);
    $grid->append($content);
  }
  //$section->append($grid);
}
echo $section;
