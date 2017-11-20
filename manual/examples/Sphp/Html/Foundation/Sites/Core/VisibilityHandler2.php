<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Factory;

$ul = Factory::ul();
foreach (Screen::sizes() as $size) {
  $li = "$size screen size: ";
  $li .= (new VisibilityAdapter(Factory::span("yes")))
          ->showOnlyFor($size);
  $li .= (new VisibilityAdapter(Factory::span("no")))
          ->hideOnlyFromSize($size);
  $ul[] = $li;
}
$ul->printHtml();
?>
