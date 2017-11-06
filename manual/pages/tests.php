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
$attrs = new HtmlAttributeManager();
//$attrs->getGenerator()->mapType('foo-bool-not', IntegerAttribute::class);
$attrs->setBoolean('foo-bool-not', true);
$attrs->setInteger('foo-int', 15);
echo "$attrs\n";
$attrs->setInstance(new BooleanAttribute('foo-int', true));
$attrs->remove('blöö');
echo "$attrs\n";
echo "</pre>";





















