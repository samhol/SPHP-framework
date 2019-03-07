<?php

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$grid = (new BlockGrid('small-up-1', 'medium-up-2', 'large-up-4'));
$grid->addCssClass('hide-for-small-only', 'blocks');
$menus = [];
foreach ($footerData['items'] as $data) {
  $instance = new Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu();
  if (is_string($data['menu'])) {
    $instance->appendText($data['icon'] . ' ' . $data['menu'])->addCssClass('root');
    $instance->setVertical(true);
  }
  $menus[$data['key']][] = $mb->buildMenu($data, $instance);
}
$grid->append($menus[1]);
$grid->append($menus[2]);
$grid->append($menus[3]);
$grid->append($menus[4]);

echo $grid;
