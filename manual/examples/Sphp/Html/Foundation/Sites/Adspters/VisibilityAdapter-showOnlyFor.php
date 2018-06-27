<?php

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Core\ScreenSizes;

$p = Tags::p();
$adapter = new VisibilityAdapter($p);
foreach (new ScreenSizes as $size) {
  $adapter->showOnlyFor($size);
  echo $p($p->cssClasses()->getValue());
}
