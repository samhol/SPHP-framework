<?php

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\TagFactory;
use Sphp\Html\Foundation\Sites\Core\ScreenSizes;

$p = TagFactory::p();
$adapter = new VisibilityAdapter($p);
foreach (new ScreenSizes as $size) {
  $adapter->showFromUp($size);
  echo $p($p->cssClasses()->getValue());
}
