<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Factory;

foreach (new ScreenSizes as $name) {
  (new VisibilityAdapter(Factory::p()("This screen is <b>$name</b>.")))
          ->showOnlyFor($name)
          ->printHtml();
  (new VisibilityAdapter(Factory::p()("This text is visible on a <b>$name</b> screen or larger.")))
          ->showFromUp($name)
          ->printHtml();
  (new VisibilityAdapter(Factory::p()("hide-for-$name")))
          ->hideDownTo($name)
          ->printHtml();
  (new VisibilityAdapter(Factory::p()("This text is hidden only for <b>$name</b> screens")))
          ->hideOnlyForSize($name)
          ->printHtml();
}
?>
