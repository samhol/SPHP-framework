<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Foundation\Sites\Containers\CardReveal;
use Sphp\Manual;
use Sphp\Manual\Apps\Icons\IconsData;

$data = ParseFactory::fromFile('DevIcons.json');

$section = Tags::section();
$section->addCssClass('icons', 'devicons');
$section->appendH2('Devicons <small>FONT versions</small>')->addCssClass('devicons');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');
$classLinker = $method1 = Manual\api()->classLinker(DevIcons::class);

$raw = ParseFactory::fromFile('/home/int48291/public_html/playground/manual/snippets/icons/DevIcons.json');
$iconsData = new IconsData($raw);
foreach ($iconsData as $name => $item) {
  $name = $item->getName();
  $fontVersions = $item->getVersionsFor('font');
  $iconName = array_shift($fontVersions);
  $icon = DevIcons::i($iconName)->setTitle("devicon-$name icons")->setAttribute('title', "devicon-$name icon");
  $link = Tags::span($icon)->addCssClass('icon', 'font');
  //$card->getFront()->append($link);
  $content = Tags::div()->addCssClass('icon-container');
  $content->setAttribute('data-open', 'dev-icons-font-version-info');
  $content->setAttribute('data-url', "/manual/snippets/icons/devicons/info.php?name=$name&type=font");
  $iconContainer = Tags::div($link)->addCssClass('icon-wrapper', 'devicons', 'text-center');
  $content->append($iconContainer);
  //$iconContainer->append($content);

  $ext = Tags::div($name)->addCssClass('ext', 'devicons');
  $content->append($ext);
  $grid->append($content);
  // }
}

$section->append($grid);
echo $section;
