<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

echo "<pre>";
echo new BooleanAttribute('foo', true) . "\n";
echo new BooleanAttribute('foo', false) . "\n";
echo new BooleanAttribute('foo', 0) . "\n";
echo new BooleanAttribute('foo', 'TrUe') . "\n";
echo new BooleanAttribute('foo', 'no') . "\n";
echo new BooleanAttribute('foo', "yeS") . "\n";
try {
  $b = new BooleanAttribute('foo', "yeS");
  $b->set('foo');
} catch (\Exception $ex) {
  echo new ThrowableCallout($ex);
}
echo "</pre>";







