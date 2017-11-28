<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\TagFactory;

$paragraph = TagFactory::p();
$adapter = new VisibilityAdapter($paragraph);
foreach (array_reverse(Screen::sizes()) as $name) {
  $paragraph("You are <em>definitely not</em> on a <b>$name</b> screen.");
  echo $adapter->hideOnlyForSize($name);
}
