<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Factory;

$paragraph = Factory::p();
$adapter = new VisibilityAdapter($paragraph);
foreach (array_reverse(Screen::sizes()) as $name) {
  $paragraph("You are <em>definitely not</em> on a <b>$name</b> screen.");
  echo $adapter->hideOnlyFromSize($name);
}
