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
$value = new GeneralAttribute('foo', false);
echo "$value";

$css = new ClassAttribute('class');
$css->set('a b', 'c', ' d ', ['e', 'f g']);
echo "\n$css";
$cssParser = new CssClassParser();
for($i = 0; $i <100000; $i++) {
  $foo = $cssParser->parse(['a b', 'c', ' d ', ['e', 'f g'], 1, false, 100], false);
}
print_r($foo);
?>
</pre>
