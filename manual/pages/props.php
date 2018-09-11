<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$pattr = new PropertyCollectionAttribute('style');
$pattr->setProperty('border', 'solid #aaa 1px');
$pattr['width'] = '2rem';
echo $pattr;
$pattr->protect('foo:bar');
echo $pattr;
$pp = new PropertyParser();
var_dump($pp->parseStringToProperties('a:b;c:d;'));
var_dump($pp->parseStringToProperties('a:b;c:d'));
try {
  var_dump($pp->parseStringToProperties(''));
} catch (\Exception $ex) {
  echo "$ex\n";
}
$value = new Attribute('foo', false);
echo "$value";
?>
</pre>
