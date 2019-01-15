<?php

namespace Sphp\Html\Attrs;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$gen = new AttributeGenerator();
$attrs = new HtmlAttributeManager($gen);
$attrs->forceBoolean('bool', true);
$attrs->forceInteger('int')->set(546);
try {
  $attrs->forceInteger('int-min-2', 2)->set(0);
} catch (\Exception $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
try {
  $attrs->forceBoolean('int-min-2', false);
} catch (\Exception $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
$attrs->set('string', 'bar');
$attrs->set('null', null);
?>
<pre>
  <?php
  echo "$attrs\n\n";
  var_dump($attrs->toArray());
  ?>
</pre>