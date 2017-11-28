<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\TagFactory;

$ul = TagFactory::ul();
foreach (Screen::sizes() as $size) {
  $li = "$size screen size: ";
  $li .= (new VisibilityAdapter(TagFactory::span("yes")))
          ->showOnlyFor($size);
  $li .= (new VisibilityAdapter(TagFactory::span("no")))
          ->hideOnlyForSize($size);
  $ul[] = $li;
}
$ul->printHtml();
?>
