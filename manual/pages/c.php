<?php

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Core\ScreenSizes;

$div = new Div('foo div');
$prototype = new VisibilityAdapter($div);
echo "<pre>";
$sizes = new ScreenSizes ();
foreach ($sizes as $size) {
  $div->setContent("only for $size size");
  echo $prototype->showOnlyFor($size);
}
foreach ($sizes as $size) {
  $div->setContent("from $size size up");
  echo $prototype->showFromUp($size);
}
foreach ($sizes as $size) {
  $div->setContent("hide only for $size size");
  echo $prototype->hideOnlyForSize($size);
}
foreach ($sizes as $size) {
  $div->setContent("hide down to $size size");
  echo $prototype->hideDownTo($size);
}

$prototype->setLayouts(['hide', 'show-for-medium', 'hide-for-large-only', 'show-for-large', 'hide-for-large']);
$div->setContent($prototype->cssClasses()->getValue());
echo $prototype;
echo "</pre>";
?>
<p class="hide-for-large-only hide-for-small-only hide-for-xxlarge-only">HIDE BOOOOOOOOOO</p>
<p class="show-for-small-only">SHOW BOOOOOOOOOO</p>
