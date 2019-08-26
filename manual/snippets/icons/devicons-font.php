<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$data = ParseFactory::fromFile('DevIcons.json');

$section = Tags::section();
$section->addCssClass('container', 'devicons');
$section->appendH2('Devicons <small>FONT versions</small>')->addCssClass('devicons');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');

foreach ($data as $item) {
  $name = $item['name'];
  // echo "\n$name";
  foreach ($item['versions']['font'] as $version) {
    $method = $name . ucfirst($version);
    $icon = DevIcons::i("$name-$version")->setAriaLabel("devicon-$name-$version icon")->setAttribute('title', "devicon-$name-$version icon");
    $content = Tags::div()->addCssClass('icon-container');
    $iconContainer = Tags::div()->addCssClass('icon', 'font', 'devicons');
    $content->append($iconContainer);
    $iconContainer->append($icon);
    $ext = Tags::div($name)->addCssClass('ext', 'devicons');
    $content->append($ext);
    $grid->append($content);
  }
}

$section->append($grid);
echo $section;
