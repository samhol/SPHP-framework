<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Foundation\Sites\Containers\CardReveal;
use Sphp\Manual;

$data = ParseFactory::fromFile('DevIcons.json');

$section = Tags::section();
$section->addCssClass('icons', 'devicons');
$section->appendH2('Devicons <small>FONT versions</small>')->addCssClass('devicons');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');
$classLinker = $method1 = Manual\api()->classLinker(DevIcons::class);

foreach ($data as $item) {
  $name = $item['name'];
  // echo "\n$name";
  foreach ($item['versions']['font'] as $version) {
    $card = new CardReveal();
    $card->addCssClass('icon-container', 'font');
    $iconName = "$name-$version";
    $method1 = $classLinker->methodLink('__invoke');
    $method1->resetContent("DevIcons::('$iconName')");
    $icon = DevIcons::i("$name-$version")->setTitle("devicon-$name-$version icon")->setAttribute('title', "devicon-$name-$version icon");
    $card->getRevealTitle()->append($method1);
    $link = Tags::span($icon)->addCssClass('text-center icon');
    $link->setAttribute('data-open', 'dev-icons-font-version-info');
    $link->setAttribute('data-url', "/manual/snippets/icons/devicons/info.php?name=$name&version=$version&type=font");
    $card->getFront()->append($link);
    $content = Tags::div()->addCssClass('icon-container');
    $iconContainer = Tags::div()->addCssClass('icon', 'font', 'devicons');
    $content->append($iconContainer);
    $iconContainer->append($icon);

    $ext = Tags::div($name)->addCssClass('ext', 'devicons');
    $content->append($ext);
    $grid->append($card);
  }
}

$section->append($grid);
echo $section;
