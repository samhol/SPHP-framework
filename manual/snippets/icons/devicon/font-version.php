<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Manual;
use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\Views\IconsView;

$iconsData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');

$iconsView = new IconsView();
echo $iconsView->getHtmlFor($iconsData);
/*$section = Tags::section();
$section->addCssClass('icons', 'devicons');
$section->appendH2('Devicons <small>FONT versions</small>')->addCssClass('devicons');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');
$classLinker = $method1 = Manual\api()->classLinker(DevIcons::class);

$iconsData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');
foreach ($iconsData as $name => $item) {
  $name = $item->getGroupName();
  $fontVersions = $item->getVersionsFor('font');
  $iconName = array_shift($fontVersions);
  $icon = DevIcons::i($iconName)->setTitle("devicon-$name icons")->setAttribute('title', "devicon-$name icon");
  $link = Tags::span($icon)->addCssClass('icon', 'font');
  $content = Tags::div()->addCssClass('icon-container');
  $content->setAttribute('data-open', 'dev-icons-font-version-info');
  $content->setAttribute('data-url', "/manual/snippets/icons/devicon/info.php?name=$name&type=font");
  $iconContainer = Tags::div($link)->addCssClass('icon-wrapper', 'devicons', 'text-center');
  $content->append($iconContainer);
  $ext = Tags::div($name)->addCssClass('ext', 'devicons');
  $content->append($ext);
  $grid->append($content);
}

$section->append($grid);
echo $section;
*/
